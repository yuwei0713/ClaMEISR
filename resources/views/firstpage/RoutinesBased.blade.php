<div class="option_title"><span style="color:red">*</span>接觸作息本位經驗：</div>
<div class="teacher_option_content">
    @if(preg_match("/1年/",$TeacherData["RoutinesBased"]))
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="1年" checked>
        </span>
        <span class="option_value">1年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="2年">
        </span>
        <span class="option_value">2年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="3年">
        </span>
        <span class="option_value">3年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="4年以上">
        </span>
        <span class="option_value">4年以上</span>
    </label>
    @elseif(preg_match("/2年/",$TeacherData["RoutinesBased"]))
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="1年">
        </span>
        <span class="option_value">1年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="2年" checked>
        </span>
        <span class="option_value">2年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="3年">
        </span>
        <span class="option_value">3年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="4年以上">
        </span>
        <span class="option_value">4年以上</span>
    </label>
    @elseif(preg_match("/3年/",$TeacherData["RoutinesBased"]))
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="1年">
        </span>
        <span class="option_value">1年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="2年">
        </span>
        <span class="option_value">2年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="3年" checked>
        </span>
        <span class="option_value">3年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="4年以上">
        </span>
        <span class="option_value">4年以上</span>
    </label>
    @elseif(preg_match("/4年/",$TeacherData["RoutinesBased"]))
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="1年">
        </span>
        <span class="option_value">1年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="2年">
        </span>
        <span class="option_value">2年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="3年">
        </span>
        <span class="option_value">3年</span>
    </label>
    <label class="routinesbased_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="routinesbased" value="4年以上" checked>
        </span>
        <span class="option_value">4年以上</span>
    </label>
    @endif
</div>