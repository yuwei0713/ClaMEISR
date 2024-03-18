<!--教師基本資料Modal-->
@if( $Fillflag == -1)
<div id="teachercard" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>教師基本資料</div>
                <button type="button" class="btn-close" href='{{ route('logout.perform') }}' data-dismiss="modal">登出</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.teacherdata.Receive') }}" method="POST" id="TeacherBasicData">
                    @csrf
                    <div class="SchoolBasicFramework">
                        <div class="SchoolBasicInnerFramework">
                            <label class="Basic_option">
                                <div class="option_title"><span style="color:red">*</span>姓名：</div>
                                <div class="input_style">
                                    <input name="TeacherName" id="TeacherName" class="text_style" type="text" value="">
                                    <div id="name_fill_alart" class="fill-alart"></div>
                                </div>
                            </label>
                            <label class="Basic_option">
                                <div class="option_title"><span style="color:red">*</span>帳號：</div>
                                <div class="input_style">
                                    <input name="Account" id="Account" class="text_style" type="text" readonly="readonly" value="{{ $account }}">
                                </div>
                            </label>
                            <label class="Basic_option">
                                <div class="option_title"><span style="color:red">*</span>學校：</div>
                                <div class="input_style">
                                    <input name="SchoolName" id="SchoolName" class="text_style" type="text" readonly="readonly" value="{{ $SchoolName }}">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="SchoolBasicFramework">
                        <div class="option_title"><span style="color:red">*</span>身分別：</div>
                        <div class="teacher_option_content">
                            <label class="separate_option">
                                <span class="option_position">
                                    <input class="option_circle" type="radio" name="separate" value="teacher">
                                </span>
                                <span class="option_value">幼教師</span>
                            </label>
                            <label class="separate_option">
                                <span class="option_position">
                                    <input class="option_circle" type="radio" name="separate" value="education_staff">
                                </span>
                                <span class="option_value">教保人員</span>
                            </label>
                            <label class="separate_option">
                                <span class="option_position">
                                    <input class="option_circle" type="radio" name="separate" value="special_education">
                                </span>
                                <span class="option_value">特教行政人員</span>
                            </label>
                        </div>
                    </div>
                    <div class="SchoolBasicFramework">
                        <div class="option_title"><span style="color:red">*</span>於幼兒園服務的經驗：</div>
                        <div class="teacher_option_content">
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
                                    <input class="option_circle" type="radio" name="kindergarten" value="10年以上">
                                </span>
                                <span class="option_value">10年以上</span>
                            </label>
                        </div>
                    </div>
                    <div class="SchoolBasicFramework">
                        <div class="option_title"><span style="color:red">*</span>教師輔導特殊生經驗：</div>
                        <div class="teacher_option_content">
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
                                    <input class="option_circle" type="radio" name="counseling" value="6年以上">
                                </span>
                                <span class="option_value">6年以上</span>
                            </label>
                        </div>
                    </div>
                    <div class="SchoolBasicFramework">
                        <div class="option_title"><span style="color:red">*</span>接觸作息本位經驗：</div>
                        <div class="teacher_option_content">
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
                                    <input class="option_circle" type="radio" name="routinesbased" value="4年以上">
                                </span>
                                <span class="option_value">4年以上</span>
                            </label>
                        </div>
                    </div>
                    <div class="next-page">
                        <button type="button" class="btn btn-secondary" id="checkteacherdatasend">確定</button>
                        <div id="teacher_fill_alart" class="fill-alart"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../newframework/js/teachercard/firstfill.js"></script>
@else
<div id="historyteachercard" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>教師基本資料</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.teacherdata.Receive') }}" method="POST" id="TeacherHistoryData">
                    @csrf
                    <div class="SchoolBasicFramework">
                        <div class="SchoolBasicInnerFramework">
                            <label class="Basic_option">
                                <div class="option_title">
                                    <span class="need">*</span>姓名：
                                </div>
                                <div class="input_style">
                                    <input name="TeacherName" id="TeacherName" class="text_style" type="text" value="{{ $TeacherData["TeacherName"] }}" maxlength="10">
                                    <div id="name_fill_alart" class="fill-alart"></div>
                                </div>
                            </label>
                            <label class="Basic_option">
                                <div class="option_title">
                                    <span class="need">*</span>帳號：
                                </div>
                                <div class="input_style">
                                    <input name="Account" id="Account" class="text_style" type="text" readonly="readonly" value="{{ $TeacherData["Username"] }}">
                                </div>
                            </label>
                            <label class="Basic_option">
                                <div class="option_title">
                                    <span class="need">*</span>學校：
                                </div>
                                <div class="input_style">
                                    <input name="SchoolName" id="SchoolName" class="text_style" type="text" readonly="readonly" value="{{  $TeacherData["SchoolName"] }}">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="SchoolBasicFramework">
                        @include('firstpage.Separate')
                    </div>
                    <div class="SchoolBasicFramework">
                        @include('firstpage.Kindergarten')
                    </div>
                    <div class="SchoolBasicFramework">
                        @include('firstpage.Counseling')
                    </div>
                    <div class="SchoolBasicFramework">
                        @include('firstpage.RoutinesBased')
                    </div>
                    <div class="next-page">
                        <button type="button" class="btn btn-secondary" id="checkhistoryteacherdatasend">修改</button>
                        <div id="teacher_fill_alart" class="fill-alart"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif