<div class="option_title"><span class="need">*</span>身分別：</div>
<div class="teacher_option_content">
    <label class="separate_option">
        <span class="option_position">
            @if($TeacherData["Separate"] == "teacher")
            <input class="option_circle" type="radio" name="separate" value="teacher" checked>
            @else
            <input class="option_circle" type="radio" name="separate" value="teacher">
            @endif
        </span>
        <span class="option_value">幼教師</span>
    </label>
    <label class="separate_option">
        <span class="option_position">
            @if($TeacherData["Separate"] == "education_staff")
            <input class="option_circle" type="radio" name="separate" value="education_staff" checked>
            @else
            <input class="option_circle" type="radio" name="separate" value="education_staff">
            @endif
        </span>
        <span class="option_value">教保人員</span>
    </label>
    <label class="separate_option">
        <span class="option_position">
            @if($TeacherData["Separate"] == "special_education")
            <input class="option_circle" type="radio" name="separate" value="special_education" checked>
            @else
            <input class="option_circle" type="radio" name="separate" value="special_education">
            @endif
        </span>
        <span class="option_value">特教行政人員</span>
    </label>
</div>