<?php

namespace App\Models;

use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class QuestionTable
{
    public function PushQuestion($QuestionCode, $QuestionBigTopic)
    {
        //$QuestionnaireChild = DB::table('studentschooltable')->select('StudentName')->where("TeacherName",$teacherid)->get()->toArray();
        //$NewQuestionnaireChild = reset($QuestionnaireChild);
        //$ChildAge = DB::table('studenttable')->select('Age')->where("StudentName",reset($NewQuestionnaireChild))->get()->toArray();
        //$NewChildAge = reset($ChildAge);
        $QuestionName = DB::table("questionnaireframework")->select("QuestionName")->where("QuestionCode", $QuestionCode)->get()->toArray(); //抓問卷名稱
        $QuestionQuantity = DB::table("questionnaireframework")->select("QuestionQuantity")->where("QuestionCode", $QuestionCode)->get()->toArray();

        $NewQuestionQuantity = reset($QuestionQuantity);
        $NewQuestionQuantity = reset($NewQuestionQuantity);
        if ($QuestionBigTopic < $NewQuestionQuantity) {
            $QuestionBigTopic += 1;
            $Status = (new QuestionTable)->CheckIfFinal($QuestionCode, $QuestionBigTopic);
            $NewQuestionName = reset($QuestionName);
            $QuestionDetail = DB::table("questionnairecontent") //SQL 查詢模組化
                ->where("QuestionCode", $QuestionCode)
                ->where("BigTopicNumber", $QuestionBigTopic);

            $RowNumber = $QuestionDetail->count(); //小題數量
            $BigTopicName = $QuestionDetail->select("BigTopicName")->limit(1)->get()->toArray(); //抓大題的名稱 limit() 代表SQL抓的資料數
            $NewBigTopicName = reset($BigTopicName);
            $OptionContent = $QuestionDetail->select("OptionContent")->limit(1)->get()->toArray(); //抓選項標題
            $NewOptionContent = reset($OptionContent);
            $AdditionTitle = $QuestionDetail->select("AdditionTitle")->limit(1)->get()->toArray(); //抓附加標題
            $NewAdditionTitle = reset($AdditionTitle);
            $QuestionPageTitleData = array("QuestionCode" => $QuestionCode, "QuestionBigTopic" => $QuestionBigTopic, "QuestionName" => reset($NewQuestionName), "BigTopicName" => reset($NewBigTopicName), "OptionContent" => reset($NewOptionContent), "AdditionTitle" => reset($NewOptionContent), "AdditionTitle" => reset($NewAdditionTitle));
            $QuestionPageData = array();
            for ($i = 0; $i < $RowNumber; $i++) {
                $OptionType = $QuestionDetail->select("OptionType")->limit(1)->offset($i)->get()->toArray(); //抓問卷填寫方式
                $SmTopicNumber = $QuestionDetail->select("SmTopicNumber")->limit(1)->offset($i)->get()->toArray(); //抓小題數
                $NewSmTopicNumber = reset($SmTopicNumber);
                $SmTopicContent = $QuestionDetail->select("SmTopicContent")->limit(1)->offset($i)->get()->toArray(); //抓小題名稱
                $NewSmTopicContent = reset($SmTopicContent);
                $SuitableAge = $QuestionDetail->select("SuitableAge")->limit(1)->offset($i)->get()->toArray(); //抓年齡
                $NewSuitableAge = reset($SuitableAge);
                $QuestionValue = $QuestionDetail->select("OptionValue")->limit(1)->offset($i)->get()->toArray(); //抓選項的分數
                $NewQuestionValue = reset($QuestionValue);
                $AdditionContent = $QuestionDetail->select("AdditionContent")->limit(1)->offset($i)->get()->toArray(); //抓附加內容
                $NewAdditionContent = reset($AdditionContent);
                $DetailData = array("SmTopicNumber" => reset($NewSmTopicNumber), "SmTopicContent" => reset($NewSmTopicContent), "SuitableAge" => reset($NewSuitableAge), "OptionValue" => reset($NewQuestionValue), "AdditionContent" => reset($NewAdditionContent), "FillTopic" => -1);

                array_push($QuestionPageData, $DetailData);
            }
            return [$QuestionPageTitleData, $QuestionPageData, $RowNumber, $Status];
        } else {
            return [null, null, 0];
        }
    }
    public function PushAllQuestion($QuestionCode)
    {
        $QuestionFramework = DB::table("questionnaireframework")->select("QuestionName", "QuestionQuantity")->where("QuestionCode", $QuestionCode)->get()->toArray(); //抓問卷名稱
        $QuestionFramework = reset($QuestionFramework);
        $QuestionName = $QuestionFramework->QuestionName; //問卷名稱
        $QuestionQuantity = $QuestionFramework->QuestionQuantity; //問卷大題數
        $QuestionnaireDetail = array();
        for ($j = 1; $j <= intval($QuestionQuantity); $j++) {
            $QuestionDetail = DB::table("questionnairecontent") //SQL 查詢模組化
                ->where("QuestionCode", $QuestionCode)
                ->where("BigTopicNumber", $j);
            $RowNumber = $QuestionDetail->count();
            $BigTopicName = $QuestionDetail->select("BigTopicName")->limit(1)->get()->toArray(); //抓大題的名稱 limit() 代表SQL抓的資料數
            $OptionContent = $QuestionDetail->select("OptionContent")->limit(1)->get()->toArray(); //抓選項標題
            $AdditionTitle = $QuestionDetail->select("AdditionTitle")->limit(1)->get()->toArray(); //抓附加標題
            $BigTopicName = reset($BigTopicName)->BigTopicName;
            $OptionContent = reset($OptionContent)->OptionContent;
            $AdditionTitle = reset($AdditionTitle)->AdditionTitle;
            $OptionContent = preg_split("/,/", $OptionContent, -1, PREG_SPLIT_NO_EMPTY);
            $AdditionTitle = preg_split("/,/", $AdditionTitle, -1, PREG_SPLIT_NO_EMPTY);
            $QuestionPageTitleData = array("QuestionCode" => $QuestionCode, "BigTopicNumber" => strval($j), "QuestionName" => $QuestionName, "BigTopicName" => $BigTopicName, "OptionContent" => $OptionContent, "AdditionTitle" => $OptionContent, "AdditionTitle" => $AdditionTitle, "RowNumber" => strval($RowNumber));
            $QuestionPageDetailData = array();
            $QuestionPageData = array();
            for ($i = 0; $i < $RowNumber; $i++) {
                $OptionType = $QuestionDetail->select("OptionType")->limit(1)->offset($i)->get()->toArray(); //抓問卷填寫方式
                $SmTopicNumber = $QuestionDetail->select("SmTopicNumber")->limit(1)->offset($i)->get()->toArray(); //抓小題數
                $SmTopicContent = $QuestionDetail->select("SmTopicContent")->limit(1)->offset($i)->get()->toArray(); //抓小題名稱
                $SuitableAge = $QuestionDetail->select("SuitableAge")->limit(1)->offset($i)->get()->toArray(); //抓年齡
                $OptionValue = $QuestionDetail->select("OptionValue")->limit(1)->offset($i)->get()->toArray(); //抓選項的分數
                $AdditionContent = $QuestionDetail->select("AdditionContent")->limit(1)->offset($i)->get()->toArray(); //抓附加內容
                $OptionType = reset($OptionType)->OptionType;
                $SmTopicNumber = reset($SmTopicNumber)->SmTopicNumber;
                $SmTopicContent = reset($SmTopicContent)->SmTopicContent;
                $SuitableAge = reset($SuitableAge)->SuitableAge;
                $OptionValue = reset($OptionValue)->OptionValue;
                $AdditionContent = reset($AdditionContent)->AdditionContent;
                $DetailData = array("SmTopicNumber" => $SmTopicNumber, "SmTopicContent" => $SmTopicContent, "SuitableAge" => $SuitableAge, "OptionType" => $OptionType, "OptionValue" => $OptionValue, "AdditionContent" => $AdditionContent, "FillTopic" => -1);

                array_push($QuestionPageDetailData, $DetailData);
            }
            for ($i = 0; $i < $RowNumber; $i++) {
                $QuestionPageDetailData[$i]['OptionValue'] = preg_split("/,/", $QuestionPageDetailData[$i]['OptionValue'], -1, PREG_SPLIT_NO_EMPTY);
                $QuestionPageDetailData[$i]['AdditionContent'] = preg_split("/,/", $QuestionPageDetailData[$i]['AdditionContent'], -1, PREG_SPLIT_NO_EMPTY);
            }
            $QuestionPageDetailData = array("Detail" => $QuestionPageDetailData);
            $QuestionPageData = array_merge($QuestionPageTitleData, $QuestionPageDetailData);
            array_push($QuestionnaireDetail, $QuestionPageData);
        }
        return $QuestionnaireDetail;
    }
    public function ReceiveQuestion($QuestionData)
    {
        //dd($QuestionData);
        /**
         * QuestionCode  
         * TeacherName Auth::username
         * SchoolCode Auth::userschool
         * ClassName
         * StudentCode
         * BigTopicNumber
         * Value 問卷小題所有答案 q1~qn 字串相加 while迴圈
         */
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
        $Filldate = (new GetDate)->GetToday();
        //檢查有沒有填寫紀錄
        $IfTopicFill = DB::table('questionstoretable')->select('StudentID')
            ->where('StudentID', $QuestionData['StudentID'])
            ->where('QuestionCode', $QuestionData['QuestionCode'])
            ->where('BigTopicNumber', $QuestionData['BigTopicNumber'])
            ->where('FillTime', $QuestionData['FillTime'])
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)->get()->toArray();
        if (count($IfTopicFill)) {
            try {
                DB::table('questionstoretable')
                    ->where('StudentID', $QuestionData['StudentID'])
                    ->where('FillTime', $QuestionData['FillTime'])
                    ->where('QuestionCode', $QuestionData['QuestionCode'])
                    ->where('BigTopicNumber', $QuestionData['BigTopicNumber'])
                    ->where('SchoolYear', $CurrentYear)
                    ->where('Semester', $Semester)
                    ->update([
                        'Value' => $QuestionData['Value']
                    ]);
                return true;
            } catch (\Illuminate\Database\QueryException $e) {
                return false;
            }
        } else {
            try {
                DB::table('questionstoretable')->insert([
                    'StudentID' => $QuestionData['StudentID'],
                    'QuestionCode' => $QuestionData['QuestionCode'],
                    'TeacherAccount' => $QuestionData['TeacherAccount'],
                    'BigTopicNumber' => $QuestionData['BigTopicNumber'],
                    'Value' => $QuestionData['Value'],
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'FillTime' => $QuestionData['FillTime'],
                    'FillDate' => $Filldate
                ]);
                return true;
            } catch (\Illuminate\Database\QueryException $e) {
                return false;
            }
        }



        /**
         * QuestionCode
         * TeacherName
         * SchoolCode
         * ClassCode
         * SchoolYear  自動算
         * Semester    自動算
         * StudentCode
         * BigTopicNumber
         * Value 問卷小題所有答案
         * FillDate 自動獲取當天日期
         */
    }
    public function GetQuestionnaire($QuestionCode = null)
    {
        if ($QuestionCode == null) {
            $Questionnaire = DB::table("questionnaireframework")->select("QuestionName", "QuestionCode")->get()->toArray(); //抓問卷名稱和代號
            return $Questionnaire;
        } else {
            $Questionnaire = DB::table("questionnaireframework")->select("QuestionName")->where("QuestionCode", $QuestionCode)->get()->toArray(); //抓問卷名稱和代號
            $QuestionName = $Questionnaire[0]->QuestionName;
            return $QuestionName;
        }
    }
    public function GetFillStatus($SchoolCode, $BasicData, $QuestionData, $CurrentYear, $Semester)
    { //獲取填寫次數以及當前填寫狀態，首頁使用
        /**
         * QuestionCode => QuestionData
         * Schoolcode => Auth::user
         * SchoolCode => SchoolCode
         * ClassName => BasicData
         * StudentCode => BasicData
         * Year => BasicData
         * Semester => Semester
         * SchoolYear => CurrentYear
         */

        /** 回傳資料格式
         * 問卷代碼
         *     入學學年
         *         班級名稱
         *             數量(人數)
         *                 姓名
         *                 座號
         *                 填寫狀態 (字串 已處理好的)
         *                 Value => 學年，班級，座號，姓名，年齡，填寫次數，填寫狀態
         */
        $ReturnBasicData = $BasicData;
        $ReturnArray = array();
        for ($i = 0; $i < count($QuestionData); $i++) {
            //獲取問卷代碼
            $QuestionCode = $QuestionData[$i]->QuestionCode;
            foreach ($BasicData as $year => $yeardata) { //把 BasicData 拆分為 Title=>yeardata 和 Array=>classname
                //$year => 當前學年
                $yeartitle = $year;
                $year = str_replace('年度', '', $year);
                foreach ($yeardata as $classname => $DetailData) { //把 yeardata 拆分為 Title=>classname 和 Array=>DetailData
                    //$classname => 班級名稱
                    $FillSelecter = DB::table("studentfillfinish")
                        ->where('QuestionCode', $QuestionCode)
                        ->where('SchoolYear', $CurrentYear)
                        ->where('Semester', $Semester);

                    for ($j = 0; $j < count($DetailData); $j++) { //學生數
                        $CloneSelecter = clone $FillSelecter;
                        $CheckIfData = $CloneSelecter->where('StudentID', $DetailData[$j]['ChildValue'])->get();
                        if ($CheckIfData->isEmpty()) { //無資料 沒有填過問卷
                            $DetailData[$j]['ChildValue'] .= "-0";
                            $FillStatus = array("FillStatus" => "尚未填寫過");
                            $DetailData[$j] = array_merge($DetailData[$j], $FillStatus);
                        } else {
                            $FillData = $CloneSelecter->select('FillTime', 'Finish')->get()->toArray();
                            $FillData = reset($FillData);
                            $FillTime = $FillData->FillTime;
                            $IfFinish = $FillData->Finish;
                            if ($IfFinish == 1) { //已經填寫完成，還沒進行下次填寫
                                $DetailData[$j]['ChildValue'] .= "-" . $FillTime . "-1";
                                $FillStr = "第" . $FillTime . "次問卷已完成";
                                $FillStatus = array("FillStatus" => $FillStr);
                                $DetailData[$j] = array_merge($DetailData[$j], $FillStatus);
                            }
                            if ($IfFinish == 0) { //正在填寫中
                                $DetailData[$j]['ChildValue'] .= "-" . $FillTime . "-0";
                                $FillStr = "第" . $FillTime . "次問卷進行中";
                                $FillStatus = array("FillStatus" => $FillStr);
                                $DetailData[$j] = array_merge($DetailData[$j], $FillStatus);
                            }
                        }
                    }
                    $ReturnBasicData[$yeartitle][$classname] = $DetailData; //把原本的陣列內容取代
                }
            };
            $QuestionArray = array("代號" . $QuestionCode => $ReturnBasicData);
            $ReturnArray = array_merge($ReturnArray, $QuestionArray);
        }
        return $ReturnArray;
    }
    public function GetFillTime($StudentID, $QuestionCode, $SchoolYear, $Semester)
    { //獲取已填寫完的填寫次數
        $FillData = DB::table('studentfillfinish')->select('FillTime', 'Finish')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $SchoolYear)
            ->where('Semester', $Semester)
            ->get()->toArray();
        $FillData = reset($FillData);
        $FillTime = $FillData->FillTime;
        $FillStatus = $FillData->Finish;
        if (((int)$FillStatus) == 0) { //最新一次未完成
            $FillTime = ((int)$FillTime) - 1;
        } else { //最新一次已完成
            $FillTime = (int)$FillTime;
        }
        return $FillTime;
    }
    public function GetFillDate($StudentID, $QuestionCode, $SchoolYear, $Semester, $FillTime)
    {
        $FillDate = DB::table('questionstoretable')->select('FillDate')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $SchoolYear)
            ->where('Semester', $Semester)
            ->where('FillTime', $FillTime)
            ->Limit(1)
            ->get()->toArray();
        $FillDate = $FillDate[0]->FillDate;
        return $FillDate;
    }
    public function UpdateFillStatus($QuestionCode, $StudentID, $FillTime, $FillStatus, $CurrentYear, $Semester)
    {
        //0 入學學年度 - 1 班級 - 2 座號 - 3 姓名 - 4 年齡 - 5 填寫次數 - 6 填寫狀態(次數為0時，無資料)
        $FillData = DB::table('studentfillfinish')->select('FillTime', 'Finish')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->get()->toArray();
        $FillData = reset($FillData);
        return $FillData;
    }
    public function InsertFillTime($QuestionCode, $StudentID, $FillTime, $CurrentYear, $Semester)
    {
        $FillTime += 1;
        $FillStatus = 0;
        try {
            DB::table('studentfillfinish')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'FillTime' => $FillTime,
                'Finish' => $FillStatus
            ]);
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }
    public function UpdateFillTime($QuestionCode, $StudentID, $FillTime, $FillStatus, $CurrentYear, $Semester)
    {
        if ($FillStatus == 0) { //填寫完畢確認送出後
            $FillStatus = 1;
        } else if ($FillStatus == 1) { //填寫新問卷
            $FillTime += 1;
            $FillStatus = 0;
        }

        try {
            DB::table('studentfillfinish')
                ->where('StudentID', $StudentID)
                ->where('QuestionCode', $QuestionCode)
                ->where('SchoolYear', $CurrentYear)
                ->where('Semester', $Semester)
                ->update([
                    'FillTime' => $FillTime,
                    'Finish' => $FillStatus,
                ]);
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }
    public function GetIngHistory($SearchData) //獲取還在進行(尚未完成)的問卷紀錄
    {
        $FillData = DB::table('questionstoretable')->select('*')
            ->where('StudentID', $SearchData["StudentID"])
            ->where('QuestionCode', $SearchData["QuestionCode"])
            ->where('TeacherName', $SearchData["TeacherName"])
            ->where('SchoolYear', $SearchData["SchoolYear"])
            ->where('Semester', $SearchData["Semester"])
            ->where("BigTopicNumber", $SearchData["BigTopicNumber"])
            ->where("FillTime", $SearchData["FillTime"])
            ->get()->toArray();
        if (count($FillData) == 0) {
            return null;
        } else {
            return $FillData;
        }
    }
    public function GetHistoryRecord($StudentID, $QuestionCode, $SchoolYear, $Semester, $FillTime) //獲取已經完成的問卷紀錄
    {
        $Record = DB::table('questionstoretable')->select('BigTopicNumber', 'Value')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $SchoolYear)
            ->where('Semester', $Semester)
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        return $Record;
    }
    public function CheckIfFinal($QuestionCode, $QuestionBigTopic)
    {
        //判斷問卷是否填寫到最後一大題
        try {
            //獲取問卷大題數
            $TopicQuantity = DB::table('questionnaireframework')
                ->select('QuestionQuantity')
                ->where('QuestionCode', $QuestionCode)
                ->get()->toArray();
            $TopicQuantity = reset($TopicQuantity)->QuestionQuantity;
            //如果當前大題數比總大題數還小，還沒填完
            //如果當前大題數等於總大題數，最後一大題
            if ($QuestionBigTopic >= intval($TopicQuantity)) {
                return true;
            } else {
                return false;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }
    public function GetQuestionnaireAns($StudentID, $QuestionCode, $FillTime, $CurrentYear, $Semester)
    {
        //先驗證，再計算？
        $GetTopicQuantity = DB::table('questionnaireframework')->select('QuestionQuantity')
            ->where('QuestionCode', $QuestionCode)
            ->get()->toArray();
        $AllData = DB::table('questionstoretable')->select('BigTopicNumber', 'Value')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        //驗證 判斷Value是否為空，再判斷是否填寫完了
        $TopicQuantity = reset($GetTopicQuantity)->QuestionQuantity;
        for ($i = 0; $i < intval($TopicQuantity); $i++) {
            if ($AllData[$i]->Value == "") { //有尚未填寫的
                return false;
            }
        }
        //驗證
        return $AllData;
    }
    public function CountQuestionnaire($StudentID, $QuestionCode, $FillTime, $data, $CurrentYear, $Semester)
    { //計算結果
        //獲取年齡
        $Age = DB::table('studentschooltable')->select('Age')->where('StudentID', $StudentID)->get()->toArray();
        $Age = reset($Age)->Age;
        //獲取學年學期

        //各項目使用
        $ThreePointByAge = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePoint = 0; //被評分為3分的總項目數(不限年齡)
        $FillByAge = 0; //根據年齡被評分的總項目數(年齡限制)	
        $AgeProficientPercent = 0.0; //根據年齡的精熟百分比
        $FillByAll = 0; //所有被評分的總項目數(不限年齡)
        $AllProficientPercent = 0.0; //精熟項目的百分比(不限年齡)

        //總分使用
        $All_ThreePoint = 0; //被評分為3分的總項目數(不限年齡)
        $All_FillByAge = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_AgeProficientPercent = 0.0; //根據年齡的精熟百分比
        $All_FillByAll = 0; //所有被評分的總項目數(不限年齡)
        $All_AllProficientPercent = 0.0; //精熟項目的百分比(不限年齡)

        for ($i = 0; $i < count($data); $i++) {
            $TopicValue = preg_split("/ /", $data[$i]->Value, -1, PREG_SPLIT_NO_EMPTY); //將Value用空格分割
            $TopicNumber = $data[$i]->BigTopicNumber;
            $FillByAll = count($TopicValue); //總填寫數
            for ($j = 0; $j < count($TopicValue); $j++) {
                $DetailValue = preg_split("/-/", $TopicValue[$j], -1, PREG_SPLIT_NO_EMPTY); //將Value用'-'分割
                //DetailValue[0] = 題數 q?
                //DetailValue[1] = 選項幾
                //DetailValue[2] = Value
                $Topic = str_replace("q", "", $DetailValue[0]); //題數去掉q
                $CheckAge = DB::table('questionnairecontent')->select('SuitableAge')
                    ->where('QuestionCode', $QuestionCode)
                    ->where('BigTopicNumber', $TopicNumber)
                    ->where('SmTopicNumber', $Topic)->get()->toArray();
                $CheckAge = reset($CheckAge)->SuitableAge;
                if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                    $ThreePoint += 1;
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $ThreePointByAge += 1;
                    }
                }
                if (intval($Age) >= intval($CheckAge)) { //年齡有到
                    $FillByAge += 1;
                }
            }
            if($FillByAge > 0){
                $AgeProficientPercent = round(($ThreePoint / $FillByAge) * 100, 2); //四捨五入，取到小數點後第一位
            }
            if($FillByAll > 0){
                $AllProficientPercent = round(($ThreePoint / $FillByAll) * 100, 2); //四捨五入，取到小數點後第一位
            }
            //輸入資料到資料庫
            if ($FillByAge >= 3) { //填寫數3項以上，列入計算
                try {
                    DB::table('questionbasicgrade')->insert([
                        'StudentID' => $StudentID,
                        'QuestionCode' => $QuestionCode,
                        'SchoolYear' => $CurrentYear,
                        'Semester' => $Semester,
                        'BigTopicNumber' => $TopicNumber,
                        'ThreePoint' => $ThreePoint,
                        'FillByAge' => $FillByAge,
                        'AgeProficientPercent' => $AgeProficientPercent,
                        'FillByAll' => $FillByAll,
                        'AllProficientPercent' => $AllProficientPercent,
                        'FillTime' => $FillTime,
                    ]);
                    
                } catch (\Illuminate\Database\QueryException $e) {
                    return false;
                }
                //疊加到總和
                $All_ThreePoint += $ThreePoint;
                $All_FillByAge += $FillByAge;
                $All_FillByAll += $FillByAll;
            } else { //填寫數未到3項以上，不列入計算
                try {
                    DB::table('questionbasicgrade')->insert([
                        'StudentID' => $StudentID,
                        'QuestionCode' => $QuestionCode,
                        'SchoolYear' => $CurrentYear,
                        'Semester' => $Semester,
                        'BigTopicNumber' => $TopicNumber,
                        'ThreePoint' => 0,
                        'FillByAge' => 0,
                        'AgeProficientPercent' => 0,
                        'FillByAll' => 0,
                        'AllProficientPercent' => 0,
                        'FillTime' =>  $FillTime,
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return false;
                }
            }
            //清空
            $ThreePointByAge = 0;
            $ThreePoint = 0;
            $FillByAge = 0;
            $AgeProficientPercent = 0.0;
            $FillByAll = 0;
            $AllProficientPercent = 0.0;
        }
        if($All_FillByAge > 0)
            $All_AgeProficientPercent = round(($All_ThreePoint / $All_FillByAge) * 100, 2);
        if($All_FillByAll > 0)
            $All_AllProficientPercent = round(($All_ThreePoint / $All_FillByAll) * 100, 2);

        try {
            DB::table('questionbasicgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'ThreePoint' => $All_ThreePoint,
                'FillByAge' => $All_FillByAge,
                'AgeProficientPercent' => $All_AgeProficientPercent,
                'FillByAll' => $All_FillByAll,
                'AllProficientPercent' => $All_AllProficientPercent,
                'FillTime' => $FillTime,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
        return true;
    }
    public function CountDetailGrade($StudentID, $QuestionCode, $FillTime, $data, $CurrentYear, $Semester)
    {
        $Age = DB::table('studentschooltable')->select('Age')->where('StudentID', $StudentID)->get()->toArray();
        $Age = reset($Age)->Age;
        //獲取學年學期

        //各項目使用 Func
        $ThreePointByAge_E = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_I = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_SR = 0; //被評分為3分的總項目數(年齡限制)

        $ThreePoint_E = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_I = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_SR = 0; //被評分為3分的總項目數(不限年齡)

        $FillByAge_E = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_I = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_SR = 0; //根據年齡被評分的總項目數(年齡限制)	

        $AgeProficientPercent_E = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_I = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_SR = 0.0; //根據年齡的精熟百分比

        $FillByAll_E = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_I = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_SR = 0; //所有被評分的總項目數(不限年齡)

        $AllProficientPercent_E = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_I = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_SR = 0.0; //精熟項目的百分比(不限年齡)
        //總分使用 Func
        $All_ThreePoint_Func_E = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Func_I = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Func_SR = 0; //被評分為3分的總項目數(不限年齡)

        $All_FillByAge_Func_E = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Func_I = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Func_SR = 0; //根據年齡被評分的總項目數(年齡限制)

        $All_AgeProficientPercent_Func_E = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Func_I = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Func_SR = 0.0; //根據年齡的精熟百分比

        $All_FillByAll_Func_E = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Func_I = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Func_SR = 0; //所有被評分的總項目數(不限年齡)

        $All_AllProficientPercent_Func_E = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Func_I = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Func_SR = 0.0; //精熟項目的百分比(不限年齡)

        //各項目使用 Dev
        $ThreePointByAge_A = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_CG = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_CM = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_M = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_S = 0; //被評分為3分的總項目數(年齡限制)

        $ThreePoint_A = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_CG = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_CM = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_M = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_S = 0; //被評分為3分的總項目數(不限年齡)

        $FillByAge_A = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_CG = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_CM = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_M = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_S = 0; //根據年齡被評分的總項目數(年齡限制)	

        $AgeProficientPercent_A = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_CG = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_CM = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_M = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_S = 0.0; //根據年齡的精熟百分比

        $FillByAll_A = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_CG = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_CM = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_M = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_S = 0; //所有被評分的總項目數(不限年齡)

        $AllProficientPercent_A = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_CG = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_CM = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_M = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_S = 0.0; //精熟項目的百分比(不限年齡)
        //總分使用 Dev
        $All_ThreePoint_Dev_A = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Dev_CG = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Dev_CM = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Dev_M = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Dev_S = 0; //被評分為3分的總項目數(不限年齡)

        $All_FillByAge_Dev_A = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Dev_CG = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Dev_CM = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Dev_M = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Dev_S = 0; //根據年齡被評分的總項目數(年齡限制)

        $All_AgeProficientPercent_Dev_A = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Dev_CG = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Dev_CM = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Dev_M = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Dev_S = 0.0; //根據年齡的精熟百分比

        $All_FillByAll_Dev_A = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Dev_CG = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Dev_CM = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Dev_M = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Dev_S = 0; //所有被評分的總項目數(不限年齡)

        $All_AllProficientPercent_Dev_A = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Dev_CG = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Dev_CM = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Dev_M = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Dev_S = 0.0; //精熟項目的百分比(不限年齡)

        //各項目使用 Out
        $ThreePointByAge_One = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_Two = 0; //被評分為3分的總項目數(年齡限制)
        $ThreePointByAge_Three = 0; //被評分為3分的總項目數(年齡限制)

        $ThreePoint_One = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_Two = 0; //被評分為3分的總項目數(不限年齡)
        $ThreePoint_Three = 0; //被評分為3分的總項目數(不限年齡)

        $FillByAge_One = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_Two = 0; //根據年齡被評分的總項目數(年齡限制)	
        $FillByAge_Three = 0; //根據年齡被評分的總項目數(年齡限制)	

        $AgeProficientPercent_One = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_Two = 0.0; //根據年齡的精熟百分比
        $AgeProficientPercent_Three = 0.0; //根據年齡的精熟百分比

        $FillByAll_One = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_Two = 0; //所有被評分的總項目數(不限年齡)
        $FillByAll_Three = 0; //所有被評分的總項目數(不限年齡)

        $AllProficientPercent_One = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_Two = 0.0; //精熟項目的百分比(不限年齡)
        $AllProficientPercent_Three = 0.0; //精熟項目的百分比(不限年齡)
        //總分使用 Out
        $All_ThreePoint_Out_One = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Out_Two = 0; //被評分為3分的總項目數(不限年齡)
        $All_ThreePoint_Out_Three = 0; //被評分為3分的總項目數(不限年齡)

        $All_FillByAge_Out_One = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Out_Two = 0; //根據年齡被評分的總項目數(年齡限制)
        $All_FillByAge_Out_Three = 0; //根據年齡被評分的總項目數(年齡限制)

        $All_AgeProficientPercent_Out_One = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Out_Two = 0.0; //根據年齡的精熟百分比
        $All_AgeProficientPercent_Out_Three = 0.0; //根據年齡的精熟百分比

        $All_FillByAll_Out_One = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Out_Two = 0; //所有被評分的總項目數(不限年齡)
        $All_FillByAll_Out_Three = 0; //所有被評分的總項目數(不限年齡)

        $All_AllProficientPercent_Out_One = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Out_Two = 0.0; //精熟項目的百分比(不限年齡)
        $All_AllProficientPercent_Out_Three = 0.0; //精熟項目的百分比(不限年齡)


        for ($i = 0; $i < count($data); $i++) {
            $TopicValue = preg_split("/ /", $data[$i]->Value, -1, PREG_SPLIT_NO_EMPTY); //將Value用空格分割
            $TopicNumber = $data[$i]->BigTopicNumber;
            //計算有填寫總數
            for ($j = 0; $j < count($TopicValue); $j++) {
                $DetailValue = preg_split("/-/", $TopicValue[$j], -1, PREG_SPLIT_NO_EMPTY); //將Value用'-'分割
                //DetailValue[0] = 題數 q?
                //DetailValue[1] = 選項幾
                //DetailValue[2] = Value
                $Topic = str_replace("q", "", $DetailValue[0]); //題數去掉q
                $CheckAge = DB::table('questionnairecontent')->select('SuitableAge')
                    ->where('QuestionCode', $QuestionCode)
                    ->where('BigTopicNumber', $TopicNumber)
                    ->where('SmTopicNumber', $Topic)->get()->toArray();
                $CheckAge = reset($CheckAge)->SuitableAge;
                $GetAdditionContent = DB::table('questionnairecontent')->select('AdditionContent')
                    ->where('QuestionCode', $QuestionCode)
                    ->where('BigTopicNumber', $TopicNumber)
                    ->where('SmTopicNumber', $Topic)->get()->toArray();
                $AdditionContent = reset($GetAdditionContent)->AdditionContent;
                $DetailContent = preg_split("/,/", $AdditionContent, -1, PREG_SPLIT_NO_EMPTY);
                //DetailContent[0] = Func 值(E,I,SR)
                //DetailContent[1] = Dev 值(A,CG,CM,M,S)
                //DetailContent[2] = Out 值(1,2,3)

                //DetailContent[0] (E,I,SR)
                if ($DetailContent[0] == "E") { //Func 為 E
                    //$FillByAll_E += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_E += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_E += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_E += 1;
                    }
                }
                if ($DetailContent[0] == "I") { //Func 為 I
                    //$FillByAll_I += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_I += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_I += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_I += 1;
                    }
                }
                if ($DetailContent[0] == "SR") { //Func 為 SR
                    //$FillByAll_SR += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_SR += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_SR += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_SR += 1;
                    }
                }

                //DetailContent[1] (A,CG,CM,M,S)
                if ($DetailContent[1] == "A") { //Func 為 SR
                    //$FillByAll_A += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_A += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_A += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_A += 1;
                    }
                }
                if ($DetailContent[1] == "CG") { //Func 為 SR
                    //$FillByAll_CG += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_CG += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_CG += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_CG += 1;
                    }
                }
                if ($DetailContent[1] == "CM") { //Func 為 SR
                    //$FillByAll_CM += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_CM += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_CM += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_CM += 1;
                    }
                }
                if ($DetailContent[1] == "M") { //Func 為 SR
                    //$FillByAll_M += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_M += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_M += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_M += 1;
                    }
                }
                if ($DetailContent[1] == "S") { //Func 為 SR
                    //$FillByAll_S += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_S += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_S += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_S += 1;
                    }
                }

                //DetailContent[2] (1,2,3)
                if ($DetailContent[2] == "1") { //Func 為 SR
                    //$FillByAll_One += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_One += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_One += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_One += 1;
                    }
                }
                if ($DetailContent[2] == "2") { //Func 為 SR
                    //$FillByAll_Two += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_Two += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_Two += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_Two += 1;
                    }
                }
                if ($DetailContent[2] == "3") { //Func 為 SR
                    //$FillByAll_Three += 1;
                    if (intval($DetailValue[2]) == 3) { //所有被評分為3分的
                        $ThreePoint_Three += 1;
                        if (intval($Age) >= intval($CheckAge)) { //年齡有到
                            $ThreePointByAge_Three += 1;
                        }
                    }
                    if (intval($Age) >= intval($CheckAge)) { //年齡有到
                        $FillByAge_Three += 1;
                    }
                }
            }
            //計算總數
            $SmTopicQuantity = DB::table('questionnairecontent')->select('AdditionContent')
                ->where('QuestionCode', $QuestionCode)
                ->where('BigTopicNumber', $TopicNumber)
                ->get()->toArray();
            for ($j = 0; $j < count($SmTopicQuantity); $j++) {
                $AdditionContent = $SmTopicQuantity[$j]->AdditionContent;
                $DetailContent = preg_split("/,/", $AdditionContent, -1, PREG_SPLIT_NO_EMPTY);
                if ($DetailContent[0] == "E") { //Func 為 E
                    $FillByAll_E += 1;
                }
                if ($DetailContent[0] == "I") { //Func 為 I
                    $FillByAll_I += 1;
                }
                if ($DetailContent[0] == "SR") { //Func 為 SR
                    $FillByAll_SR += 1;
                }

                //DetailContent[1] (A,CG,CM,M,S)
                if ($DetailContent[1] == "A") { //Func 為 SR
                    $FillByAll_A += 1;
                }
                if ($DetailContent[1] == "CG") { //Func 為 SR
                    $FillByAll_CG += 1;
                }
                if ($DetailContent[1] == "CM") { //Func 為 SR
                    $FillByAll_CM += 1;
                }
                if ($DetailContent[1] == "M") { //Func 為 SR
                    $FillByAll_M += 1;
                }
                if ($DetailContent[1] == "S") { //Func 為 SR
                    $FillByAll_S += 1;
                }

                //DetailContent[2] (1,2,3)
                if ($DetailContent[2] == "1") { //Func 為 SR
                    $FillByAll_One += 1;
                }
                if ($DetailContent[2] == "2") { //Func 為 SR
                    $FillByAll_Two += 1;
                }
                if ($DetailContent[2] == "3") { //Func 為 SR
                    $FillByAll_Three += 1;
                }
            }

            //DetailContent[0] (E,I,SR)
            if ($FillByAge_E > 0)
                $AgeProficientPercent_E = round(($ThreePoint_E / $FillByAge_E) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_I > 0)
                $AgeProficientPercent_I = round(($ThreePoint_I / $FillByAge_I) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_SR > 0)
                $AgeProficientPercent_SR = round(($ThreePoint_SR / $FillByAge_SR) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_E > 0)
                $AllProficientPercent_E = round(($ThreePoint_E / $FillByAll_E) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_I > 0)
                $AllProficientPercent_I = round(($ThreePoint_I / $FillByAll_I) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_SR > 0)
                $AllProficientPercent_SR = round(($ThreePoint_SR / $FillByAll_SR) * 100, 2); //四捨五入，取到小數點後第二位

            //DetailContent[1] (A,CG,CM,M,S)
            if ($FillByAge_A > 0)
                $AgeProficientPercent_A = round(($ThreePoint_A / $FillByAge_A) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_CG > 0)
                $AgeProficientPercent_CG = round(($ThreePoint_CG / $FillByAge_CG) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_CM > 0)
                $AgeProficientPercent_CM = round(($ThreePoint_CM / $FillByAge_CM) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_M > 0)
                $AgeProficientPercent_M = round(($ThreePoint_M / $FillByAge_M) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_S > 0)
                $AgeProficientPercent_S = round(($ThreePoint_S / $FillByAge_S) * 100, 2); //四捨五入，取到小數點後第二位

            if ($FillByAll_A > 0)
                $AllProficientPercent_A = round(($ThreePoint_A / $FillByAll_A) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_CG > 0)
                $AllProficientPercent_CG = round(($ThreePoint_CG / $FillByAll_CG) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_CM > 0)
                $AllProficientPercent_CM = round(($ThreePoint_CM / $FillByAll_CM) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_M > 0)
                $AllProficientPercent_M = round(($ThreePoint_M / $FillByAll_M) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_S > 0)
                $AllProficientPercent_S = round(($ThreePoint_S / $FillByAll_S) * 100, 2); //四捨五入，取到小數點後第二位

            //DetailContent[2] (1,2,3)
            if ($FillByAge_One > 0)
                $AgeProficientPercent_One = round(($ThreePoint_One / $FillByAge_One) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_Two > 0)
                $AgeProficientPercent_Two = round(($ThreePoint_Two / $FillByAge_Two) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAge_Three > 0)
                $AgeProficientPercent_Three = round(($ThreePoint_Three / $FillByAge_Three) * 100, 2); //四捨五入，取到小數點後第二位

            if ($FillByAll_One > 0)
                $AllProficientPercent_One = round(($ThreePoint_One / $FillByAll_One) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_Two > 0)
                $AllProficientPercent_Two = round(($ThreePoint_Two / $FillByAll_Two) * 100, 2); //四捨五入，取到小數點後第二位
            if ($FillByAll_Three > 0)
                $AllProficientPercent_Three = round(($ThreePoint_Three / $FillByAll_Three) * 100, 2); //四捨五入，取到小數點後第二位
            //輸入資料到資料庫
            //DetailContent[0] (E,I,SR)
            try {
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Func",
                    'DetailName' => "E",
                    'ThreePoint' => $ThreePoint_E,
                    'FillByAge' => $FillByAge_E,
                    'AgeProficientPercent' => $AgeProficientPercent_E,
                    'FillByAll' => $FillByAll_E,
                    'AllProficientPercent' => $AllProficientPercent_E,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Func",
                    'DetailName' => "I",
                    'ThreePoint' => $ThreePoint_I,
                    'FillByAge' => $FillByAge_I,
                    'AgeProficientPercent' => $AgeProficientPercent_I,
                    'FillByAll' => $FillByAll_I,
                    'AllProficientPercent' => $AllProficientPercent_I,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Func",
                    'DetailName' => "SR",
                    'ThreePoint' => $ThreePoint_SR,
                    'FillByAge' => $FillByAge_SR,
                    'AgeProficientPercent' => $AgeProficientPercent_SR,
                    'FillByAll' => $FillByAll_SR,
                    'AllProficientPercent' => $AllProficientPercent_SR,
                    'FillTime' => $FillTime,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return false;
            }
            //疊加到總和
            $All_ThreePoint_Func_E += $ThreePoint_E;
            $All_ThreePoint_Func_I += $ThreePoint_I;
            $All_ThreePoint_Func_SR += $ThreePoint_SR;

            $All_FillByAge_Func_E += $FillByAge_E;
            $All_FillByAge_Func_I += $FillByAge_I;
            $All_FillByAge_Func_SR += $FillByAge_SR;

            $All_FillByAll_Func_E += $FillByAll_E;
            $All_FillByAll_Func_I += $FillByAll_I;
            $All_FillByAll_Func_SR += $FillByAll_SR;
            //清空
            $ThreePointByAge_E = 0;
            $ThreePointByAge_I = 0;
            $ThreePointByAge_SR = 0;

            $ThreePoint_E = 0;
            $ThreePoint_I = 0;
            $ThreePoint_SR = 0;

            $FillByAge_E = 0;
            $FillByAge_I = 0;
            $FillByAge_SR = 0;

            $AgeProficientPercent_E = 0.0;
            $AgeProficientPercent_I = 0.0;
            $AgeProficientPercent_SR = 0.0;

            $FillByAll_E = 0;
            $FillByAll_I = 0;
            $FillByAll_SR = 0;

            $AllProficientPercent_E = 0.0;
            $AllProficientPercent_I = 0.0;
            $AllProficientPercent_SR = 0.0;

            //DetailContent[1] (A,CG,CM,M,S)
            try {
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Dev",
                    'DetailName' => "A",
                    'ThreePoint' => $ThreePoint_A,
                    'FillByAge' => $FillByAge_A,
                    'AgeProficientPercent' => $AgeProficientPercent_A,
                    'FillByAll' => $FillByAll_A,
                    'AllProficientPercent' => $AllProficientPercent_A,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Dev",
                    'DetailName' => "CG",
                    'ThreePoint' => $ThreePoint_CG,
                    'FillByAge' => $FillByAge_CG,
                    'AgeProficientPercent' => $AgeProficientPercent_CG,
                    'FillByAll' => $FillByAll_CG,
                    'AllProficientPercent' => $AllProficientPercent_CG,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Dev",
                    'DetailName' => "CM",
                    'ThreePoint' => $ThreePoint_CM,
                    'FillByAge' => $FillByAge_CM,
                    'AgeProficientPercent' => $AgeProficientPercent_CM,
                    'FillByAll' => $FillByAll_CM,
                    'AllProficientPercent' => $AllProficientPercent_CM,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Dev",
                    'DetailName' => "M",
                    'ThreePoint' => $ThreePoint_M,
                    'FillByAge' => $FillByAge_M,
                    'AgeProficientPercent' => $AgeProficientPercent_M,
                    'FillByAll' => $FillByAll_M,
                    'AllProficientPercent' => $AllProficientPercent_M,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Dev",
                    'DetailName' => "S",
                    'ThreePoint' => $ThreePoint_S,
                    'FillByAge' => $FillByAge_S,
                    'AgeProficientPercent' => $AgeProficientPercent_S,
                    'FillByAll' => $FillByAll_S,
                    'AllProficientPercent' => $AllProficientPercent_S,
                    'FillTime' => $FillTime,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return false;
            }
            //疊加到總和
            $All_ThreePoint_Dev_A += $ThreePoint_A;
            $All_ThreePoint_Dev_CG += $ThreePoint_CG;
            $All_ThreePoint_Dev_CM += $ThreePoint_CM;
            $All_ThreePoint_Dev_M += $ThreePoint_M;
            $All_ThreePoint_Dev_S += $ThreePoint_S;

            $All_FillByAge_Dev_A += $FillByAge_A;
            $All_FillByAge_Dev_CG += $FillByAge_CG;
            $All_FillByAge_Dev_CM += $FillByAge_CM;
            $All_FillByAge_Dev_M += $FillByAge_M;
            $All_FillByAge_Dev_S += $FillByAge_S;

            $All_FillByAll_Dev_A += $FillByAll_A;
            $All_FillByAll_Dev_CG += $FillByAll_CG;
            $All_FillByAll_Dev_CM += $FillByAll_CM;
            $All_FillByAll_Dev_M += $FillByAll_M;
            $All_FillByAll_Dev_S += $FillByAll_S;

            //清空
            $ThreePointByAge_A = 0;
            $ThreePointByAge_CG = 0;
            $ThreePointByAge_CM = 0;
            $ThreePointByAge_M = 0;
            $ThreePointByAge_S = 0;

            $ThreePoint_A = 0;
            $ThreePoint_CG = 0;
            $ThreePoint_CM = 0;
            $ThreePoint_M = 0;
            $ThreePoint_S = 0;

            $FillByAge_A = 0;
            $FillByAge_CG = 0;
            $FillByAge_CM = 0;
            $FillByAge_M = 0;
            $FillByAge_S = 0;

            $AgeProficientPercent_A = 0.0;
            $AgeProficientPercent_CG = 0.0;
            $AgeProficientPercent_CM = 0.0;
            $AgeProficientPercent_M = 0.0;
            $AgeProficientPercent_S = 0.0;

            $FillByAll_A = 0;
            $FillByAll_CG = 0;
            $FillByAll_CM = 0;
            $FillByAll_M = 0;
            $FillByAll_S = 0;

            $AllProficientPercent_A = 0.0;
            $AllProficientPercent_CG = 0.0;
            $AllProficientPercent_CM = 0.0;
            $AllProficientPercent_M = 0.0;
            $AllProficientPercent_S = 0.0;

            //DetailContent[2] (1,2,3)
            try {
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Out",
                    'DetailName' => "1",
                    'ThreePoint' => $ThreePoint_One,
                    'FillByAge' => $FillByAge_One,
                    'AgeProficientPercent' => $AgeProficientPercent_One,
                    'FillByAll' => $FillByAll_One,
                    'AllProficientPercent' => $AllProficientPercent_One,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Out",
                    'DetailName' => "2",
                    'ThreePoint' => $ThreePoint_Two,
                    'FillByAge' => $FillByAge_Two,
                    'AgeProficientPercent' => $AgeProficientPercent_Two,
                    'FillByAll' => $FillByAll_Two,
                    'AllProficientPercent' => $AllProficientPercent_Two,
                    'FillTime' => $FillTime,
                ]);
                DB::table('questiondetailgrade')->insert([
                    'StudentID' => $StudentID,
                    'QuestionCode' => $QuestionCode,
                    'SchoolYear' => $CurrentYear,
                    'Semester' => $Semester,
                    'BigTopicNumber' => $TopicNumber,
                    'Category' => "Out",
                    'DetailName' => "3",
                    'ThreePoint' => $ThreePoint_Three,
                    'FillByAge' => $FillByAge_Three,
                    'AgeProficientPercent' => $AgeProficientPercent_Three,
                    'FillByAll' => $FillByAll_Three,
                    'AllProficientPercent' => $AllProficientPercent_Three,
                    'FillTime' => $FillTime,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return false;
            }
            //疊加到總和
            $All_ThreePoint_Out_One += $ThreePoint_One;
            $All_ThreePoint_Out_Two += $ThreePoint_Two;
            $All_ThreePoint_Out_Three += $ThreePoint_Three;

            $All_FillByAge_Out_One += $FillByAge_One;
            $All_FillByAge_Out_Two += $FillByAge_Two;
            $All_FillByAge_Out_Three += $FillByAge_Three;

            $All_FillByAll_Out_One += $FillByAll_One;
            $All_FillByAll_Out_Two += $FillByAll_Two;
            $All_FillByAll_Out_Three += $FillByAll_Three;
            //清空
            $ThreePointByAge_One = 0;
            $ThreePointByAge_Two = 0;
            $ThreePointByAge_Three = 0;

            $ThreePoint_One = 0;
            $ThreePoint_Two = 0;
            $ThreePoint_Three = 0;

            $FillByAge_One = 0;
            $FillByAge_Two = 0;
            $FillByAge_Three = 0;

            $AgeProficientPercent_One = 0.0;
            $AgeProficientPercent_Two = 0.0;
            $AgeProficientPercent_Three = 0.0;

            $FillByAll_One = 0;
            $FillByAll_Two = 0;
            $FillByAll_Three = 0;

            $AllProficientPercent_One = 0.0;
            $AllProficientPercent_Two = 0.0;
            $AllProficientPercent_Three = 0.0;
        }
        if ($All_FillByAge_Func_E > 0)
            $All_AgeProficientPercent_Func_E = round(($All_ThreePoint_Func_E / $All_FillByAge_Func_E) * 100, 1);
        if ($All_FillByAge_Func_I > 0)
            $All_AgeProficientPercent_Func_I = round(($All_ThreePoint_Func_I / $All_FillByAge_Func_I) * 100, 1);
        if ($All_FillByAge_Func_SR > 0)
            $All_AgeProficientPercent_Func_SR = round(($All_ThreePoint_Func_SR / $All_FillByAge_Func_SR) * 100, 1);

        if ($All_FillByAge_Dev_A > 0)
            $All_AgeProficientPercent_Dev_A = round(($All_ThreePoint_Dev_A / $All_FillByAge_Dev_A) * 100, 1);
        if ($All_FillByAge_Dev_CG > 0)
            $All_AgeProficientPercent_Dev_CG = round(($All_ThreePoint_Dev_CG / $All_FillByAge_Dev_CG) * 100, 1);
        if ($All_FillByAge_Dev_CM > 0)
            $All_AgeProficientPercent_Dev_CM = round(($All_ThreePoint_Dev_CM / $All_FillByAge_Dev_CM) * 100, 1);
        if ($All_FillByAge_Dev_M > 0)
            $All_AgeProficientPercent_Dev_M = round(($All_ThreePoint_Dev_M / $All_FillByAge_Dev_M) * 100, 1);
        if ($All_FillByAge_Dev_S > 0)
            $All_AgeProficientPercent_Dev_S = round(($All_ThreePoint_Dev_S / $All_FillByAge_Dev_S) * 100, 1);

        if ($All_FillByAge_Out_One > 0)
            $All_AgeProficientPercent_Out_One = round(($All_ThreePoint_Out_One / $All_FillByAge_Out_One) * 100, 1);
        if ($All_FillByAge_Out_Two > 0)
            $All_AgeProficientPercent_Out_Two = round(($All_ThreePoint_Out_Two / $All_FillByAge_Out_Two) * 100, 1);
        if ($All_FillByAge_Out_Three > 0)
            $All_AgeProficientPercent_Out_Three = round(($All_ThreePoint_Out_Three / $All_FillByAge_Out_Three) * 100, 1);

        if ($All_FillByAll_Func_E > 0)
            $All_AllProficientPercent_Func_E = round(($All_ThreePoint_Func_E / $All_FillByAll_Func_E) * 100, 1);
        if ($All_FillByAll_Func_I > 0)
            $All_AllProficientPercent_Func_I = round(($All_ThreePoint_Func_I / $All_FillByAll_Func_I) * 100, 1);
        if ($All_FillByAll_Func_SR > 0)
            $All_AllProficientPercent_Func_SR = round(($All_ThreePoint_Func_SR / $All_FillByAll_Func_SR) * 100, 1);

        if ($All_FillByAll_Dev_A > 0)
            $All_AllProficientPercent_Dev_A = round(($All_ThreePoint_Dev_A / $All_FillByAll_Dev_A) * 100, 1);
        if ($All_FillByAll_Dev_CG > 0)
            $All_AllProficientPercent_Dev_CG = round(($All_ThreePoint_Dev_CG / $All_FillByAll_Dev_CG) * 100, 1);
        if ($All_FillByAll_Dev_CM > 0)
            $All_AllProficientPercent_Dev_CM = round(($All_ThreePoint_Dev_CM / $All_FillByAll_Dev_CM) * 100, 1);
        if ($All_FillByAll_Dev_M > 0)
            $All_AllProficientPercent_Dev_M = round(($All_ThreePoint_Dev_M / $All_FillByAll_Dev_M) * 100, 1);
        if ($All_FillByAll_Dev_S > 0)
            $All_AllProficientPercent_Dev_S = round(($All_ThreePoint_Dev_S / $All_FillByAll_Dev_S) * 100, 1);

        if ($All_FillByAll_Out_One > 0)
            $All_AllProficientPercent_Out_One = round(($All_ThreePoint_Out_One / $All_FillByAll_Out_One) * 100, 1);
        if ($All_FillByAll_Out_Two > 0)
            $All_AllProficientPercent_Out_Two = round(($All_ThreePoint_Out_Two / $All_FillByAll_Out_Two) * 100, 1);
        if ($All_FillByAll_Out_Three > 0)
            $All_AllProficientPercent_Out_Three = round(($All_ThreePoint_Out_Three / $All_FillByAll_Out_Three) * 100, 1);

        try {
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Func",
                'DetailName' => "E",
                'ThreePoint' => $All_ThreePoint_Func_E,
                'FillByAge' => $All_FillByAge_Func_E,
                'AgeProficientPercent' => $All_AgeProficientPercent_Func_E,
                'FillByAll' => $All_FillByAll_Func_E,
                'AllProficientPercent' => $All_AllProficientPercent_Func_E,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Func",
                'DetailName' => "I",
                'ThreePoint' => $All_ThreePoint_Func_I,
                'FillByAge' => $All_FillByAge_Func_I,
                'AgeProficientPercent' => $All_AgeProficientPercent_Func_I,
                'FillByAll' => $All_FillByAll_Func_I,
                'AllProficientPercent' => $All_AllProficientPercent_Func_I,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Func",
                'DetailName' => "SR",
                'ThreePoint' => $All_ThreePoint_Func_SR,
                'FillByAge' => $All_FillByAge_Func_SR,
                'AgeProficientPercent' => $All_AgeProficientPercent_Func_SR,
                'FillByAll' => $All_FillByAll_Func_SR,
                'AllProficientPercent' => $All_AllProficientPercent_Func_SR,
                'FillTime' => $FillTime,
            ]);

            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Dev",
                'DetailName' => "A",
                'ThreePoint' => $All_ThreePoint_Dev_A,
                'FillByAge' => $All_FillByAge_Dev_A,
                'AgeProficientPercent' => $All_AgeProficientPercent_Dev_A,
                'FillByAll' => $All_FillByAll_Dev_A,
                'AllProficientPercent' => $All_AllProficientPercent_Dev_A,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Dev",
                'DetailName' => "CG",
                'ThreePoint' => $All_ThreePoint_Dev_CG,
                'FillByAge' => $All_FillByAge_Dev_CG,
                'AgeProficientPercent' => $All_AgeProficientPercent_Dev_CG,
                'FillByAll' => $All_FillByAll_Dev_CG,
                'AllProficientPercent' => $All_AllProficientPercent_Dev_CG,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Dev",
                'DetailName' => "CM",
                'ThreePoint' => $All_ThreePoint_Dev_CM,
                'FillByAge' => $All_FillByAge_Dev_CM,
                'AgeProficientPercent' => $All_AgeProficientPercent_Dev_CM,
                'FillByAll' => $All_FillByAll_Dev_CM,
                'AllProficientPercent' => $All_AllProficientPercent_Dev_CM,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Dev",
                'DetailName' => "M",
                'ThreePoint' => $All_ThreePoint_Dev_M,
                'FillByAge' => $All_FillByAge_Dev_M,
                'AgeProficientPercent' => $All_AgeProficientPercent_Dev_M,
                'FillByAll' => $All_FillByAll_Dev_M,
                'AllProficientPercent' => $All_AllProficientPercent_Dev_M,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Dev",
                'DetailName' => "S",
                'ThreePoint' => $All_ThreePoint_Dev_S,
                'FillByAge' => $All_FillByAge_Dev_S,
                'AgeProficientPercent' => $All_AgeProficientPercent_Dev_S,
                'FillByAll' => $All_FillByAll_Dev_S,
                'AllProficientPercent' => $All_AllProficientPercent_Dev_S,
                'FillTime' => $FillTime,
            ]);

            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Out",
                'DetailName' => "1",
                'ThreePoint' => $All_ThreePoint_Out_One,
                'FillByAge' => $All_FillByAge_Out_One,
                'AgeProficientPercent' => $All_AgeProficientPercent_Out_One,
                'FillByAll' => $All_FillByAll_Out_One,
                'AllProficientPercent' => $All_AllProficientPercent_Out_One,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Out",
                'DetailName' => "2",
                'ThreePoint' => $All_ThreePoint_Out_Two,
                'FillByAge' => $All_FillByAge_Out_Two,
                'AgeProficientPercent' => $All_AgeProficientPercent_Out_Two,
                'FillByAll' => $All_FillByAll_Out_Two,
                'AllProficientPercent' => $All_AllProficientPercent_Out_Two,
                'FillTime' => $FillTime,
            ]);
            DB::table('questiondetailgrade')->insert([
                'StudentID' => $StudentID,
                'QuestionCode' => $QuestionCode,
                'SchoolYear' => $CurrentYear,
                'Semester' => $Semester,
                'BigTopicNumber' => 0,
                'Category' => "Out",
                'DetailName' => "3",
                'ThreePoint' => $All_ThreePoint_Out_Three,
                'FillByAge' => $All_FillByAge_Out_Three,
                'AgeProficientPercent' => $All_AgeProficientPercent_Out_Three,
                'FillByAll' => $All_FillByAll_Out_Three,
                'AllProficientPercent' => $All_AllProficientPercent_Out_Three,
                'FillTime' => $FillTime,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
        return true;
    }
    public function GetGradeData($StudentID, $QuestionCode, $FillTime, $CurrentYear, $Semester)
    {
        $data = DB::table('questionbasicgrade')->select('BigTopicNumber', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $TopicNameArray = array();
        array_push($TopicNameArray, "總和");
        for ($i = 1; $i < count($data); $i++) { //獲取大題名稱
            $TopicName = DB::table('questionnairecontent')->select('BigTopicName')
                ->where('QuestionCode', $QuestionCode)
                ->where('BigTopicNumber', $i)
                ->limit(1)->get()->toArray();
            $TopicName = reset($TopicName)->BigTopicName;
            array_push($TopicNameArray, $TopicName);
        }
        return [$data, $TopicNameArray];
    }
    public function GetGradeDetailData($StudentID, $QuestionCode, $FillTime, $CurrentYear, $Semester)
    {
        //Func
        $FuncE = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Func")
            ->where('DetailName', "E")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $FuncI = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Func")
            ->where('DetailName', "I")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $FuncSR = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Func")
            ->where('DetailName', "SR")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        //Dev
        $DevA = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Dev")
            ->where('DetailName', "A")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $DevCG = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Dev")
            ->where('DetailName', "CG")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $DevCM = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Dev")
            ->where('DetailName', "CM")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $DevM = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Dev")
            ->where('DetailName', "M")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $DevS = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Dev")
            ->where('DetailName', "S")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        //Out
        $OutOne = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Out")
            ->where('DetailName', "1")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $OutTwo = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Out")
            ->where('DetailName', "2")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        $OutThree = DB::table('questiondetailgrade')->select('BigTopicNumber', 'Category', 'DetailName', 'ThreePoint', 'FillByAge', 'AgeProficientPercent', 'FillByAll', 'AllProficientPercent')
            ->where('StudentID', $StudentID)
            ->where('QuestionCode', $QuestionCode)
            ->where('SchoolYear', $CurrentYear)
            ->where('Semester', $Semester)
            ->where('Category', "Out")
            ->where('DetailName', "3")
            ->where('FillTime', $FillTime)
            ->get()->toArray();
        //獲取大題名稱
        $length = count($FuncE);
        $TopicNameArray = array();
        array_push($TopicNameArray, "總和");
        for ($i = 1; $i < $length; $i++) { //獲取大題名稱
            
            $TopicName = DB::table('questionnairecontent')->select('BigTopicName')
                ->where('QuestionCode', $QuestionCode)
                ->where('BigTopicNumber', $i)
                ->limit(1)->get()->toArray();
            
            $TopicName = reset($TopicName)->BigTopicName;
            array_push($TopicNameArray, $TopicName);
        }
        //合併
        $DetailData = array(
            "FuncE" => $FuncE, "FuncI" => $FuncI, "FuncSR" => $FuncSR,
            "DevA" => $DevA, "DevCG" => $DevCG, "DevCM" => $DevCM, "DevM" => $DevM, "DevS" => $DevS,
            "OutOne" => $OutOne, "OutTwo" => $OutTwo, "OutThree" => $OutThree
        );
        return [$DetailData, $TopicNameArray];
    }
    public function GetResultBasicData($StudentID)
    {
        /**
         * 入學年度 學期 班級 座號 姓名 問卷名稱 填寫次數 問卷結果 填寫日期
         * studentschooltable
         * 入學年度 Year
         * 學期     Semester
         * 班級     ClassName
         * 座號     StudentCode
         * 姓名     StudentName
         * studentfillfinish
         * 填寫次數 FillTime
         *      判斷最後一次是否填寫完
         *      填寫狀況 Finish (FillStatus)
         * 問卷名稱
         *      問卷代號 -> QuestionCode => questionnaireframework(問卷名稱)
         * questionbasicgrade
         * 當前年度 SchoolYear
         * 當前學期 Semester
         * 填寫次數 FillTime
         */
        $FinalData = array();
        //studentschooltable 只有一筆
        $BasicData = DB::table('studentschooltable')
            ->select("Year", "Semester", "ClassName", "StudentCode", "StudentName")
            ->where('StudentID', $StudentID)
            ->get()->toArray();
        $BasicData = json_decode(json_encode(reset($BasicData)), true); //指標轉陣列

        //studentfillfinish 會有多筆
        //刪除重複項，問卷Code 只會有一筆(多個問卷Code)
        $FillBasicData = DB::table('studentfillfinish')
            ->select('StudentID', 'QuestionCode')
            ->where('StudentID', $StudentID)
            ->distinct()->get()->toArray();

        for ($i = 0; $i < count($FillBasicData); $i++) {
            $CombineData = $BasicData;
            $FillData = DB::table('studentfillfinish')
                ->select('SchoolYear', 'Semester', 'FillTime', 'Finish')
                ->where('QuestionCode', $FillBasicData[$i]->QuestionCode)
                ->where('StudentID', $StudentID)
                ->get()->toArray();
            // dd($FillData);
            $NewFillBasicData = json_decode(json_encode($FillBasicData[$i]), true); //指標轉陣列
            $CombineData += $NewFillBasicData;

            $CurrentQuestionCode = $NewFillBasicData["QuestionCode"];
            //獲取問卷名稱
            $QuestionName = DB::table('questionnaireframework')->select("QuestionName")
                ->where('QuestionCode', $CurrentQuestionCode)
                ->first(); //只獲取一筆資料(第一筆)
            $QuestionName = json_decode(json_encode($QuestionName), true);

            $CombineData += $QuestionName;
            // dd($BasicData);
            $FillContent = array();
            for ($j = 0; $j < count($FillData); $j++) {
                $NewFillData = json_decode(json_encode($FillData[$j]), true); //指標轉陣列
                $Date = array();
                // Finish = 1 or FillTime > 1，代表至少填寫完成一次以上
                if (($NewFillData["Finish"] == 1) || ($NewFillData["FillTime"] > 1)) {
                    if($NewFillData["Finish"] == 0){
                        for ($FillTime = 1; $FillTime < $NewFillData["FillTime"]; $FillTime++) {
                            $FillDate = DB::table('questionstoretable')
                                ->select("FillDate")
                                ->where('StudentID', $StudentID)
                                ->where('QuestionCode', $CurrentQuestionCode)
                                ->where('SchoolYear', $NewFillData["SchoolYear"])
                                ->where('Semester', $NewFillData["Semester"])
                                ->where('FillTime', $FillTime)
                                ->first();
                            array_push($Date, $FillDate->FillDate);
                        }
                    }
                    if($NewFillData["Finish"] == 1){
                        for ($FillTime = 1; $FillTime <= $NewFillData["FillTime"]; $FillTime++) {
                            $FillDate = DB::table('questionstoretable')
                                ->select("FillDate")
                                ->where('StudentID', $StudentID)
                                ->where('QuestionCode', $CurrentQuestionCode)
                                ->where('SchoolYear', $NewFillData["SchoolYear"])
                                ->where('Semester', $NewFillData["Semester"])
                                ->where('FillTime', $FillTime)
                                ->first();
                            array_push($Date, $FillDate->FillDate);
                        }
                    }
                    $NewFillData +=  ["FillDate" => $Date];

                    array_push($FillContent, $NewFillData);
                }
            }
            if (!empty($FillContent)) {
                $CombineData += ["FillContent" => $FillContent];
                array_push($FinalData, $CombineData);
            }
        }
        return $FinalData;
    }
}
