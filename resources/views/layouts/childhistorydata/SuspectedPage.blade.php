<!--第一項-->
<div class="std_information_framwork" id="sq10">
    <div class="option_title">疑似障礙類別(單選)
    <span style="color:red">*</span>
    </div>
    <div class="diagnosis">
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "智能障礙")
            <input class="option_square" type="radio" name="diagnosis" value="智能障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="智能障礙">
            @endif
            <span class="choice-css">智能障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "視覺障礙")
            <input class="option_square" type="radio" name="diagnosis" value="視覺障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="視覺障礙">
            @endif
            <span class="choice-css">視覺障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "聽覺障礙")
            <input class="option_square" type="radio" name="diagnosis" value="聽覺障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="聽覺障礙">
            @endif
            <span class="choice-css">聽覺障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "語言障礙")
            <input class="option_square" type="radio" name="diagnosis" value="語言障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="語言障礙">
            @endif
            <span class="choice-css">語言障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "腦性麻痺")
            <input class="option_square" type="radio" name="diagnosis" value="腦性麻痺" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="腦性麻痺">
            @endif
            <span class="choice-css">腦性麻痺</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "肢體障礙")
            <input class="option_square" type="radio" name="diagnosis" value="肢體障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="肢體障礙">
            @endif
            <span class="choice-css">肢體障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "身體病弱")
            <input class="option_square" type="radio" name="diagnosis" value="身體病弱" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="身體病弱">
            @endif
            <span class="choice-css">身體病弱</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "情緒行為障礙")
            <input class="option_square" type="radio" name="diagnosis" value="情緒行為障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="情緒行為障礙">
            @endif
            <span class="choice-css">情緒行為障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "學習障礙")
            <input class="option_square" type="radio" name="diagnosis" value="學習障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="學習障礙">
            @endif
            <span class="choice-css">學習障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "多重障礙")
            <input class="option_square" type="radio" name="diagnosis" value="多重障礙" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="多重障礙">
            @endif
            <span class="choice-css">多重障礙</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "自閉症")
            <input class="option_square" type="radio" name="diagnosis" value="自閉症" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="自閉症">
            @endif
            <span class="choice-css">自閉症</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "發展遲緩")
            <input class="option_square" type="radio" name="diagnosis" value="發展遲緩" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="發展遲緩">
            @endif
            <span class="choice-css">發展遲緩</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Diagnosis'] == "other")
            <script>
                $(document).ready(function() {
                    $("#suspected_other_diagnosis").css("display", "block");
                });
            </script>
            <input class="option_square" type="radio" name="diagnosis" value="other" checked>
            @else
            <input class="option_square" type="radio" name="diagnosis" value="other">
            @endif
            <span class="choice-css">其他障礙</span>
        </label>
    </div>
    <div id="suspected_other_diagnosis" class="input_style other_framework">
        @if($ChildFullData['Diagnosis'] == "other")
<<<<<<< HEAD
        <input name="diagnosis_other_content" id="suspected_diagnosis_other_content" class="other_style" type="text" value="{{ $ChildFullData['OtherDiagnosis'] }}" placeholder="請描述其他症狀">
        @else
        <input name="diagnosis_other_content" id="suspected_diagnosis_other_content" class="other_style" type="text" value="" placeholder="請描述其他症狀">
        @endif
    </div>
</div>
=======
        <input name="suspected_diagnosis_other_content" id="suspected_diagnosis_other_content" class="other_style" type="text" value="{{ $ChildFullData['OtherDiagnosis'] }}" placeholder="請描述其他症狀" maxlength="20">
        @else
        <input name="suspected_diagnosis_other_content" id="suspected_diagnosis_other_content" class="other_style" type="text" value="" placeholder="請描述其他症狀" maxlength="20">
        @endif
    </div>
</div>
<script>
    $(document).ready(function() {
        @if($ChildFullData['Diagnosis'] == "other")
        $(".manual_option").css("display", "none");
        @else
        $(".manual_option").css("display", "block");
        @endif
    });
</script>
>>>>>>> dev
<!--第一項end-->
<!--第二項-->
<div class="std_information_framwork" id="sq13">
    <div class="option_title">補充說明
    <span style="color:red">*</span>
    </div>
    <div class="diagnosis">
        <label class="diagnosis_textarea_framwork">
        @if($ChildFullData['Note'] != "")
<<<<<<< HEAD
            <textarea class="diagnosis_textarea_content" id="note" name="note" rows="3" placeholder="請描述疑似症狀">{{ $ChildFullData['Note'] }}</textarea>
        @else
            <textarea class="diagnosis_textarea_content" id="note" name="note" rows="3" placeholder="請描述疑似症狀"></textarea>
=======
            <textarea class="diagnosis_textarea_content" id="note" name="note" rows="3" placeholder="請描述疑似症狀" maxlength="100">{{ $ChildFullData['Note'] }}</textarea>
        @else
            <textarea class="diagnosis_textarea_content" id="note" name="note" rows="3" placeholder="請描述疑似症狀" maxlength="100"></textarea>
>>>>>>> dev
        @endif
        </label>
    </div>
</div>
<!--第二項end-->
<!--第三項-->
<!--<div class="std_information_framwork manual_option" id="sq11">
    <div class="option_title">障礙程度</div>
    <div class="diagnosis">
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Degree'] == "輕度")
            <input class="option_square" type="radio" name="degree" value="輕度" checked>
            @else
            <input class="option_square" type="radio" name="degree" value="輕度">
            @endif
            <span class="choice-css">輕度</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Degree'] == "中度")
            <input class="option_square" type="radio" name="degree" value="中度" checked>
            @else
            <input class="option_square" type="radio" name="degree" value="中度">
            @endif
            <span class="choice-css">中度</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Degree'] == "中重度")
            <input class="option_square" type="radio" name="degree" value="中重度" checked>
            @else
            <input class="option_square" type="radio" name="degree" value="中重度">
            @endif
            <span class="choice-css">中重度</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if($ChildFullData['Degree'] == "重度")
            <input class="option_square" type="radio" name="degree" value="重度" checked>
            @else
            <input class="option_square" type="radio" name="degree" value="重度">
            @endif
            <span class="choice-css">重度</span>
        </label>
    </div>
</div>-->
<!--第三項end-->
<!--第四項-->
@if($ChildFullData['Diagnosis'] == "發展遲緩")
<script>
    $(document).ready(function() {
        $(".diagnosis_option").css("display", "block");
    });
</script>
@endif
<div class="std_information_framwork diagnosis_option" id="sq7">
    <div class="option_title">鑑定安置類別
    <span style="color:red">*</span>
    </div>
    <div class="diagnosis">
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if(preg_match("/無特別標註/",$ChildFullData['Identities']))
            <input class="option_square" type="checkbox" name="identities[]" value="無特別標註" checked>
            @else
            <input class="option_square" type="checkbox" name="identities[]" value="無特別標註">
            @endif
            <span class="choice-css">無特別標註</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if(preg_match("/認知/",$ChildFullData['Identities']))
            <input class="option_square" type="checkbox" name="identities[]" value="認知" checked>
            @else
            <input class="option_square" type="checkbox" name="identities[]" value="認知">
            @endif
            <span class="choice-css">認知</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if(preg_match("/語言/",$ChildFullData['Identities']))
            <input class="option_square" type="checkbox" name="identities[]" value="語言" checked>
            @else
            <input class="option_square" type="checkbox" name="identities[]" value="語言">
            @endif
            <span class="choice-css">語言</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if(preg_match("/動作/",$ChildFullData['Identities']))
            <input class="option_square" type="checkbox" name="identities[]" value="動作" checked>
            @else
            <input class="option_square" type="checkbox" name="identities[]" value="動作">
            @endif
            <span class="choice-css">動作</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if(preg_match("/社會情緒/",$ChildFullData['Identities']))
            <input class="option_square" type="checkbox" name="identities[]" value="社會情緒" checked>
            @else
            <input class="option_square" type="checkbox" name="identities[]" value="社會情緒">
            @endif
            <span class="choice-css">社會情緒</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_four">
            @if(preg_match("/非特定性/",$ChildFullData['Identities']))
            <input class="option_square" type="checkbox" name="identities[]" value="非特定性" checked>
            @else
            <input class="option_square" type="checkbox" name="identities[]" value="非特定性">
            @endif
            <span class="choice-css">非特定性</span>
        </label>
    </div>
</div>
<!--第四項end-->
<!--第五項-->
<div class="std_information_framwork" id="sq8">
    <div class="option_title">鑑定安置佐證
    <span style="color:red">*</span>
    </div>
    <div class="diagnosis">
        <label class="diagnosis_framwork diagnosis_framework_three">
            @if(preg_match("/心理衡鑑/",$ChildFullData['Proofs']))
            <input class="option_square" type="checkbox" name="proofs[]" value="心理衡鑑定（醫院）" checked>
            @else
            <input class="option_square" type="checkbox" name="proofs[]" value="心理衡鑑定（醫院）">
            @endif
            <span class="choice-css">心理衡鑑定（醫院）</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_three">
            @if(preg_match("/聯評報告/",$ChildFullData['Proofs']))
            <input class="option_square" type="checkbox" name="proofs[]" value="聯評報告" checked>
            @else
            <input class="option_square" type="checkbox" name="proofs[]" value="聯評報告">
            @endif
            <span class="choice-css">聯評報告</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_three">
            @if(preg_match("/特殊教育心評/",$ChildFullData['Proofs']))
            <input class="option_square" type="checkbox" name="proofs[]" value="特殊教育心評" checked>
            @else
            <input class="option_square" type="checkbox" name="proofs[]" value="特殊教育心評">
            @endif
            <span class="choice-css">特殊教育心評</span>
        </label>
    </div>
</div>
<!--第五項end-->
<!--第六項-->
<div class="std_information_framwork" id="sq9">
    <div class="option_title">是否領有身障手冊
    <span style="color:red">*</span>
    </div>
    <div class="diagnosis">
        @if($ChildFullData['Manual'] == "yes")
        <label class="diagnosis_framwork diagnosis_framework_two">
            <input class="option_square" type="radio" name="manual" value="yes" checked>
            <span class="choice-css">是</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_two">
            <input class="option_square" type="radio" name="manual" value="no">
            <span class="choice-css">否</span>
        </label>
        @elseif($ChildFullData['Manual'] == "no")
        <label class="diagnosis_framwork diagnosis_framework_two">
            <input class="option_square" type="radio" name="manual" value="yes">
            <span class="choice-css">是</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_two">
            <input class="option_square" type="radio" name="manual" value="no" checked>
            <span class="choice-css">否</span>
        </label>
        @else
        <label class="diagnosis_framwork diagnosis_framework_two">
            <input class="option_square" type="radio" name="manual" value="yes">
            <span class="choice-css">是</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_two">
            <input class="option_square" type="radio" name="manual" value="no">
            <span class="choice-css">否</span>
        </label>
        @endif
    </div>
</div>
<!--第六項end-->
<!--第七項-->
<div class="std_information_framwork" id="sq12">
    <div class="option_title">安置結果
    <span style="color:red">*</span>
    </div>
    <div class="diagnosis">
        <label class="diagnosis_framwork diagnosis_framework_two">
            @if($ChildFullData['Placement'] == "普通班(接受特教服務)")
            <input class="option_square" type="radio" name="placement" value="普通班(接受特教服務)" checked>
            @else
            <input class="option_square" type="radio" name="placement" value="普通班(接受特教服務)">
            @endif
            <span class="choice-css">普通班(接受特教服務)</span>
        </label>
        <label class="diagnosis_framwork diagnosis_framework_two">
            @if($ChildFullData['Placement'] == "不分類巡迴輔導班")
            <input class="option_square" type="radio" name="placement" value="不分類巡迴輔導班" checked>
            @else
            <input class="option_square" type="radio" name="placement" value="不分類巡迴輔導班">
            @endif
            <span class="choice-css">不分類巡迴輔導班</span>
        </label>
    </div>
</div>
<!--第七項end-->