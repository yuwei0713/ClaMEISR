<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\ChildInformationTable;
use App\Http\Middleware\GetDate;
use App\Http\Middleware\QuestionTable;
use App\Http\Middleware\TeacherData;
use Illuminate\Support\Facades\Auth;

class OpenController extends Controller
{
    //首頁呈現
    public function index()
    {

        if (Auth::check()) {
            $account = Auth::user()->username;
            $userschool = Auth::user()->schoolnumber;
            $BasicTeacherData = (new TeacherData)->GetAllTeacherData($account, $userschool);
            $TeacherName = $BasicTeacherData["TeacherName"];
            [$SchoolName, $Class] = (new ChildInformationTable)->PushBasicData($userschool);
            $SchoolArray = array("SchoolName" => $SchoolName->SchoolName);
            $BasicTeacherData = array_merge($BasicTeacherData, $SchoolArray);
            $Questionnaire = (new QuestionTable)->GetQuestionnaire();
            if ($TeacherName == null) {
                return view('index')->with('Fillflag', -1)->with('flag', -1)->with('account', $account)->with('SchoolName', $SchoolName->SchoolName)->with("Questionnaire", $Questionnaire);
            }
            [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
            $ChildData = (new ChildInformationTable)->GetChildBasic($account, $userschool, $CurrentYear); //幼兒基本資料 for 歷史紀錄使用
            //dd(Auth::user());
            /**
             * 幼兒資料與問卷填寫次數 基本資料 + 問卷代號 + 問卷填寫次數
             * 填寫次數為0時，不需有填寫狀態
             * 填寫次數 0 => 尚未開始填寫
             * 填寫次數 1，0 => 第n次填寫進行中
             * 填寫次數 1，1 => 已完成第n次填寫
             */
            //flag 用於判斷問卷modal的導入
            if ($ChildData == null) {
                return view('index')->with('Fillflag', 0)->with('flag', 0)->with("Questionnaire", $Questionnaire)->with("TeacherData", $BasicTeacherData);
            } else {
                [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
                $ChildAndFill = (new QuestionTable)->GetFillStatus($userschool, $ChildData, $Questionnaire, $CurrentYear, $Semester);
                return view('index')->with('Fillflag', 0)->with('flag', 1)->with('ChildAndFill', $ChildAndFill)->with('ChildData', $ChildData)->with("Questionnaire", $Questionnaire)->with("TeacherData", $BasicTeacherData);
            }
        } else {
            return view('index');
        }
    }
    //教師基本資料 接收與處理
    public function ReceiveTeacherData(Request $request)
    {
        //dd($request);
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
    }
    //幼兒基本資料 呈現
    public function PushChildInformation(Request $request)
    {
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester(); //計算民國年次 西元轉民國
        $SchoolCode = session('schoolcode');
        [$SchoolName, $Class] = (new ChildInformationTable)->PushBasicData($SchoolCode);
        return view('ChildInformation')->with('SchoolCode', $SchoolCode)->with('SchoolName', $SchoolName->SchoolName)->with('Class', $Class)->with('year', $CurrentYear)->with('status', $request->childstatus)->with('semester', $Semester);
    }
    //幼兒基本資料 接收與處理
    public function ReceiveChildInformation(Request $request)
    {
        $account = Auth::user()->username;
        //dd($request);

        $ifsuccess =  (new ChildInformationTable)->InsertChildInformation($request, $account);
        if ($ifsuccess) {
            session()->flash('message', '兒童資料新增成功');
            return redirect('front');
        } else {
            session()->flash('errormessage', '資料重複，請修改!');
            return redirect()->back()->withInput();;
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
        $TeacherName = session('TeacherName');
        $SchoolCode = session('schoolcode');

        $RequestData = preg_split("/-/", $request->historychild, -1, PREG_SPLIT_NO_EMPTY);

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
        //return view('ChildHistoryInformation')->with('ChildFullData',$ChildFullData);
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester(); //計算民國年次 西元轉民國
        [$SchoolName, $Class] = (new ChildInformationTable)->PushBasicData($SchoolCode);
        return view('ChildHistoryInformation')->with('ChildFullData', $ChildFullData)->with('Class', $Class)->with('TeacherName', $TeacherName);
    }
    //幼兒基本資料 歷史紀錄更改
    public function ReceiveHistoryChildInformation(Request $request)
    {
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
    }
}
