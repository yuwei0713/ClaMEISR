<div id="Family">
    <div class="std_information_framwork" id="q14">
        <div class="option_title">同住者
            <span style="color:red">*</span>
        </div>
        <div class="living">
            @if(preg_match("/father/",$ChildFullData['Resident']))
            <label class="living_framwork input-option input-click-option">
                <input class="option_square" type="checkbox" name="living[]" value="father" checked>
                <span class="choice-css">父</span>
            </label>
            @else
            <label class="living_framwork input-option">
                <input class="option_square" type="checkbox" name="living[]" value="father">
                <span class="choice-css">父</span>
            </label>
            @endif

            @if(preg_match("/mother/",$ChildFullData['Resident']))
            <label class="living_framwork input-option input-click-option">
                <input class="option_square" type="checkbox" name="living[]" value="mother" checked>
                <span class="choice-css">母</span>
            </label>
            @else
            <label class="living_framwork input-option">
                <input class="option_square" type="checkbox" name="living[]" value="mother">
                <span class="choice-css">母</span>
            </label>
            @endif

            @if(preg_match("/grandfather/",$ChildFullData['Resident']))
            <label class="living_framwork input-option input-click-option">
                <input class="option_square" type="checkbox" name="living[]" value="grandfather" checked>
                <span class="choice-css">爺爺</span>
            </label>
            @else
            <label class="living_framwork input-option">
                <input class="option_square" type="checkbox" name="living[]" value="grandfather">
                <span class="choice-css">爺爺</span>
            </label>
            @endif

            @if(preg_match("/grandmother/",$ChildFullData['Resident']))
            <label class="living_framwork input-option input-click-option">
                <input class="option_square" type="checkbox" name="living[]" value="grandmother" checked>
                <span class="choice-css">奶奶</span>
            </label>
            @else
            <label class="living_framwork input-option">
                <input class="option_square" type="checkbox" name="living[]" value="grandmother">
                <span class="choice-css">奶奶</span>
            </label>
            @endif

            @if($ChildFullData['OtherResident'] == "" || $ChildFullData['OtherResident'] == null)
            <label class="living_framwork input-option">
                <input class="option_square" type="checkbox" name="living[]" value="other">
                <span class="choice-css">其他</span>
            </label>
            @else
            <script>
                $(document).ready(function() {
                    $("#other_living").css("display", "block");
                });
            </script>
            <label class="living_framwork input-option input-click-option">
                <input class="option_square" type="checkbox" name="living[]" value="other" checked>
                <span class="choice-css">其他</span>
            </label>
            @endif
        </div>
        <div id="other_living" class="input_style other_framework">
            @if($ChildFullData['OtherResident'] == "" || $ChildFullData['OtherResident'] == null)
            <input name="living_other_content" id="living_other_content" class="other_style" type="text" value="" placeholder="請輸入其他同住者" maxlength="30">
            @else
            <input name="living_other_content" id="living_other_content" class="other_style" type="text" value="{{ $ChildFullData['OtherResident'] }}" placeholder="請輸入其他同住者" maxlength="30">
            @endif
        </div>
        <div class="option_title">主要照顧者
            <span style="color:red">*</span>
        </div>
        <div>
            <div class="fst_attend">
                @if($ChildFullData['Fst-attend'] == "father" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="fst_attend" value="father" checked>
                    <span class="choice-css">父</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="fst_attend" value="father">
                    <span class="choice-css">父</span>
                </label>
                @endif

                @if($ChildFullData['Fst-attend'] == "mother" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="fst_attend" value="mother" checked>
                    <span class="choice-css">母</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="fst_attend" value="mother">
                    <span class="choice-css">母</span>
                </label>
                @endif

                @if($ChildFullData['Fst-attend'] == "grandfather" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="fst_attend" value="grandfather" checked>
                    <span class="choice-css">爺爺</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="fst_attend" value="grandfather">
                    <span class="choice-css">爺爺</span>
                </label>
                @endif

                @if($ChildFullData['Fst-attend'] == "grandmother" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="fst_attend" value="grandmother" checked>
                    <span class="choice-css">奶奶</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="fst_attend" value="grandmother">
                    <span class="choice-css">奶奶</span>
                </label>
                @endif

                @if(preg_match("/other-/",$ChildFullData['Fst-attend']))
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="fst_attend" value="other" checked>
                    <span class="choice-css">其他</span>
                </label>
                <script>
                    $(document).ready(function() {
                        $("#other_fst_attend").css("display", "block");
                    });
                </script>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="fst_attend" value="other">
                    <span class="choice-css">其他</span>
                </label>
                @endif
            </div>
        </div>
        <div id="other_fst_attend" class="input_style other_framework">
            @if(preg_match("/other-/",$ChildFullData['Fst-attend']))
            @php
            $OtherFst = str_replace("other-", "", $ChildFullData['Fst-attend']);
            @endphp
            <input name="fst_attend_other" id="fst_attend_other_content" class="other_style" type="text" value="{{ $OtherFst }}" placeholder="請輸入主要照顧者" maxlength="20">
            @else
            <input name="fst_attend_other" id="fst_attend_other_content" class="other_style" type="text" value="" placeholder="請輸入主要照顧者" maxlength="20">
            @endif
        </div>
        <div class="option_title">次要照顧者</div>
        <div>
            <div class="sec_attend">
                @if($ChildFullData['Sec-attend'] == "father" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="sec_attend" value="father" checked>
                    <span class="choice-css">父</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="sec_attend" value="father">
                    <span class="choice-css">父</span>
                </label>
                @endif

                @if($ChildFullData['Sec-attend'] == "mother" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="sec_attend" value="mother" checked>
                    <span class="choice-css">母</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="sec_attend" value="mother">
                    <span class="choice-css">母</span>
                </label>
                @endif

                @if($ChildFullData['Sec-attend'] == "grandfather" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="sec_attend" value="grandfather" checked>
                    <span class="choice-css">爺爺</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="sec_attend" value="grandfather">
                    <span class="choice-css">爺爺</span>
                </label>
                @endif

                @if($ChildFullData['Sec-attend'] == "grandmother" )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="sec_attend" value="grandmother" checked>
                    <span class="choice-css">奶奶</span>
                </label>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="sec_attend" value="grandmother">
                    <span class="choice-css">奶奶</span>
                </label>
                @endif

                @if( preg_match("/other-/",$ChildFullData['Sec-attend']) )
                <label class="living_framwork input-option input-click-option">
                    <input class="option_square" type="radio" name="sec_attend" value="other" checked>
                    <span class="choice-css">其他</span>
                </label>
                <script>
                    $(document).ready(function() {
                        $("#other_sec_attend").css("display", "block");
                    });
                </script>
                @else
                <label class="living_framwork input-option">
                    <input class="option_square" type="radio" name="sec_attend" value="other">
                    <span class="choice-css">其他</span>
                </label>
                @endif
            </div>
        </div>
        <div id="other_sec_attend" class="input_style other_framework">
            @if(preg_match("/other-/",$ChildFullData['Sec-attend']))
            @php
            $OtherSec = str_replace("other-", "", $ChildFullData['Sec-attend']);
            @endphp
            <input name="sec_attend_other" id="sec_attend_other_content" class="other_style" type="text" value="{{ $OtherSec }}" placeholder="請輸入次要照顧者" maxlength="20">
            @else
            <input name="sec_attend_other" id="sec_attend_other_content" class="other_style" type="text" value="" placeholder="請輸入次要照顧者" maxlength="20">
            @endif
        </div>
    </div>
</div>