<div class="option_title">
<span class="need">*</span>教師輔導特殊生經驗：</div>
<div class="teacher_option_content">
    @if(preg_match("/1~2年/",$TeacherData["Counseling"]))
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="1~2年" checked>
        </span>
        <span class="option_value">1~2年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="3~4年">
        </span>
        <span class="option_value">3~4年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="5~6年">
        </span>
        <span class="option_value">5~6年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="6年以上">
        </span>
        <span class="option_value">6年以上</span>
    </label>
    @elseif(preg_match("/3~4年/",$TeacherData["Counseling"]))
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="1~2年">
        </span>
        <span class="option_value">1~2年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="3~4年" checked>
        </span>
        <span class="option_value">3~4年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="5~6年">
        </span>
        <span class="option_value">5~6年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="6年以上">
        </span>
        <span class="option_value">6年以上</span>
    </label>
    @elseif(preg_match("/5~6年/",$TeacherData["Counseling"]))
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="1~2年">
        </span>
        <span class="option_value">1~2年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="3~4年">
        </span>
        <span class="option_value">3~4年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="5~6年" checked>
        </span>
        <span class="option_value">5~6年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="6年以上">
        </span>
        <span class="option_value">6年以上</span>
    </label>
    @elseif(preg_match("/6年以上/",$TeacherData["Counseling"]))
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="1~2年">
        </span>
        <span class="option_value">1~2年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="3~4年">
        </span>
        <span class="option_value">3~4年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="5~6年">
        </span>
        <span class="option_value">5~6年</span>
    </label>
    <label class="counseling_option">
        <span class="option_position">
            <input class="option_circle" type="radio" name="counseling" value="6年以上" checked>
        </span>
        <span class="option_value">6年以上</span>
    </label>
    @endif
</div>