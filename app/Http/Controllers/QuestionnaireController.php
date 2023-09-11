<?php

namespace App\Http\Controllers;

use App\Models\ChildInformationTable;
use Illuminate\Http\Request;
use App\Models\QuestionnaireUnify;
use App\Models\QuestionTable;
use App\Models\GetDate;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    //問卷呈現
    public function PushClaMEISER(Request $request) //從首頁點選時，
    {
        $TeacherName = session('TeacherName');
        $SchoolCode = session('schoolcode');
        //$request->QuestionCode 問卷代碼
        if($request->FillTime){ //從保存按鈕進入 後查看FillTime
            $StudentID = $request->StudentID;
            $FillTime = $request->FillTime;
            $FillStatus = $request->FillStatus;
        }else{ //從首頁進入
            $RequestData = preg_split("/-/", $request->child, -1, PREG_SPLIT_NO_EMPTY);
            $StudentID = $RequestData[0];
            $FillTime = $RequestData[1];
            $FillStatus = null;
            if (array_key_exists("2", $RequestData)) {
                $FillStatus = $RequestData[2];
            }
        }
        $QuestionCode = $request->QuestionCode;
        
        //0 學號 - 1 填寫次數 - 2 填寫狀態(次數為0時，無資料)
        //$RequestData[0] => 學號
        //$RequestData[1] => 填寫次數
        //$RequestData[2] => 填寫狀態(沒有填寫過問卷不會有)

        //獲取當前學年、學期
        [$SchoolYear, $Semester] = (new GetDate)->GetYearSemester();
        //獲取問卷資料
        $QuestionnaireRecord = (new QuestionTable)->PushAllQuestion($QuestionCode);
        //獲取學生基本資料
        $ChildBasicData = (new ChildInformationTable)->PushChildBasicData($StudentID);
        //0 班級名稱 - 1 座號 - 2 姓名 - 3 年齡

        /**
         * 確認填寫次數
         * 確認有沒有進行中問卷
         *      有 => 推送進行中的問卷
         *      無 => 推送問卷
         * 修改問卷填寫table (studentfillfinish)
         */
        if ($FillTime == 0) { //沒有任何紀錄
            [$ifsuccess] = (new QuestionnaireUnify)->JudgeFill(0, $QuestionCode, $StudentID, $FillTime); //新增資料 into studentfillfinish
            if ($ifsuccess) {
                //更改成功
            } else {
                //更改師派
            }
        }
        if ($FillStatus == 0) { //為0時，還在填寫
            //判斷有沒有歷史紀錄，無則只需抓取問卷資料，有則需要抓取問卷資料和歷史紀錄
            //[$data, $IfFinal] = (new QuestionnaireUnify)->unify($QuestionCode); //獲取問卷資料
            //問卷代號，老師名稱，學號，第幾大題-1，填寫次數
            //獲取歷史紀錄

            $QuestionnaireFillRecord = (new QuestionTable)->GetHistoryRecord($StudentID, $QuestionCode, $SchoolYear, $Semester, $FillTime);
            if (count($QuestionnaireFillRecord)) {
                // 有問卷資料，整合
                for ($i = 0; $i < count($QuestionnaireRecord); $i++) {
                    $QuestionnaireFillRecord[$i] = array($QuestionnaireFillRecord[$i]);
                    $QuestionnaireRecord[$i] = (new QuestionnaireUnify)->IntegrateData($QuestionnaireRecord[$i], $QuestionnaireFillRecord[$i]);
                }
            } else {
                //無問卷資料，不需額外處理
            }
        } else if ($FillStatus == 1) { //為1時，已完成
            //更改資料 studentfillfinish => FillTime 次數加1，Finish 重製 1 -> 0
            $ifsuccess = (new QuestionnaireUnify)->JudgeFill(1, $QuestionCode, $StudentID, $FillTime, $FillStatus); //修改資料 into studentfillfinish
            if ($ifsuccess) {
                //更改成功
            } else {
                //更改失敗
            }
        }
        $FillData = (new QuestionnaireUnify)->UpdateStatus($QuestionCode, $StudentID, $FillTime, $FillStatus);
        // return view('ClaMEISER')->with('HistoryData', $QuestionnaireRecord)->with('StudentID', $StudentID)->with('ChildBasicData', $ChildBasicData)->with('ChildAge', $ChildBasicData->Age)->with('FillData', $FillData);
        return view('newframework.Questionnaire')->with('HistoryData', $QuestionnaireRecord)->with('StudentID', $StudentID)->with('ChildBasicData', $ChildBasicData)->with('ChildAge', $ChildBasicData->Age)->with('FillData', $FillData);
    }
    //問卷儲存、計算結果並呈現
    public function ReceiveClaMEISER(Request $request)
    {
        /**
         * QuestionCode  
         * TeacherName Auth::username
         * SchoolCode Auth::userschool
         * ClassName
         * StudentCode
         * BigTopicNumber
         * Value 問卷小題所有答案 q1~qn 字串相加 while迴圈
         */
        $StudentID = $request->StudentID;
        $FillTime = $request->FillTime;
        $FillStatus = $request->FillStatus;
        $QuestionCode = $request->QuestionCode;
        $TeacherAccount = session('username');
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
        if ($request->NextOrFinal == "0") { //保存
            $success = (new QuestionnaireUnify)->receive($request, $StudentID, $TeacherAccount, $FillTime);
            if ($success) {
                session()->flash('message', '保存成功!');
                return redirect()->action([QuestionnaireController::class, 'PushClaMEISER'],$request);
            } else {
                session()->flash('errormessage', '保存失敗，請重新嘗試!');
                return redirect()->back();
            }
        } elseif ($request->NextOrFinal == "1") { //保存並計算
            $success = (new QuestionnaireUnify)->receive($request, $StudentID, $TeacherAccount, $FillTime); //儲存資料
            if ($success) { //儲存成功後計算結果
                $ChildData = (new ChildInformationTable)->PushChildBasicData($StudentID);
                $QuestionName = (new QuestionTable)->GetQuestionnaire($QuestionCode);//獲取問卷名稱
                $FillDate = (new QuestionTable)->GetFillDate($StudentID, $QuestionCode, $CurrentYear, $Semester,$FillTime);//獲取填寫時間
                $data = (new QuestionTable)->GetQuestionnaireAns($StudentID, $QuestionCode, $FillTime, $CurrentYear, $Semester); //檢查
                $ifsuccess = (new QuestionTable)->CountQuestionnaire($StudentID, $QuestionCode, $FillTime, $data, $CurrentYear, $Semester); //計算並輸入基本結果
                $ifdetailsuccess = (new QuestionTable)->CountDetailGrade($StudentID, $QuestionCode, $FillTime, $data, $CurrentYear, $Semester); //計算並輸入詳細結果
                if ($ifsuccess && $ifdetailsuccess) { //輸入成功，抓資料
                    [$GradeData, $TopicName] = (new QuestionTable)->GetGradeData($StudentID, $QuestionCode, $FillTime, $CurrentYear, $Semester);
                    $ifsuccess = (new QuestionnaireUnify)->JudgeFill(1, $QuestionCode, $StudentID, $FillTime, 0); //修改資料 into studentfillfinish
                    if ($ifsuccess) {
                        $CheckFillTime = (new QuestionTable)->GetFillTime($StudentID, $QuestionCode, $CurrentYear, $Semester);
                        $CurrentData = $StudentID . "-" . $QuestionCode . "-" . $CurrentYear . "-" . $Semester . "-" . $FillTime; //問卷結果比較用
                        if ($CheckFillTime >= 2) { //填寫次數大於兩次 歷史紀錄比較可以查詢
                            return view('newframework.Result')->with("title", "Result")->with("gradedata", $GradeData)->with("QuestionName",$QuestionName)->with("FillTime",$FillTime)->with("FillDate",$FillDate)->with("TopicName", $TopicName)->with("ChildBasic", $ChildData)->with("CurrentData", $CurrentData)->with("ifcompare", 1)->with("ifdirect", 1);
                        } else { //填寫次數小於兩次 歷史紀錄比較不能查詢
                            return view('newframework.Result')->with("title", "Result")->with("gradedata", $GradeData)->with("QuestionName",$QuestionName)->with("FillTime",$FillTime)->with("FillDate",$FillDate)->with("TopicName", $TopicName)->with("ChildBasic", $ChildData)->with("CurrentData", $CurrentData)->with("ifcompare", 0)->with("ifdirect", 1);
                        }
                    } else {
                        session()->flash('errormessage', '保存失敗，請重新嘗試!');
                        return redirect('front');
                    }
                }
            } else { //儲存失敗
                session()->flash('errormessage', '保存失敗，請重新嘗試!');
                return redirect('front');
            }
        }
    }
    //報表與問卷歷史紀錄統整頁面呈現
    public function PushClaUnify()
    {
        $TeacherAccount = session('username');
        $SchoolCode = session('schoolcode');
        $FinalData = (new QuestionnaireUnify)->UnifyResultData($TeacherAccount, $SchoolCode);
        /**
         * 入學年度 學期 班級 座號 姓名 問卷名稱 填寫次數 問卷結果
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
        return view('newframework.QRUnifyPage')->with("FillData", $FinalData);
    }
    //問卷歷史紀錄呈現
    public function PushHistoryClaMEISER(Request $request)
    {
        //學號-問卷代號-填寫學年-填寫學期-填寫次數
        [$FinalData, $ChildBasicData] = (new QuestionnaireUnify)->IntegrateHistoryData($request);
        //dd($FinalData);
        return view('newframework.QuestionnaireHistory')->with('ChildBasicData', $ChildBasicData)->with('HistoryData', $FinalData);
    }
    //計算結果呈現
    public function PushResult(Request $request)
    {
        $RequestData = preg_split("/-/", $request->resultdata, -1, PREG_SPLIT_NO_EMPTY);
        $StudentID = $RequestData[0];
        $QuestionCode = $RequestData[1];
        $SchoolYear = $RequestData[2];
        $Semester = $RequestData[3];
        $FillTime = $RequestData[4];
        $QuestionName = (new QuestionTable)->GetQuestionnaire($QuestionCode);
        $CheckFillTime = (new QuestionTable)->GetFillTime($StudentID, $QuestionCode, $SchoolYear, $Semester);
        $ChildData = (new ChildInformationTable)->PushChildBasicData($StudentID);
        [$GradeData, $TopicName] = (new QuestionTable)->GetGradeData($StudentID, $QuestionCode, $FillTime, $SchoolYear, $Semester);
        $FillDate = (new QuestionTable)->GetFillDate($StudentID, $QuestionCode, $SchoolYear, $Semester,$FillTime);
        if ($CheckFillTime >= 2) { //填寫次數大於兩次 歷史紀錄比較可以查詢
            return view('newframework.Result')->with("title", "Result")->with("gradedata", $GradeData)->with("QuestionName",$QuestionName)->with("FillTime",$FillTime)->with("FillDate",$FillDate)->with("TopicName", $TopicName)->with("ChildBasic", $ChildData)->with("CurrentData", $request->resultdata)->with("ifcompare", 1)->with("ifdirect", 0);
        } else { //填寫次數小於兩次 歷史紀錄比較不能查詢
            return view('newframework.Result')->with("title", "Result")->with("gradedata", $GradeData)->with("QuestionName",$QuestionName)->with("FillTime",$FillTime)->with("FillDate",$FillDate)->with("TopicName", $TopicName)->with("ChildBasic", $ChildData)->with("CurrentData", $request->resultdata)->with("ifcompare", 0)->with("ifdirect", 0);
        }
    }
    //詳細計算結果呈現
    public function PushDetailResult(Request $request)
    {
        $RequestData = preg_split("/-/", $request->resultdata, -1, PREG_SPLIT_NO_EMPTY);
        $StudentID = $RequestData[0];
        $QuestionCode = $RequestData[1];
        $SchoolYear = $RequestData[2];
        $Semester = $RequestData[3];
        $FillTime = $RequestData[4];
        $QuestionName = (new QuestionTable)->GetQuestionnaire($QuestionCode);
        $ChildData = (new ChildInformationTable)->PushChildBasicData($StudentID);
        [$DetailData, $TopicName] = (new QuestionTable)->GetGradeDetailData($StudentID, $QuestionCode, $FillTime, $SchoolYear, $Semester);
        $FillDate = (new QuestionTable)->GetFillDate($StudentID, $QuestionCode, $SchoolYear, $Semester,$FillTime);
        // dd($DetailData);
        return view('newframework.DetailResult')->with("title", "Result")->with("QuestionName",$QuestionName)->with("FillTime",$FillTime)->with("FillDate",$FillDate)->with("DetailData", $DetailData)->with("TopicName", $TopicName)->with("ChildBasic", $ChildData);
    }
    //歷史紀錄計算結果比較
    public function CompareResult(Request $request)
    {
        $RequestData = preg_split("/-/", $request->resultdata, -1, PREG_SPLIT_NO_EMPTY);
        $StudentID = $RequestData[0];
        $QuestionCode = $RequestData[1];
        $SchoolYear = $RequestData[2];
        $Semester = $RequestData[3];
        $CurrentFillTime = $RequestData[4];
        $TotalFillTime = (new QuestionTable)->GetFillTime($StudentID, $QuestionCode, $SchoolYear, $Semester);
        $ChildData = (new ChildInformationTable)->PushChildBasicData($StudentID);
        $UploadGradeData = array();
        $UploadTopicName = array();
        for ($i = 1; $i <= $TotalFillTime; $i++) {
            [$GradeData, $TopicName] = (new QuestionTable)->GetGradeData($StudentID, $QuestionCode, $i, $SchoolYear, $Semester);
            array_push($UploadGradeData, $GradeData);
            $UploadTopicName = $TopicName;
        }
        // dd($UploadGradeData);
        return view('newframework.CompareResult')->with("title", "CompareResults")->with("gradedata", $UploadGradeData)->with("TopicName", $UploadTopicName)->with("CurrentTime", $CurrentFillTime);
    }
}
