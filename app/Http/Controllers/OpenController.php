<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChildInformationTable;
use App\Models\GetDate;
use App\Models\QuestionTable;
use App\Models\QuestionnaireUnify;
use App\Models\TeacherData;
use Illuminate\Support\Facades\Auth;

class OpenController extends Controller
{
    //首頁導向
    public function frontdirect()
    {
        return to_route('front.show');
    }
    //首頁呈現
    public function index()
    {
        if (Auth::check()) {
            $ChildCount = 0; //兒童資料數
            $FillCount = 0; //問卷填寫數
            $account = Auth::user()->username;
            $userschool = Auth::user()->schoolnumber;
            $BasicTeacherData = (new TeacherData)->GetAllTeacherData($account, $userschool);
            $TeacherName = $BasicTeacherData["TeacherName"];
            [$SchoolName, $Class] = (new ChildInformationTable)->PushBasicData($userschool);
            $SchoolArray = array("SchoolName" => $SchoolName->SchoolName);
            $BasicTeacherData = array_merge($BasicTeacherData, $SchoolArray);
            $Questionnaire = (new QuestionTable)->GetQuestionnaire();
            if ($TeacherName == null) {
                return view('newframework.index')
                ->with('Fillflag', -1)
                ->with('flag', -1)
                ->with('account', $account)
                ->with('SchoolName', $SchoolName->SchoolName)
                ->with("Questionnaire", $Questionnaire)
                ->with("ChildCount",$ChildCount)
                ->with("FillCount",$FillCount);
            }
            [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
            $ChildData = (new ChildInformationTable)->GetChildBasic($account, $userschool, $CurrentYear); //幼兒基本資料 for 歷史紀錄使用
            /**
             * 幼兒資料與問卷填寫次數 基本資料 + 問卷代號 + 問卷填寫次數
             * 填寫次數為0時，不需有填寫狀態
             * 填寫次數 0 => 尚未開始填寫
             * 填寫次數 1，0 => 第n次填寫進行中
             * 填寫次數 1，1 => 已完成第n次填寫
             */
            //flag 用於判斷問卷modal的導入
            if ($ChildData == null) {
                return view('newframework.index')
                ->with('Fillflag', 0)
                ->with('flag', 0)
                ->with("Questionnaire", $Questionnaire)
                ->with("TeacherData", $BasicTeacherData)
                ->with("ChildCount",$ChildCount)
                ->with("FillCount",$FillCount);
            } else {
                [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
                $ChildAndFill = (new QuestionTable)->GetFillStatus($userschool, $ChildData, $Questionnaire, $CurrentYear, $Semester);
                
                //兒童資料數
                foreach ( $ChildData as $cdata=>$cdata_class){
                    if(!empty($cdata_class)){
                        foreach( $cdata_class as $cdata_title=>$cdata_value ){
                            $ChildCount += count($cdata_value);
                        }
                    }
                }
                //問卷資料數
                $FillCount = 0;
                $FillData = (new QuestionnaireUnify)->UnifyResultData($account, $userschool);
                for($i = 0; $i < count($FillData); $i++){
                    for($j = 0; $j < count($FillData[$i]["FillContent"]); $j++){
                        $FillContent = $FillData[$i]["FillContent"][$j];
                        if($FillContent["Finish"]=="1" ){
                            $FillCount += intval($FillContent["FillTime"]);
                        }else{
                            $FillCount += (intval($FillContent["FillTime"]) -1 );
                        }
                    }
                }
                return view('newframework.index')
                ->with('Fillflag', 0)
                ->with('flag', 1)
                ->with('ChildAndFill', $ChildAndFill)
                ->with('ChildData', $ChildData)
                ->with("Questionnaire", $Questionnaire)
                ->with("TeacherData", $BasicTeacherData)
                ->with("ChildCount",$ChildCount)
                ->with("FillCount",$FillCount);
            }
        } else {
            return view('newframework.index');
        }
    }
    //教師基本資料 接收與處理
    public function ReceiveTeacherData(Request $request)
    {
        if ($request->isMethod('post')){
            $ifsuccess = "";
            $flag = (new TeacherData)->CheckIfInsert($request->Account);
            if ($flag == 0) { //沒有填寫過
                $ifsuccess = (new TeacherData)->InsertTeacherData($request);
            } elseif ($flag == 1) { //已經填寫過
                $ifsuccess = (new TeacherData)->UpdateTeacherData($request);
            }
            if ($ifsuccess == 1) { //成功
                session()->put('TeacherName', $request->TeacherName);
                session()->flash('message', '資料修改成功!');
                return redirect('front');
            } else { //失敗
                session()->flash('errormessage', '資料更改有誤，請重新嘗試');
            }
        }else{
            session()->flash('errormessage', '未知錯誤，請重試一次');
            return redirect('front');
        }
        
    }
    //幼兒基本資料 呈現
    public function PushChildInformation(Request $request)
    {
        $request = $request->query();
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester(); //計算民國年次 西元轉民國
        $SchoolCode = session('schoolcode');
        [$SchoolName, $Class] = (new ChildInformationTable)->PushBasicData($SchoolCode);
        return view('newframework.childdata')->with('SchoolCode', $SchoolCode)->with('SchoolName', $SchoolName->SchoolName)->with('Class', $Class)->with('year', $CurrentYear)->with('status', $request['childstatus'])->with('semester', $Semester);
    }
    //幼兒基本資料 接收與處理
    public function ReceiveChildInformation(Request $request)
    {
        if ($request->isMethod('POST')){
            $account = Auth::user()->username;
    
            $ifsuccess =  (new ChildInformationTable)->InsertChildInformation($request, $account);
            if ($ifsuccess) {
                session()->flash('message', '兒童資料新增成功');
                return redirect('front');
            } else {
                session()->flash('errormessage', '資料重複，請修改!');
                return redirect()->back()->withInput();
            }
        }else{
            session()->flash('errormessage', '未知錯誤，請重試一次');
            return redirect('front');
        }
        
        /**
         * student_name = 兒童姓名
         * gender = 兒童性別
         * age_datepicker = 兒童生日
         * child_age = 年齡
         * year = 學年
         * semester = 學期
         * school_name = 學校
         * class_name = 班級
         * quest_name = 量表填答人
         * diagnosis = 診斷
         * living = 同住者
         * fst_attend = 主要照顧者
         * sec_attend = 次要照顧者
         */
    }
    //幼兒基本資料 歷史紀錄呈現
    public function PushHistoryChildInformation(Request $request)
    {
        $request = $request->query();
        $TeacherName = session('TeacherName');
        $SchoolCode = session('schoolcode');

        $RequestData = preg_split("/-/", $request['historychild'], -1, PREG_SPLIT_NO_EMPTY);

        $StudentID = $RequestData[0];
        //0 學號 - 1 填寫次數 - 2 填寫狀態(次數為0時，無資料)
        //幼兒基本資料的歷史紀錄呈現只需學號
        //$RequestData[0] => 學號
        //$RequestData[1] => 填寫次數
        //$RequestData[2] => 填寫狀態(沒有填寫過問卷不會有)

        //輸入
        /**
         * 年度
         * 學校
         * 班級
         * 座號
         */
        //輸出
        /**
         * 學校 班級 姓名 座號 性別 生日 年齡 學年 學期 老師姓名 
         * 狀態(有無症狀 疑似) -> 診斷
         *  confirm => 診斷為陣列( diagnosis )與字串( other diagnosis )
         *  suspected => 診斷為字串
         *  none => 診斷為無
         * 同住者 主要照顧者 次要照顧者
         */
        $ChildFullData =  (new ChildInformationTable)->PushDetailData($StudentID);
        if ($ChildFullData == false) {
            return redirect('front');
        }
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester(); //計算民國年次 西元轉民國
        [$SchoolName, $Class] = (new ChildInformationTable)->PushBasicData($SchoolCode);
        return view('newframework.historychilddata')->with('ChildFullData', $ChildFullData)->with('Class', $Class)->with('TeacherName', $TeacherName);
    }
    //幼兒基本資料 歷史紀錄更改
    public function ReceiveHistoryChildInformation(Request $request)
    {
        if ($request->isMethod('post')){
            $account = Auth::user()->username;
            //dd($request);
            $ifsuccess =  (new ChildInformationTable)->UpdataChildInformation($request, $account);
            if ($ifsuccess) {
                session()->flash('message', '資料修改成功!');
                return redirect('front');
            } else {
                session()->flash('errormessage', '資料更改有誤，請檢查是否輸入完全或正確，並重新嘗試');
                return redirect()->back()->withInput();;
            }
        }else{
            session()->flash('errormessage', '未知錯誤，請重試一次');
            return redirect('front');
        }
        
    }
    //幼兒基本資料 刪除
    public function DeleteChildInformation(Request $request)
    {
        if ($request->isMethod('post')){
            $Action = "Remove";
            $StudentID = $request->StudentID;
            print_r("CheckID：",$StudentID);
            //check deletestudentschooltable (delete order，刪除順序)
            $Order = (new ChildInformationTable)->GetDeleteOrder($StudentID);
            print_r("CheckOrder：",$Order);
            //Insert Data to DeleteTable
            $IfInsertSuccess = (new ChildInformationTable)->TransferData($StudentID, $Order, $Action);
            print_r("CheckInsert：",$IfInsertSuccess);
            if ($IfInsertSuccess) {
                //Delete Data From Table
                $IfDeleteSuccess = (new ChildInformationTable)->DeleteData($StudentID, $Order, $Action);
                print_r("CheckDelete：",$IfDeleteSuccess);
                if ($IfDeleteSuccess) {
                    session()->flash('message', '資料刪除成功!');
                    return redirect('front');
                } else {
                    session()->flash('errormessage', '資料刪除有誤，請稍後嘗試');
                    return redirect()->back()->withInput();;
                }
            } else {
                session()->flash('errormessage', '資料刪除有誤，請稍後嘗試');
                return redirect()->back()->withInput();;
            }
        }else{
            session()->flash('errormessage', '未知錯誤，請重試一次');
            return redirect('front');
        }
    }
    public function RecoverChildInformation(Request $request)
    {
        $Action = "Recover";
        $StudentID = $request->StudentID;
        $Order = $request->DelOrder;
    }
}
