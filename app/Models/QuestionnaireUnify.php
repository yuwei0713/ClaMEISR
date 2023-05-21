<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class QuestionnaireUnify
{
    public function unify($QuestionCode = null)
    {
        $QuestionnaireRecord = (new QuestionTable)->PushAllQuestion($QuestionCode);
        /*[$ReturnTitleData, $ReturnPageData, $smalltopicquantity, $Status] = (new QuestionTable)->PushQuestion($QuestionCode, $BigTopic);
        if ($ReturnTitleData == null && $ReturnPageData == null) {
            return false;
        }
        $array_rows = count($ReturnPageData);
        for ($i = 0; $i < $array_rows; $i++) {
            $ReturnPageData[$i]['OptionValue'] = preg_split("/,/", $ReturnPageData[$i]['OptionValue'], -1, PREG_SPLIT_NO_EMPTY);
            $ReturnPageData[$i]['AdditionContent'] = preg_split("/,/", $ReturnPageData[$i]['AdditionContent'], -1, PREG_SPLIT_NO_EMPTY);
        }
        //return view('ClaMEISER',['title' => '課堂投入、獨立性和社會關係評量表']);
         
            資料：
                大題名稱(BigTopicName)
                選項數目(OptionContents)
                附加內容數目(AdditionQuantity)
                    附加內容名稱(AdditionTitle -> preg_split(",",$TargetValue, -1 ,PREG_SPLIT_NO_EMPTY)) 需二維陣列

                小題數(SmTopicNumber)
                小題名稱(SmTopicContent)
                    年齡(SuitableAge -> Age)
                        小題input name ( OptionQuantity -> for loop -> array )
                        小題input value ( OptionValue -> preg_split(",",$TargetValue, -1 ,PREG_SPLIT_NO_EMPTY)) 需二維陣列
                    附加內容(AdditionContent -> preg_split(",",$TargetValue, -1 ,PREG_SPLIT_NO_EMPTY)) 需二維陣列
            array_merge( $array1 , $array2 , $array3 , ...) 合併array
        

        $data = array(
            'QuestionCode' => $ReturnTitleData['QuestionCode'],
            'BigTopicNumber' => $ReturnTitleData['QuestionBigTopic'],
            'title' => $ReturnTitleData['QuestionName'],
            'BigTopicName' => $ReturnTitleData['BigTopicName'],
            'OptionContents' => $OptionContents = preg_split("/,/", $ReturnTitleData['OptionContent'], -1, PREG_SPLIT_NO_EMPTY),
            'AdditionTitle' => $AddiTitles = preg_split("/,/", $ReturnTitleData['AdditionTitle'], -1, PREG_SPLIT_NO_EMPTY),
            'Detail' => $ReturnPageData,
            'SmallTopicQuantity' => $smalltopicquantity
        );
        return [$data,$Status];*/
    }
    public function receive($request, $StudentID, $TeacherAccount ,$FillTime)
    {
        /**
         * QuestionCode  
         * CountOfTopic
         * TeacherName Auth::username
         * ClassName
         * StudentCode
         * BigTopicNumber
         * Value 問卷小題所有答案 q1~qn 字串相加 while迴圈
         * q 大題數 - 小題數 => 選項 - 值
         * q1-1 => 2-2
         * q1-2 => 3-3
         * q1-3 => 4-3
         */
        $TopicQuantity = $request->CountOfTopic;
        for($i = 1;$i <= $TopicQuantity; $i++){
            $SmallTopic = "Topic".$i;
            $Quantity = $request->$SmallTopic;
            $value = "";
            for( $j = 1; $j <= $Quantity ; $j++){
                $combine = "q" . $i . "-" . $j;
                $smtopic = "q" . $j;
                if ($request->$combine) {
                    $value .= $smtopic . "-" . $request->$combine . " ";
                }
            }
            $NeedData = array(
                'StudentID' => $StudentID,
                'QuestionCode' => $request->QuestionCode,
                'TeacherAccount' => $TeacherAccount,
                'BigTopicNumber' => $i,
                'Value' => $value,
                'FillTime' => $FillTime
            );
            $success = (new QuestionTable)->ReceiveQuestion($NeedData);
            if(!$success){
                return false;
            }
        }
        return true;
    }
    public function JudgeFill($Status, $QuestionCode, $StudentID, $FillTime, $FillStatus = null)
    { //判斷要新增資料還是修改
        /**
         * status => 0->新增，1->更改
         * QuestionCode
         * 
         * SchoolCode
         * Year 入學年度
         * ClassName
         * StudentCode
         * Fill
         * 
         * CurrentTear
         * Semester
         */
        $success = "";
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
        if ($Status == 0) { //新增資料
            $success = (new QuestionTable)->InsertFillTime($QuestionCode, $StudentID, $FillTime, $CurrentYear, $Semester);
        }
        if ($Status == 1) { //修改資料
            $success = (new QuestionTable)->UpdateFillTime($QuestionCode, $StudentID, $FillTime, $FillStatus, $CurrentYear, $Semester);
        }

        if ($success) {
            return true;
        } else {
            return false;
        }
    }
    public function UpdateStatus($QuestionCode, $StudentID, $FillTime, $FillStatus)
    {
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
        $NewBasicData = (new QuestionTable)->UpdateFillStatus($QuestionCode, $StudentID, $FillTime, $FillStatus, $CurrentYear, $Semester);
        return $NewBasicData;
    }
    public function CheckHistory($QuestionCode, $TeacherName, $StudentID, $BigTopicNumber, $FillTime)
    {
        $BigTopicNumber += 1;
        //問卷代號，老師名稱，學校代號，班級名稱，學生座號，第幾大題-1，填寫次數
        [$CurrentYear, $Semester] = (new GetDate)->GetYearSemester();
        //當前學年，學期
        $SearchData = array(
            'StudentID' => $StudentID,
            "QuestionCode" => $QuestionCode,
            "TeacherName" => $TeacherName,
            "SchoolYear" => $CurrentYear,
            "Semester" => $Semester,
            "BigTopicNumber" => $BigTopicNumber,
            "FillTime" => $FillTime,
        );
        $ReturnData = (new QuestionTable)->GetIngHistory($SearchData);
        return $ReturnData;
    }
    public function IntegrateData($BasicData, $HistoryData) //整合問卷與歷史紀錄
    {
        //問卷答案儲存方式 q題數+第幾項+"-"+value => q1-1-1,q2-3-3，q3-4-3 ...
        $BasicDataDetail = $BasicData['Detail'];
        $Value = reset($HistoryData)->Value;
        $TopicValue = preg_split("/ /", $Value, -1, PREG_SPLIT_NO_EMPTY); //使用空格分開
        $TopicArray = array();
        for ($i = 0; $i < count($TopicValue); $i++) {
            $TopicDetailValue = preg_split("/-/", $TopicValue[$i], -1, PREG_SPLIT_NO_EMPTY);
            array_push($TopicArray,$TopicDetailValue);
        }

        for($i = 0; $i<count($TopicArray);$i++){
            $FillTopicNumber = str_replace("q", "", $TopicArray[$i][0]);
            $FillTopicOptionNumber = $TopicArray[$i][1];
            for($j = 0 ;$j < count($BasicDataDetail);$j++){
                $TopicNumber = $BasicDataDetail[$j]['SmTopicNumber']; //小題數
                if($FillTopicNumber == $TopicNumber){ //如果該小題數有填寫紀錄，則將填寫的值放入原本的資料
                    $BasicDataDetail[$j]['FillTopic'] = $FillTopicOptionNumber;
                    break;
                }
            }
        }
        $BasicData['Detail'] = $BasicDataDetail; //將跑完的資料覆蓋上去
        return $BasicData;
    }
    public function UnifyResultData($TeacherAccount,$SchoolCode){
        $ReturnData = array();
        $ChildFillData = DB::table('studentschooltable')->select('StudentID')
        ->where('TeacherAccount', $TeacherAccount)
        ->where('SchoolCode', $SchoolCode)
        ->get()->toArray();
        for($i = 0 ; $i<count($ChildFillData); $i++){
            $StudentID = $ChildFillData[$i]->StudentID;
            $PersonalBasicData = (new QuestionTable)->GetResultBasicData($StudentID);
            $ReturnData = array_merge($ReturnData,$PersonalBasicData);
        }
        return $ReturnData;
    }
    public function IntegrateHistoryData($request){
        $RequestData = preg_split("/-/", $request->questionhistorydata, -1, PREG_SPLIT_NO_EMPTY);
        $StudentID = $RequestData[0];
        $QuestionCode = $RequestData[1];
        $SchoolYear = $RequestData[2];
        $Semester = $RequestData[3];
        $FillTime = $RequestData[4];
        $QuestionnaireFillRecord = (new QuestionTable)->GetHistoryRecord($StudentID,$QuestionCode,$SchoolYear,$Semester,$FillTime);
        $QuestionnaireRecord = (new QuestionTable)->PushAllQuestion($QuestionCode);
        $ChildBasicData = (new ChildInformationTable)->PushChildBasicData($StudentID);
        
        for($i = 0; $i< count($QuestionnaireRecord); $i++){
            $QuestionnaireFillRecord[$i] = array($QuestionnaireFillRecord[$i]);
            $QuestionnaireRecord[$i] = (new QuestionnaireUnify)->IntegrateData($QuestionnaireRecord[$i],$QuestionnaireFillRecord[$i]);
        }
        return [$QuestionnaireRecord,$ChildBasicData];
    }
}
