<form action="{{ route('child.history.information.perform') }}" method="POST" id="CIForm">
    @csrf
    <input type="hidden" name="OldStudentID" value="{{ $ChildFullData['StudentID'] }}">
    <div>
        <div>
            <div>
                <div class="std_information_framwork" id="q0">
                    <div class="option_title">診斷狀態
                    <span style="color:red">*</span>
                    </div>
                    @if($ChildFullData['Status'] == "confirm")
                    <div class="status">
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="confirm" checked>
                            </span>
                            <span class="choice-css">特殊生</span>
                        </label>
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="suspected">
                            </span>
                            <span class="choice-css">疑似生</span>
                        </label>
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="none">
                            </span>
                            <span class="choice-css">一般生</span>
                        </label>
                    </div>
                    @elseif($ChildFullData['Status'] == "suspected")
                    <div class="status">
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="confirm">
                            </span>
                            <span class="choice-css">特殊生</span>
                        </label>
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="suspected" checked>
                            </span>
                            <span class="choice-css">疑似生</span>
                        </label>
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="none">
                            </span>
                            <span class="choice-css">一般生</span>
                        </label>
                    </div>
                    @elseif($ChildFullData['Status'] == "none")
                    <div class="status">
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="confirm">
                            </span>
                            <span class="choice-css">特殊生</span>
                        </label>
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="suspected">
                            </span>
                            <span class="choice-css">疑似生</span>
                        </label>
                        <label class="status_option">
                            <span class="option_position">
                                <input class="option_circle" name="status" type="radio" value="none" checked>
                            </span>
                            <span class="choice-css">一般生</span>
                        </label>
                    </div>
                    @endif
                </div>
                <div class="std_information_framwork" id="q1">
                    <div class="option_title">兒童姓名
                    <span style="color:red">*</span>
                    </div>
                    <div class="input_style">
<<<<<<< HEAD
                        <input id="student_name" name="student_name" class="student_name_style" type="text" value="{{ $ChildFullData['StudentName'] }}">
=======
                        <input id="student_name" name="student_name" class="student_name_style" type="text" value="{{ $ChildFullData['StudentName'] }}" maxlength="10">
>>>>>>> dev
                    </div>
                </div>
                <div class="std_information_framwork" id="q2">
                    <div class="school_information_framwork">
                        <div class="school_inner_framwork">
                            <div class="option_title">班級
                            <span style="color:red">*</span>
                            </div>
                            <div class="input_style">
                                <select id="class_name" name="class_name" class="class_option">
                                    @foreach ($Class as $class)
                                    @if($class['ClassCode'] == $ChildFullData['ClassCode'])
                                    <option value="{{$class['ClassName']}}-{{$class['ClassCode']}}" selected>{{ $class['ClassName'] }}</option>
                                    @else
                                    <option value="{{$class['ClassName']}}-{{$class['ClassCode']}}">{{ $class['ClassName'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="school_inner_framwork">
                            <div class="option_title">座號
                            <span style="color:red">*</span>
                            </div>
                            <div class="input_style">
                                <input id="student_code" name="student_code" class="student_name_style" type="number" value="{{ intval($ChildFullData['StudentCode']) }}" oninput="if(value.length>2)value=value.slice(0,2)">
                            </div>
                        </div>
                        <div class="school_inner_framwork">
                            <div class="option_title">學校
                            <span style="color:red">*</span>
                            </div>
                            <div class="input_style">
                                <input name="school_name" id="school_name" class="student_name_style school_style" type="text" readonly="readonly" value="{{ $ChildFullData['SchoolName'] }}">
                                <input type="hidden" name="school_code" value="{{ $ChildFullData['SchoolCode'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" std_information_framwork" id="q3">
                    <div class="option_title">兒童性別
                    <span style="color:red">*</span>
                    </div>
                    <div class="option_content">
                        @if($ChildFullData['Gender'] == "male")
                        <label class="gender_option">
                            <span class="option_position">
                                <input class="option_circle" type="radio" name="gender" value="male" checked>
                            </span>
                            <span class="option_value">男</span>
                        </label>
                        <label class="gender_option">
                            <span class="option_position">
                                <input class="option_circle" type="radio" name="gender" value="female">
                            </span>
                            <span class="option_value">女</span>
                        </label>
                        @elseif($ChildFullData['Gender'] == "female")
                        <label class="gender_option">
                            <span class="option_position">
                                <input class="option_circle" type="radio" name="gender" value="male">
                            </span>
                            <span class="option_value">男</span>
                        </label>
                        <label class="gender_option">
                            <span class="option_position">
                                <input class="option_circle" type="radio" name="gender" value="female" checked>
                            </span>
                            <span class="option_value">女</span>
                        </label>
                        @endif
                    </div>
                </div>
                <div class="std_information_framwork" id="q4">
                    <div class="student_age_framwork">
                        <div class="student_age_inner_framwork">
                            <div class="option_title">兒童生日
                            <span style="color:red">*</span>
                            </div>
                            <div>
                                <input name="age_datepicker" id="age_datepicker" width="276" autocomplete="off" onchange="count_age()" value="{{ $ChildFullData['BirthDay'] }}" />
                                <script>
                                    maxdate = new Date(new Date().getFullYear()-2, new Date().getMonth(), new Date().getDate());
                                    $('#age_datepicker').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        format: 'yyyy-mm-dd',
                                        maxDate: maxdate,
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="student_age_inner_framwork">
                            <div class="option_title">
                                <span>兒童年齡 (將由系統計算)</span>
                            </div>
                            <div class="input_style">
                                <input name="child_age" id="child_age" class="student_name_style" type="text" placeholder="" readonly="readonly" value="{{ $ChildFullData['Age'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="std_information_framwork" id="q5">
                    <div class="student_age_framwork">
                        <div class="student_age_inner_framwork">
                            <div class="option_title">入學年度
                            <span style="color:red">*</span>
                            </div>
                            <div class="input_style">
<<<<<<< HEAD
                                <input name="year" id="year" class="student_name_style" type="text" value="{{ $ChildFullData['Year'] }}">
=======
                                <input name="year" id="year" class="student_name_style" type="number" value="{{ $ChildFullData['Year'] }}" oninput="if(value.length>3)value=value.slice(0,3)">
>>>>>>> dev
                            </div>
                        </div>
                        <div class="student_age_inner_framwork">
                            <div class="option_title">入學學期
                            <span style="color:red">*</span>
                            </div>
                            <div class="option_content">
                                @if($ChildFullData['Semester'] == "上")
                                <label class="semester_option">
                                    <span class="option_position">
                                        <input class="option_circle" type="radio" name="semester" value="上" checked>
                                    </span>
                                    <span class="option_value">上</span>
                                </label>
                                <label class="semester_option">
                                    <span class="option_position">
                                        <input class="option_circle" type="radio" name="semester" value="下">
                                    </span>
                                    <span class="option_value">下</span>
                                </label>
                                @elseif($ChildFullData['Semester'] == "下")
                                <label class="semester_option">
                                    <span class="option_position">
                                        <input class="option_circle" type="radio" name="semester" value="上">
                                    </span>
                                    <span class="option_value">上</span>
                                </label>
                                <label class="semester_option">
                                    <span class="option_position">
                                        <input class="option_circle" type="radio" name="semester" value="下" checked>
                                    </span>
                                    <span class="option_value">下</span>
                                </label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="std_information_framwork" id="q6">
                    <div class="option_title">量表填答人
                    <span style="color:red">*</span>
                    </div>
                    <div class="input_style">
<<<<<<< HEAD
                        <input name="quest_name" id="quest_name" class="student_name_style" type="text" value="{{ $TeacherName }}">
=======
                        <input name="quest_name" id="quest_name" class="student_name_style" readonly="readonly" type="text" value="{{ $TeacherName }}">
>>>>>>> dev
                    </div>
                </div>
                @if($ChildFullData['Status'] == "confirm" )
                <script>
                    $(document).ready(function() {
                        $("#status-suspected").css("display", "none");
                    })
                </script>
                <!--有症狀-->
                <div id="status-confirm">
                    @include('layouts.childhistorydata.ConfirmPage')
                </div>
                <div id="status-suspected">
                    @include('layouts.childdata.SuspectedPage')
                </div>
                @elseif($ChildFullData['Status'] == "suspected")
                <script>
                    $(document).ready(function() {
                        $("#status-confirm").css("display", "none");
                    })
                </script>
                <!--疑似症狀-->
                <div id="status-confirm">
                    @include('layouts.childdata.ConfirmPage')
                </div>
                <div id="status-suspected">
                    @include('layouts.childhistorydata.SuspectedPage')
                </div>
                @elseif($ChildFullData['Status'] == "none")
                <script>
                    $(document).ready(function() {
                        $("#status-confirm").css("display", "none");
                        $("#status-suspected").css("display", "none");
                    })
                </script>
                <!--無症狀-->
                <div id="status-confirm">
                    @include('layouts.childdata.ConfirmPage')
                </div>
                <div id="status-suspected">
                    @include('layouts.childdata.SuspectedPage')
                </div>
                @endif
                <div class="std_information_framwork" id="q14">
                    <div class="option_title">同住者
                    <span style="color:red">*</span>
                    </div>
                    <div class="living">
                        <label class="living_framwork">
                            @if(preg_match("/father/",$ChildFullData['Resident']))
                            <input class="option_square" type="checkbox" name="living[]" value="father" checked>
                            @else
                            <input class="option_square" type="checkbox" name="living[]" value="father">
                            @endif
                            <span class="choice-css">父</span>
                        </label>
                        <label class="living_framwork">
                            @if(preg_match("/mother/",$ChildFullData['Resident']))
                            <input class="option_square" type="checkbox" name="living[]" value="mother" checked>
                            @else
                            <input class="option_square" type="checkbox" name="living[]" value="mother">
                            @endif
                            <span class="choice-css">母</span>
                        </label>
                        <label class="living_framwork">
                            @if(preg_match("/grandfather/",$ChildFullData['Resident']))
                            <input class="option_square" type="checkbox" name="living[]" value="grandfather" checked>
                            @else
                            <input class="option_square" type="checkbox" name="living[]" value="grandfather">
                            @endif
                            <span class="choice-css">爺爺</span>
                        </label>
                        <label class="living_framwork">
                            @if(preg_match("/grandmother/",$ChildFullData['Resident']))
                            <input class="option_square" type="checkbox" name="living[]" value="grandmother" checked>
                            @else
                            <input class="option_square" type="checkbox" name="living[]" value="grandmother">
                            @endif
                            <span class="choice-css">奶奶</span>
                        </label>
                        <label class="living_framwork">
                            @if($ChildFullData['OtherResident'] == "" || $ChildFullData['OtherResident'] == null)
                            <input id="livingother" class="option_square" type="checkbox" onclick="living_other()">
                            @else
                            <script>
                                    $(document).ready(function() {
                                        $("#other_living").css("display", "block");
                                    });
                                </script>
                            <input id="livingother" class="option_square" type="checkbox" onclick="living_other()" checked>
                            @endif
                            <span class="choice-css">其他</span>
                        </label>
                    </div>
                    <div id="other_living" class="input_style other_framework">
                        @if($ChildFullData['OtherResident'] == "" || $ChildFullData['OtherResident'] == null)
<<<<<<< HEAD
                        <input name="living_other_content" id="living_other_content" class="other_style" type="text" value="" placeholder="請輸入其他同住者">
                        @else
                        <input name="living_other_content" id="living_other_content" class="other_style" type="text" value="{{ $ChildFullData['OtherResident'] }}" placeholder="請輸入其他同住者">
=======
                        <input name="living_other_content" id="living_other_content" class="other_style" type="text" value="" placeholder="請輸入其他同住者" maxlength="30">
                        @else
                        <input name="living_other_content" id="living_other_content" class="other_style" type="text" value="{{ $ChildFullData['OtherResident'] }}" placeholder="請輸入其他同住者" maxlength="30">
>>>>>>> dev
                        @endif
                    </div>
                    <div class="option_title">主要照顧者
                    <span style="color:red">*</span>
                    </div>
                    <div>
                        <div class="fst_attend">
                            <label class="living_framwork">
                                @if($ChildFullData['Fst-attend'] == "father" )
                                <input class="option_square" type="radio" name="fst_attend" value="father" checked>
                                @else
                                <input class="option_square" type="radio" name="fst_attend" value="father">
                                @endif
                                <span class="choice-css">父</span>
                            </label>
                            <label class="living_framwork">
                                @if($ChildFullData['Fst-attend'] == "mother" )
                                <input class="option_square" type="radio" name="fst_attend" value="mother" checked>
                                @else
                                <input class="option_square" type="radio" name="fst_attend" value="mother">
                                @endif
                                <span class="choice-css">母</span>
                            </label>
                            <label class="living_framwork">
                                @if($ChildFullData['Fst-attend'] == "grandfather" )
                                <input class="option_square" type="radio" name="fst_attend" value="grandfather" checked>
                                @else
                                <input class="option_square" type="radio" name="fst_attend" value="grandfather">
                                @endif
                                <span class="choice-css">爺爺</span>
                            </label>
                            <label class="living_framwork">
                                @if($ChildFullData['Fst-attend'] == "grandmother" )
                                <input class="option_square" type="radio" name="fst_attend" value="grandmother" checked>
                                @else
                                <input class="option_square" type="radio" name="fst_attend" value="grandmother">
                                @endif
                                <span class="choice-css">奶奶</span>
                            </label>
                            <label class="living_framwork">
                                @if(preg_match("/other-/",$ChildFullData['Fst-attend']))
                                <script>
                                    $(document).ready(function() {
                                        $("#other_fst_attend").css("display", "block");
                                    });
                                </script>
                                <input id="fst_attendother" name="fst_attend" class="option_square" type="radio" value="other" checked>
                                @else
                                <input id="fst_attendother" name="fst_attend" class="option_square" type="radio" value="other">
                                @endif
                                <span class="choice-css">其他</span>
                            </label>
                        </div>
                    </div>
                    <div id="other_fst_attend" class="input_style other_framework">
                        @if(preg_match("/other-/",$ChildFullData['Fst-attend']))
                        @php
                        $OtherFst = str_replace("other-", "", $ChildFullData['Fst-attend']);
                        @endphp
<<<<<<< HEAD
                        <input name="fst_attend_other" id="fst_attend_other_content" class="other_style" type="text" value="{{ $OtherFst }}" placeholder="請輸入主要照顧者">
                        @else
                        <input name="fst_attend_other" id="fst_attend_other_content" class="other_style" type="text" value="" placeholder="請輸入主要照顧者">
=======
                        <input name="fst_attend_other" id="fst_attend_other_content" class="other_style" type="text" value="{{ $OtherFst }}" placeholder="請輸入主要照顧者" maxlength="20">
                        @else
                        <input name="fst_attend_other" id="fst_attend_other_content" class="other_style" type="text" value="" placeholder="請輸入主要照顧者" maxlength="20">
>>>>>>> dev
                        @endif
                    </div>
                    <div class="option_title">次要照顧者</div>
                    <div>
                        <div class="sec_attend">
                            <label class="living_framwork">
                                @if($ChildFullData['Sec-attend'] == "father" )
                                <input class="option_square" type="radio" name="sec_attend" value="father" checked>
                                @else
                                <input class="option_square" type="radio" name="sec_attend" value="father">
                                @endif
                                <span class="choice-css">父</span>
                            </label>
                            <label class="living_framwork">
                                @if($ChildFullData['Sec-attend'] == "mother" )
                                <input class="option_square" type="radio" name="sec_attend" value="mother" checked>
                                @else
                                <input class="option_square" type="radio" name="sec_attend" value="mother">
                                @endif
                                <span class="choice-css">母</span>
                            </label>
                            <label class="living_framwork">
                                @if($ChildFullData['Sec-attend'] == "grandfather" )
                                <input class="option_square" type="radio" name="sec_attend" value="grandfather" checked>
                                @else
                                <input class="option_square" type="radio" name="sec_attend" value="grandfather">
                                @endif
                                <span class="choice-css">爺爺</span>
                            </label>
                            <label class="living_framwork">
                                @if($ChildFullData['Sec-attend'] == "grandmother" )
                                <input class="option_square" type="radio" name="sec_attend" value="grandmother" checked>
                                @else
                                <input class="option_square" type="radio" name="sec_attend" value="grandmother">
                                @endif
                                <span class="choice-css">奶奶</span>
                            </label>
                            <label class="living_framwork">
                                @if( preg_match("/other-/",$ChildFullData['Sec-attend']) )
                                <script>
                                    $(document).ready(function() {
                                        $("#other_sec_attend").css("display", "block");
                                    });
                                </script>
                                <input id="fst_attendother" name="sec_attend" class="option_square" type="radio" value="other" checked>
                                @else
                                <input id="fst_attendother" name="sec_attend" class="option_square" type="radio" value="other">
                                @endif
                                <span class="choice-css">其他</span>
                            </label>
                        </div>
                    </div>
                    <div id="other_sec_attend" class="input_style other_framework">
                        @if(preg_match("/other-/",$ChildFullData['Sec-attend']))
                        @php
                        $OtherSec = str_replace("other-", "", $ChildFullData['Sec-attend']);
                        @endphp
<<<<<<< HEAD
                        <input name="sec_attend_other" id="sec_attend_other_content" class="other_style" type="text" value="{{ $OtherSec }}" placeholder="請輸入次要照顧者">
                        @else
                        <input name="sec_attend_other" id="sec_attend_other_content" class="other_style" type="text" value="" placeholder="請輸入次要照顧者">
=======
                        <input name="sec_attend_other" id="sec_attend_other_content" class="other_style" type="text" value="{{ $OtherSec }}" placeholder="請輸入次要照顧者" maxlength="20">
                        @else
                        <input name="sec_attend_other" id="sec_attend_other_content" class="other_style" type="text" value="" placeholder="請輸入次要照顧者" maxlength="20">
>>>>>>> dev
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="send-framwork">
        <div class="pre-page">
            <button type="button" class="pre-button" onclick="history.back()"><span>回首頁</span></button>
        </div>
        <div class="next-page">
            <button type="button" class="next-button" onclick="checkoutput()"><span>修改</span></button>
            <div id="fill_alart" class="fill-alart"></div>
        </div>
    </div>
</form>