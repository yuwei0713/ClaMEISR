<div class="option_title"><span class="need">*</span>於幼兒園服務的經驗：</div>
<div class="teacher_option_content">
    @if(preg_match("/1~3年/",$TeacherData["Kindergarten"]))
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="1~3年" checked>
        </span>
        <span class="option_value">1~3年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="4~6年">
        </span>
        <span class="option_value">4~6年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="7~9年">
        </span>
        <span class="option_value">7~9年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="10年以上">
        </span>
        <span class="option_value">10年以上</span>
    </label>
    @elseif(preg_match("/4~6年/",$TeacherData["Kindergarten"]))
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="1~3年">
        </span>
        <span class="option_value">1~3年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="4~6年" checked>
        </span>
        <span class="option_value">4~6年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="7~9年">
        </span>
        <span class="option_value">7~9年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="10年以上">
        </span>
        <span class="option_value">10年以上</span>
    </label>
    @elseif(preg_match("/7~9年/",$TeacherData["Kindergarten"]))
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="1~3年">
        </span>
        <span class="option_value">1~3年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="4~6年">
        </span>
        <span class="option_value">4~6年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="7~9年" checked>
        </span>
        <span class="option_value">7~9年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="10年以上">
        </span>
        <span class="option_value">10年以上</span>
    </label>
    @elseif(preg_match("/10年/",$TeacherData["Kindergarten"]))
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="1~3年">
        </span>
        <span class="option_value">1~3年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="4~6年">
        </span>
        <span class="option_value">4~6年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="7~9年">
        </span>
        <span class="option_value">7~9年</span>
    </label>
    <label class="kindergarten_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="kindergarten" value="10年以上" checked>
        </span>
        <span class="option_value">10年以上</span>
    </label>
    @endif
</div>