<div id="Basic">
    <div>
        <div>
            <div class="std_information_framwork" id="q0">
                <div class="option_title">診斷狀態
                    <span class="need">*</span>
                </div>
                <div class="status">
                    @if($ChildFullData['Status'] == "confirm")
                    <label class="status_option input-option input-click-option">
                        @else
                        <label class="status_option input-option">
                            @endif
                            <span class="option_position">
                                @if($ChildFullData['Status'] == "confirm")
                                <input class="option_circle" name="status" type="radio" value="confirm" checked>
                                @else
                                <input class="option_circle" name="status" type="radio" value="confirm">
                                @endif
                            </span>
                            <span class="choice-css">特殊生</span>
                        </label>
                        @if($ChildFullData['Status'] == "suspected")
                        <label class="status_option input-option input-click-option">
                            @else
                            <label class="status_option input-option">
                                @endif
                                <span class="option_position">
                                    @if($ChildFullData['Status'] == "suspected")
                                    <input class="option_circle" name="status" type="radio" value="suspected" checked>
                                    @else
                                    <input class="option_circle" name="status" type="radio" value="suspected">
                                    @endif
                                </span>
                                <span class="choice-css">疑似生</span>
                            </label>
                            @if($ChildFullData['Status'] == "none")
                            <label class="status_option input-option input-click-option">
                                @else
                                <label class="status_option input-option">
                                    @endif
                                    <span class="option_position">
                                        @if($ChildFullData['Status'] == "none")
                                        <input class="option_circle" name="status" type="radio" value="none" checked>
                                        @else
                                        <input class="option_circle" name="status" type="radio" value="none">
                                        @endif
                                    </span>
                                    <span class="choice-css">一般生</span>
                                </label>
                </div>
            </div>
            <div class="std_information_framwork" id="q1">
                <div class="option_title">兒童姓名
                    <span class="need">*</span>
                </div>
                <div class="input_style">
                    <input id="student_name" name="student_name" class="student_name_style" type="text" placeholder="請輸入學生姓名" maxlength="10" value="{{ $ChildFullData['StudentName'] }}">
                </div>
            </div>
            <div class="std_information_framwork" id="q2">
                <div class="school_information_framwork">
                    <div class="school_inner_framwork">
                        <div class="option_title">班級
                            <span class="need">*</span>
                        </div>
                        <div class="input_style">
                            <select id="class_name" name="class_name" class="class_option input-option">
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
                            <span class="need">*</span>
                        </div>
                        <div class="input_style">
                            <input id="student_code" name="student_code" class="student_name_style" type="number" placeholder="請輸入座號" value="{{ intval($ChildFullData['StudentCode']) }}" oninput="if(value.length>2)value=value.slice(0,2)">
                        </div>
                    </div>
                    <div class="school_inner_framwork">
                        <div class="option_title">學校
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
                    <span class="need">*</span>
                </div>
                <div class="option_content">
                    @if($ChildFullData['Gender'] == "male")
                    <label class="gender_option input-option input-click-option">
                        <span class="option_position">
                            <input class="option_circle" type="radio" name="gender" value="male" checked>
                        </span>
                        <span class="option_value">男</span>
                    </label>
                    <label class="gender_option input-option">
                        <span class="option_position">
                            <input class="option_circle" type="radio" name="gender" value="female">
                        </span>
                        <span class="option_value">女</span>
                    </label>
                    @else
                    <label class="gender_option input-option">
                        <span class="option_position">
                            <input class="option_circle" type="radio" name="gender" value="male">
                        </span>
                        <span class="option_value">男</span>
                    </label>
                    <label class="gender_option input-option input-click-option">
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
                            <span class="need">*</span>
                        </div>
                        <div>
                            <input class="input-group date" name="age_datepicker" id="age_datepicker" width="276" autocomplete="off" value="{{ $ChildFullData['BirthDay'] }}" />
                        </div>
                    </div>
                    <div class="student_age_inner_framwork">
                        <div class="option_title">
                            <span>兒童年齡 (將由系統計算)</span>
                        </div>
                        <div class="input_style">
                            <input name="child_age" id="child_age" class="student_name_style age_style" type="text" placeholder="" readonly="readonly" value="{{ $ChildFullData['Age'] }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="std_information_framwork" id="q5">
                <div class="student_age_framwork">
                    <div class="student_age_inner_framwork">
                        <div class="option_title">入學年度
                            <span class="need">*</span>
                        </div>
                        <div class="input_style">
                            <input name="year" id="year" class="student_name_style" type="number" value="{{ $ChildFullData['Year'] }}" oninput="if(value.length>3)value=value.slice(0,3)">
                        </div>
                    </div>
                    <div class="student_age_inner_framwork">
                        <div class="option_title">入學學期
                            <span class="need">*</span>
                        </div>
                        <div class="option_content">
                            @if($ChildFullData['Semester'] == "上")
                            <label class="semester_option input-option input-click-option">
                            @else
                            <label class="semester_option input-option">
                            @endif
                                <span class="option_position">
                                    @if($ChildFullData['Semester'] == "上")
                                    <input class="option_circle" type="radio" name="semester" value="上" checked>
                                    @else
                                    <input class="option_circle" type="radio" name="semester" value="上">
                                    @endif
                                </span>
                                <span class="option_value">上</span>
                            </label>
                            @if($ChildFullData['Semester'] == "下")
                            <label class="semester_option input-option input-click-option">
                            @else
                            <label class="semester_option input-option">
                            @endif
                                <span class="option_position">
                                    @if($ChildFullData['Semester'] == "下")
                                    <input class="option_circle" type="radio" name="semester" value="下" checked>
                                    @else
                                    <input class="option_circle" type="radio" name="semester" value="下">
                                    @endif
                                </span>
                                <span class="option_value">下</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="std_information_framwork" id="q6">
                <div class="option_title">量表填答人
                    <span class="need">*</span>
                </div>
                <div class="input_style">
                    <input name="quest_name" id="quest_name" class="student_name_style" type="text" value="{{ $TeacherName }}" readonly="readonly">
                </div>
            </div>
        </div>
    </div>
</div>