<div id="Diagnosis">
    <!--第一項 7 障礙類別(特殊生)，疑似障礙類別(疑似生)-->
    <div class="std_information_framwork" id="q7">
        <div class="option_title">障礙類別(單選)
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            @if($ChildFullData['Diagnosis'] == "智能障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="智能障礙" checked>
                <span class="choice-css">智能障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="智能障礙">
                <span class="choice-css">智能障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "視覺障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="視覺障礙" checked>
                <span class="choice-css">視覺障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="視覺障礙">
                <span class="choice-css">視覺障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "聽覺障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="聽覺障礙" checked>
                <span class="choice-css">聽覺障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="聽覺障礙">
                <span class="choice-css">聽覺障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "語言障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="語言障礙" checked>
                <span class="choice-css">語言障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="語言障礙">
                <span class="choice-css">語言障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "腦性麻痺")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="腦性麻痺" checked>
                <span class="choice-css">腦性麻痺</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="腦性麻痺">
                <span class="choice-css">腦性麻痺</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "肢體障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="肢體障礙" checked>
                <span class="choice-css">肢體障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="肢體障礙">
                <span class="choice-css">肢體障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "身體病弱")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="身體病弱" checked>
                <span class="choice-css">身體病弱</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="身體病弱">
                <span class="choice-css">身體病弱</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "情緒行為障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="情緒行為障礙" checked>
                <span class="choice-css">情緒行為障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="情緒行為障礙">
                <span class="choice-css">情緒行為障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "學習障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="學習障礙" checked>
                <span class="choice-css">學習障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="學習障礙">
                <span class="choice-css">學習障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "多重障礙")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="多重障礙" checked>
                <span class="choice-css">多重障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="多重障礙">
                <span class="choice-css">多重障礙</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "自閉症")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="自閉症" checked>
                <span class="choice-css">自閉症</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="自閉症">
                <span class="choice-css">自閉症</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "發展遲緩")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="發展遲緩" checked>
                <span class="choice-css">發展遲緩</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="發展遲緩">
                <span class="choice-css">發展遲緩</span>
            </label>
            @endif

            @if($ChildFullData['Diagnosis'] == "other")
            <script src="../newframework/js/childhistorydata/otherdiagnosisblock.js"></script>
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="diagnosis" value="other" checked>
                <span class="choice-css">其他障礙</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="diagnosis" value="other">
                <span class="choice-css">其他障礙</span>
            </label>
            @endif

        </div>
        <div id="other_diagnosis" class="input_style other_framework">
            @if($ChildFullData['Diagnosis'] == "other")
            <input name="diagnosis_other_content" id="diagnosis_other_content" class="other_style" type="text" value="{{ $ChildFullData['OtherDiagnosis'] }}" placeholder="請描述其他症狀" maxlength="20">
            @else
            <input name="diagnosis_other_content" id="diagnosis_other_content" class="other_style" type="text" value="" placeholder="請描述其他症狀" maxlength="20">
            @endif
        </div>
    </div>
    <!--第一項end-->
    <!--第二項 8 障礙程度(特殊生)-->
    @if($ChildFullData['Status'] == "confirm")
        @if($ChildFullData['Diagnosis'] != "other")
        <script src="../newframework/js/childhistorydata/manualblock.js"></script>
        @else
        <script src="../newframework/js/childhistorydata/manualnone.js"></script>
        @endif
    <div class="std_information_framwork manual_option" id="q8">
        <div class="option_title">障礙程度
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            @if($ChildFullData['Degree'] == "輕度")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="degree" value="輕度" checked>
                <span class="choice-css">輕度</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="輕度">
                <span class="choice-css">輕度</span>
            </label>
            @endif

            @if($ChildFullData['Degree'] == "中度")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="degree" value="中度" checked>
                <span class="choice-css">中度</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="中度">
                <span class="choice-css">中度</span>
            </label>
            @endif

            @if($ChildFullData['Degree'] == "中重度")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="degree" value="中重度" checked>
                <span class="choice-css">中重度</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="中重度">
                <span class="choice-css">中重度</span>
            </label>
            @endif

            @if($ChildFullData['Degree'] == "重度")
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="radio" name="degree" value="重度" checked>
                <span class="choice-css">重度</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="重度">
                <span class="choice-css">重度</span>
            </label>
            @endif
        </div>
    </div>
    @else
    <div class="std_information_framwork manual_option" id="q8">
        <div class="option_title">障礙程度
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="輕度">
                <span class="choice-css">輕度</span>
            </label>
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="中度">
                <span class="choice-css">中度</span>
            </label>
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="中重度">
                <span class="choice-css">中重度</span>
            </label>
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="radio" name="degree" value="重度">
                <span class="choice-css">重度</span>
            </label>
        </div>
    </div>
    @endif
    <!--第二項end-->
    <!--第三項 9 補充說明(疑似生)-->
    @if($ChildFullData['Status'] == "suspected")
    <div class="std_information_framwork" id="q9">
        <div class="option_title">補充說明
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            <label class="diagnosis_textarea_framwork">
                @if($ChildFullData['Note'] != "")
                <textarea class="diagnosis_textarea_content" id="note" name="note" rows="3" placeholder="請描述疑似症狀" maxlength="100">{{ $ChildFullData['Note'] }}</textarea>
                @else
                <textarea class="diagnosis_textarea_content" id="note" name="note" rows="3" placeholder="請描述疑似症狀" maxlength="100"></textarea>
                @endif
            </label>
        </div>
    </div>
    @else
    <div class="std_information_framwork" id="q9">
        <div class="option_title">補充說明
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            <label class="diagnosis_textarea_framwork">
                <textarea class="diagnosis_textarea_content" id="note" name="note" rows="3" placeholder="請描述疑似症狀" maxlength="100"></textarea>
            </label>
        </div>
    </div>
    @endif
    <!--第三項end-->
    <!--第四項 10 鑑定安置類別-->
    @if($ChildFullData['Diagnosis'] == "發展遲緩")
    <script src="../newframework/js/childhistorydata/diagnosisoptionblock.js"></script>
    @endif
    <div class="std_information_framwork diagnosis_option" id="q10">
        <div class="option_title">鑑定安置類別
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            @if(preg_match("/無特別標註/",$ChildFullData['Identities']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="identities[]" value="無特別標註" checked>
                <span class="choice-css">無特別標註</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="identities[]" value="無特別標註">
                <span class="choice-css">無特別標註</span>
            </label>
            @endif

            @if(preg_match("/認知/",$ChildFullData['Identities']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="identities[]" value="認知" checked>
                <span class="choice-css">認知</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="identities[]" value="認知">
                <span class="choice-css">認知</span>
            </label>
            @endif

            @if(preg_match("/語言/",$ChildFullData['Identities']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="identities[]" value="語言" checked>
                <span class="choice-css">語言</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="identities[]" value="語言">
                <span class="choice-css">語言</span>
            </label>
            @endif

            @if(preg_match("/動作/",$ChildFullData['Identities']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="identities[]" value="動作" checked>
                <span class="choice-css">動作</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="identities[]" value="動作">
                <span class="choice-css">動作</span>
            </label>
            @endif

            @if(preg_match("/社會情緒/",$ChildFullData['Identities']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="identities[]" value="社會情緒" checked>
                <span class="choice-css">社會情緒</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="identities[]" value="社會情緒">
                <span class="choice-css">社會情緒</span>
            </label>
            @endif

            @if(preg_match("/非特定性/",$ChildFullData['Identities']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="identities[]" value="非特定性" checked>
                <span class="choice-css">非特定性</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="identities[]" value="非特定性">
                <span class="choice-css">非特定性</span>
            </label>
            @endif
        </div>
    </div>
    <!--第四項end-->
    <!--第五項 11 鑑定安置佐證-->
    <div class="std_information_framwork" id="q11">
        <div class="option_title">鑑定安置佐證
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            @if(preg_match("/心理衡鑑/",$ChildFullData['Proofs']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="心理衡鑑" checked>
                <span class="choice-css">心理衡鑑定（醫院）</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="心理衡鑑">
                <span class="choice-css">心理衡鑑定（醫院）</span>
            </label>
            @endif

            @if(preg_match("/聯評報告/",$ChildFullData['Proofs']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="聯評報告" checked>
                <span class="choice-css">聯評報告</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="聯評報告">
                <span class="choice-css">聯評報告</span>
            </label>
            @endif

            @if(preg_match("/特殊教育心評/",$ChildFullData['Proofs']))
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="特殊教育心評" checked>
                <span class="choice-css">特殊教育心評</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="特殊教育心評">
                <span class="choice-css">特殊教育心評</span>
            </label>
            @endif

            @if(preg_match("/不需填寫/",$ChildFullData['Proofs']))
            <script src="../newframework/js/childhistorydata/proofnone.js"></script>
            <label class="diagnosis_framwork diagnosis_framework_four input-option input-click-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="不需填寫" checked>
                <span class="choice-css">不需填寫</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_four input-option">
                <input class="option_square" type="checkbox" name="proofs[]" value="不需填寫">
                <span class="choice-css">不需填寫</span>
            </label>
            @endif
        </div>
    </div>
    <!--第五項end-->
    <!--第六項 12 身障證明-->
    <div class="std_information_framwork" id="q12">
        <div class="option_title">是否領有身障證明
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            @if($ChildFullData['Manual'] == "yes")
            <label class="diagnosis_framwork diagnosis_framework_two input-option input-click-option">
                <input class="option_square" type="radio" name="manual" value="yes" checked>
                <span class="choice-css">是</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_two input-option">
                <input class="option_square" type="radio" name="manual" value="yes">
                <span class="choice-css">是</span>
            </label>
            @endif

            @if($ChildFullData['Manual'] == "no")
            <label class="diagnosis_framwork diagnosis_framework_two input-option input-click-option">
                <input class="option_square" type="radio" name="manual" value="no" checked>
                <span class="choice-css">否</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_two input-option">
                <input class="option_square" type="radio" name="manual" value="no">
                <span class="choice-css">否</span>
            </label>
            @endif
        </div>
    </div>
    <!--第六項end-->
    <!--第七項 13 安置結果-->
    <div class="std_information_framwork" id="q13">
        <div class="option_title">安置結果
            <span class="need">*</span>
        </div>
        <div class="diagnosis">
            @if($ChildFullData['Placement'] == "普通班(接受特教服務)")
            <label class="diagnosis_framwork diagnosis_framework_two input-option input-click-option">
                <input class="option_square" type="radio" name="placement" value="普通班(接受特教服務)" checked>
                <span class="choice-css">普通班(接受特教服務)</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_two input-option">
                <input class="option_square" type="radio" name="placement" value="普通班(接受特教服務)">
                <span class="choice-css">普通班(接受特教服務)</span>
            </label>
            @endif

            @if($ChildFullData['Placement'] == "不分類巡迴輔導班")
            <label class="diagnosis_framwork diagnosis_framework_two input-option input-click-option">
                <input class="option_square" type="radio" name="placement" value="不分類巡迴輔導班" checked>
                <span class="choice-css">不分類巡迴輔導班</span>
            </label>
            @else
            <label class="diagnosis_framwork diagnosis_framework_two input-option">
                <input class="option_square" type="radio" name="placement" value="不分類巡迴輔導班">
                <span class="choice-css">不分類巡迴輔導班</span>
            </label>
            @endif
        </div>
    </div>
    <!--第七項end-->
</div>