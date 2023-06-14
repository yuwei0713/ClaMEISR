<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Parser\Shortcut\ElementParser;

use function PHPSTORM_META\elementType;
use function PHPUnit\Framework\isEmpty;

class ChildInformationTable
{
    public function PushBasicData($schoolnumber) //獲取學校名稱，班級名稱、代碼
    {
        $DBSelecter = DB::table('schooltable')->where('SchoolCode', $schoolnumber);
        $SchoolName = $DBSelecter->select('SchoolName')->first();
        $DBRow = $DBSelecter->count();
        $ClassArray = array();
        for ($i = 0; $i < $DBRow; $i++) {
            $ClassName = $DBSelecter->select('ClassName')->limit(1)->offset($i)->get()->toArray();
            $ClassCode = $DBSelecter->select('ClassCode')->limit(1)->offset($i)->get()->toArray();
            $Class = array("ClassName" => reset($ClassName)->ClassName, "ClassCode" => reset($ClassCode)->ClassCode);

            array_push($ClassArray, $Class);
        }
        return [$SchoolName, $ClassArray];
    }
    public function GetChildBasic($account, $schoolnumber, $CurrentYear) //for首頁，呈現學生資訊用
    {
        $ChildDBSelecter = DB::table('studentschooltable')->where('TeacherAccount', $account)->where('SchoolCode', $schoolnumber);
        $TeacherDBSelecter = DB::table('studentschooltable')
            ->where('TeacherAccount', $account) //使用教師帳號
            ->where('SchoolCode', $schoolnumber)
            ->where('year', '>=', $CurrentYear - 2)
            ->where('year', '<=', $CurrentYear)
            ->distinct()->orderBy('Year');
        $GetYear = $TeacherDBSelecter->select('Year')->get()->toArray();
        $YearQuantity = count($GetYear);

        if ($YearQuantity == 0) {
            return null;
        } else {
            $ReturnArray = array();
            for ($year = $CurrentYear - 2; $year <= $CurrentYear; $year++) { //從當前學年度往前推2學年，共3學年
                $CloneSelecter = clone $ChildDBSelecter; //clone $ChildDBSelecter php laravel 的 query builder 有疊加特性
                $CloneTeacherSelecter = clone $TeacherDBSelecter; //clone $TeacherDBSelecter php laravel 的 query builder 有疊加特性
                $CloneSelecter = $CloneSelecter->where('Year', $year);
                $TeacherClass = $CloneTeacherSelecter
                    ->select('Year', 'ClassCode', 'ClassName')
                    ->where('Year', $year)
                    ->distinct()->orderBy('ClassCode')->get()->toArray();
                $ClassQuantity = count($TeacherClass);
                $PushClass = array();

                for ($i = 0; $i < $ClassQuantity; $i++) {
                    $NewCloneSelecter = clone $CloneSelecter; //clone $CloneSelecter php laravel 的 query builder 有疊加特性
                    $ChildDetails = $NewCloneSelecter->where('ClassCode', $TeacherClass[$i]->ClassCode); //班級代號
                    $RowNumber = $ChildDetails->count();
                    $ChildQuantity = array();
                    for ($j = 0; $j < $RowNumber; $j++) {
                        $Detail = $ChildDetails->select('*')->limit(1)->offset($j)->get()->toArray();
                        $NewDetail = reset($Detail);
                        $studentid = $NewDetail->StudentID;
                        $childname = $NewDetail->StudentName; //姓名
                        $childcode = $NewDetail->StudentCode; //座號
                        $birth = $NewDetail->BirthDay; //生日
                        $newage = (new ChildInformationTable)->count_age($birth); //年齡 當天計算
                        $childage = $NewDetail->Age;
                        if ((int)$newage > (int)$childage) {
                            $ChildDetails->where('StudentID', $studentid)->update(['Age' => $newage]);
                        }
                        $DetailArray = array("ChildName" => $childname, "ChildNumber" => $childcode, "ChildValue" => $studentid);
                        array_push($ChildQuantity, $DetailArray);
                    }
                    $ClassArray = array($TeacherClass[$i]->ClassName => $ChildQuantity);
                    $PushClass = array_merge($PushClass, $ClassArray);
                }
                $YearArray = array($year . "年度" => $PushClass);
                $ReturnArray = array_merge($ReturnArray, $YearArray); //array_merge 前面的代號不能使用數字 會被弄掉 ex "110" => Array[班級一] ===> "0" =>Array["班級一"]
            }
            //dd($ReturnArray);
            return $ReturnArray;
        }
    }
    public function PushChildBasicData($StudentID)
    {
        try {
            $SchoolData = DB::table('studentschooltable')
                ->select('ClassName', 'StudentCode', 'StudentName', 'Age')
                ->where('StudentID', $StudentID)
                ->get()->toArray();
            $StatusData = DB::table('studentstatustable')
                ->where('StudentID', $StudentID)
                ->get()->toArray();
            $Details = reset($SchoolData);
            return $Details;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }
    public function PushDetailData($StudentID) //幼兒基本資料歷史紀錄呈現用
    {
        $Details = array();
        try {
            $SchoolData = DB::table('studentschooltable')
                ->where('StudentID', $StudentID)
                ->get()->toArray();
            $StatusData = DB::table('studentstatustable')
                ->where('StudentID', $StudentID)
                ->get()->toArray();
            $SchoolDetails = reset($SchoolData);
            $StatusDetails = reset($StatusData);
            $SchoolArray = json_decode(json_encode($SchoolDetails), true);
            $StatusArray = json_decode(json_encode($StatusDetails), true);
            $Details = array_merge($SchoolArray, $StatusArray);
            //dd($Details);
            return $Details;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }

    public function count_age($birth) //計算年齡
    {
        $birthyear = (int)date('Y', strtotime($birth));
        $birthmonth = (int)date('m', strtotime($birth));
        $birthday = (int)date('d', strtotime($birth));

        $tyear = date('Y');
        $tmonth = date('m');
        $tday = date('d');
        $age = $tyear - $birthyear;
        if ($birthmonth > $tmonth || $birthmonth == $tmonth && $birthday > $tday) {
            $age--;
        }
        return $age;
    }

    public function InsertChildInformation($request, $TeacherAccount) //輸入幼兒基本資料
    {
        $classdata = preg_split("/-/", $request['class_name'], -1, PREG_SPLIT_NO_EMPTY);
        $classname = $classdata[0];
        $classcode = $classdata[1];
        //建立學號 S+入學年度(3碼)+學校代碼(3碼)+班級代碼(2碼)+座號(2碼) 共11碼
        //dd($request);
        //獲取值
        $Year = $request->year;
        $SchoolCode = $request->school_code;
        $ClassCode = $classcode;
        $StudentCode = $request->student_code;

        if (((int)$SchoolCode) < 10) {
            $SchoolCode = "00" . $SchoolCode;
        } elseif (((int)$SchoolCode) < 100) {
            $SchoolCode = "0" . $SchoolCode;
        }

        if (((int)$ClassCode) < 10) {
            $ClassCode = "0" . $ClassCode;
        }
        if (((int)$StudentCode) < 10) {
            $StudentCode = "0" . $StudentCode;
        }
        $StudentID = "S" . $Year . $SchoolCode . $ClassCode . $StudentCode;

        $IfExist = DB::table('studentschooltable')->select('StudentID')->where('StudentID', $StudentID)->get()->toArray();
        if (!empty($IfExist)) { //填寫過了 重新導回
            return false;
        }
        /**
         * studentschooltable
         * StudentID 學號 => $StudentID
         * StudentName 幼兒姓名 => $request['student_name']
         * StudentCode 座號 => $request['student_code']
         * Year 入學年度 => $request['year']
         * Semester 學期 => $request['semester']
         * SchoolName 學校名稱 => $request['school_name']
         * SchoolCode 學校代碼 => $request['school_code']
         * ClassName 班級名稱 => $classname
         * ClassCode 班級代碼 => $classcode
         * TeacherName 教師姓名 => $request['quest_name']
         * BirthDay 生日 => $request['age_datepicker']
         * Age 年紀 => $request['child_age']
         */
        DB::table('studentschooltable')->insert([
            'StudentID' => $StudentID,
            'StudentName' => $request['student_name'],
            'StudentCode' => $request['student_code'],
            'Year' => $request['year'],
            'Semester' => $request['semester'],
            'SchoolName' => $request['school_name'],
            'SchoolCode' => $request['school_code'],
            'ClassName' => $classname,
            'ClassCode' => $classcode,
            'TeacherAccount' => $TeacherAccount,
            'BirthDay' => $request['age_datepicker'],
            'Age' => $request['child_age'],
            'Gender' => $request['gender']
        ]);
        /**
         * studentstatustable
         * StudentID 學號 => $StudentID
         * Status 狀態 => $request['status']
         * Identities 鑑定安置類別 => $request['identities']  confirm
         * Proofs 鑑定安置佐證 => $request['proofs']  confirm
         * Manual 是否領有身障手冊 => $request['manual']  confirm
         * Diagnosis 診斷 => $request['diagnosis']  confirm,suspected
         * OtherDiagnosis 診斷(其他) => $request['diagnosis_other_content']  confirm
         * Degree 障礙程度 => $request['degree']  confirm
         * Placement 安置結果 => $request['placement']  confirm
         * Resident 同住者 => $request['living']
         * OtherResident 同住者(其他) => $request['living_other_content']
         * Fst-attend 主要照顧者 => $request['fst_attend'] , $request['fst_attend_other']
         * Sec-attend 次要照顧者 => $request['sec_attend'] , $request['sec_attend_other']
         */
        //同住者以空格分割 查詢出來後請以空格進行字串分割!!!
        $other_living = "";
        $living = "";
        $fst_attend = "";
        $sec_attend = "";
        if ($request['living']) { //判斷有無診斷
            if (is_array($request['living'])) { //判斷診斷是否為陣列
                for ($j = 0; $j < count($request['living']); $j++) {
                    $living .= $request['living'][$j] . " "; //同住者 array
                }
            }
        }
        if ($request['living_other_content']) { //同住者 例外處理
            $other_living = $request['living_other_content'];
        }

        if ($request['fst_attend_other']) {
            $fst_attend = $request['fst_attend'] . "-" . $request['fst_attend_other']; // 主要照顧者 選項或是其他 合併
        } else {
            $fst_attend = $request['fst_attend'];
        }
        if ($request['sec_attend_other']) {
            $sec_attend = $request['sec_attend'] . "-" . $request['sec_attend_other']; // 次要照顧者 選項或是其他 合併
        } else {
            $sec_attend = $request['sec_attend'];
        }
        DB::table('studentstatustable')->insert([
            'StudentID' => $StudentID,
            'Status' => $request['status'],
            'Resident' => $living,
            'OtherResident' => $other_living,
            'Fst-attend' => $fst_attend,
            'Sec-attend' => $sec_attend
        ]);



        $identities = "";
        $proofs = "";
        $manual = "";
        $diagnosis = "";
        $other_diagnosis = "";
        $degree = "";
        $placement = "";
        $note = "";
        if ($request['status'] == "confirm" || $request['status'] == "suspected") { //特殊生 or 疑似生
            $diagnosis = $request['diagnosis']; //障礙類別
            if ($request['diagnosis_other_content']) { //其他症狀描述
                $diagnosis = "other";
                if($request['status'] == "confirm"){
                    $other_diagnosis = $request['diagnosis_other_content']; // 診斷 選項或是其他 合併
                }
                if($request['status'] == "suspected"){
                    $other_diagnosis = $request['suspected_diagnosis_other_content']; 
                }
            }
            $degree = $request['degree']; //障礙程度

            if ($diagnosis == "發展遲緩") {
                for ($i = 0; $i < count($request['identities']); $i++) {
                    $identities .= $request['identities'][$i] . " "; //鑑定安置類別 array
                }
            }
            for ($i = 0; $i < count($request['proofs']); $i++) {
                $proofs .= $request['proofs'][$i] . " "; //鑑定安置佐證 array
            }
            $manual = $request['manual']; //是否領有身障證明
            $placement = $request['placement']; //安置結果
            $note = $request['note']; //補充說明

            DB::table('studentstatustable')->where('StudentID', $StudentID)->update([
                'Identities' => $identities,
                'Proofs' => $proofs,
                'Manual' => $manual,
                'Diagnosis' => $diagnosis,
                'OtherDiagnosis' => $other_diagnosis,
                'Note' => $note,
                'Degree' => $degree,
                'Placement' => $placement
            ]);
        }


        return true;
    }
    public function UpdataChildInformation($request, $TeacherAccount) //修改幼兒基本資料
    {
        //宣告基本變數
        $other_living = "";
        $living = "";
        $fst_attend = "";
        $sec_attend = "";
        $identities = "";
        $proofs = "";
        $manual = "";
        $diagnosis = "";
        $other_diagnosis = "";
        $degree = "";
        $placement = "";

        $classdata = preg_split("/-/", $request['class_name'], -1, PREG_SPLIT_NO_EMPTY);
        $classname = $classdata[0];
        $classcode = $classdata[1];

        $CurrentStudentID = $request['OldStudentID']; //原本ID

        //重新創造ID
        $Year = $request->year;
        $SchoolCode = $request->school_code;
        $ClassCode = $classcode;
        $StudentCode = $request->student_code;

        if (((int)$SchoolCode) < 10) {
            $SchoolCode = "00" . $SchoolCode;
        } elseif (((int)$SchoolCode) < 100) {
            $SchoolCode = "0" . $SchoolCode;
        }

        if (((int)$ClassCode) < 10) {
            $ClassCode = "0" . $ClassCode;
        }
        if (((int)$StudentCode) < 10) {
            $StudentCode = "0" . $StudentCode;
        }
        $NewStudentID = "S" . $Year . $SchoolCode . $ClassCode . $StudentCode;

        $CurrentStatus = DB::table('studentstatustable')->select('Status')->where('StudentID', $CurrentStudentID)->get()->toArray();
        $CurrentStatus = reset($CurrentStatus)->Status;
        //確認ID是否匹配 如不匹配，先檢查ID是否重複，如無重複，更改ID
        if ($CurrentStudentID != $NewStudentID) { //ID不同，更改ID，舊ID刪除
            $IfExist = DB::table('studentschooltable')->select('StudentID')->where('StudentID', $NewStudentID)->get()->toArray();
            if (!empty($IfExist)) { //填寫過了 重新導回
                return false;
            } else {
                //舊ID更改為新ID
                DB::table('studentschooltable')->where('StudentID', $CurrentStudentID)
                    ->update([
                        'StudentID' => $NewStudentID
                    ]);
                //更改基本資料
                $CurrentStudentID = $NewStudentID;
            }
        }
        DB::table('studentschooltable')->where('StudentID', $NewStudentID)
            ->update([
                'StudentName' => $request['student_name'],
                'StudentCode' => $request['student_code'],
                'Year' => $request['year'],
                'Semester' => $request['semester'],
                'SchoolName' => $request['school_name'],
                'SchoolCode' => $request['school_code'],
                'ClassName' => $classname,
                'ClassCode' => $classcode,
                'TeacherAccount' => $TeacherAccount,
                'BirthDay' => $request['age_datepicker'],
                'Age' => $request['child_age'],
                'Gender' => $request['gender']
            ]);

        if ($request['living']) { //判斷有無同住者
            if (is_array($request['living'])) { //判斷同住者是否為陣列
                for ($j = 0; $j < count($request['living']); $j++) {
                    $living .= $request['living'][$j] . " "; //同住者 array
                }
            }
        }
        if ($request['living_other_content']) { //同住者 例外處理
            $other_living = $request['living_other_content'];
        }

        if ($request['fst_attend_other']) {
            $fst_attend = $request['fst_attend'] . "-" . $request['fst_attend_other']; // 主要照顧者 選項或是其他 合併
        } else {
            $fst_attend = $request['fst_attend'];
        }
        if ($request['sec_attend_other']) {
            $sec_attend = $request['sec_attend'] . "-" . $request['sec_attend_other']; // 次要照顧者 選項或是其他 合併
        } else {
            $sec_attend = $request['sec_attend'];
        }
        DB::table('studentstatustable')->where('StudentID', $CurrentStudentID)->update([
            'Resident' => $living,
            'OtherResident' => $other_living,
            'Fst-attend' => $fst_attend,
            'Sec-attend' => $sec_attend
        ]);

        if ($request['status'] == "confirm" || $request['status'] == "suspected") {
            if ($CurrentStatus != $request['status']) { //狀態更改，更新狀態
                DB::table('studentstatustable')->where('StudentID', $CurrentStudentID)->update([
                    'Status' => $request['status'],
                ]);
            }

            $diagnosis = $request['diagnosis']; //障礙類別
            if($request['status'] == "confirm"){
                if ($request['diagnosis_other_content']) { //其他症狀描述
                    $diagnosis = "other";
                    $other_diagnosis = $request['diagnosis_other_content']; // 診斷 選項或是其他 合併
                }
            }
            if($request['status'] == "suspected"){
                if ($request['suspected_diagnosis_other_content']) { //其他症狀描述
                    $diagnosis = "other";
                    $other_diagnosis = $request['suspected_diagnosis_other_content']; // 診斷 選項或是其他 合併
                }
            }
            $degree = $request['degree']; //障礙程度
            
            if ($diagnosis == "發展遲緩") {
                for ($i = 0; $i < count($request['identities']); $i++) {
                    $identities .= $request['identities'][$i] . " "; //鑑定安置類別 array
                }
            }
            for ($i = 0; $i < count($request['proofs']); $i++) {
                $proofs .= $request['proofs'][$i] . " "; //鑑定安置佐證 array
            }
            $manual = $request['manual']; //是否領有身障證明
            $placement = $request['placement']; //安置結果
            $note = $request['note']; //補充說明
            //dd($proofs);
            DB::table('studentstatustable')->where('StudentID', $CurrentStudentID)->update([
                'Identities' => $identities,
                'Proofs' => $proofs,
                'Manual' => $manual,
                'Diagnosis' => $diagnosis,
                'OtherDiagnosis' => $other_diagnosis,
                'Note' => $note,
                'Degree' => $degree,
                'Placement' => $placement
            ]);
        } else if ($request['status'] == "none") {
            if ($CurrentStatus != "none") { //狀態更改，清空所有資料
                DB::table('studentstatustable')->where('StudentID', $CurrentStudentID)->update([
                    'Status' => $request['status'],
                ]);
                DB::table('studentstatustable')->where('StudentID', $CurrentStudentID)->update([
                    'Identities' => null,
                    'Proofs' => null,
                    'Manual' => null,
                    'Diagnosis' => null,
                    'OtherDiagnosis' => null,
                    'Degree' => null,
                    'Placement' => null
                ]);
            }
        }

        return true;
    }
}
