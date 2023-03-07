<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>首頁</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <script src="../js/jquery-3.5.0.min.js"></script>
    <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/first_page.js"></script>
    <link href="../css/first_page_layout.css" rel="stylesheet">
    <link href="../css/header.css" rel="stylesheet">
</head>

<body>
@include('layouts.header')
    <div class="content_body justify-content-center">
        @auth
        @if( $Fillflag == -1)
        <script type="text/javascript">
            $(function() {
                fillteacher();
            });
        </script>
        <!--教師基本資料Modal-->
        <div id="teachercard" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>教師基本資料</div>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('child.history.information.show') }}" method="GET" id="ChooseHistory">
                            @csrf
                            <div class="">
                                <div class="option_title">姓名：</div>
                                <div class="input_style">
                                    <input name="TeacherName" id="TeacherName" class="" type="text" value="">
                                </div>
                                <div class="option_title">帳號：</div>
                                <div class="input_style">
                                    <input name="Account" id="Account" class="" type="text" readonly="readonly" value="{{ $account }}">
                                </div>
                                <div class="option_title">學校：</div>
                                <div class="input_style">
                                    <input name="SchoolName" id="SchoolName" class="" type="text" readonly="readonly" value="">
                                </div>
                            </div>
                            <div>
                                <div class="option_title">身分別：</div>
                                <div class="option_content">
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
                            <div>
                                <div class="option_title">於幼兒園服務的經驗：</div>
                                <div class="option_content">
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
                            <div>
                                <div class="option_title">教師輔導特殊生經驗：</div>
                                <div class="option_content">
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
                            <div>
                                <div class="option_title">接觸作息本位經驗：</div>
                                <div class="option_content">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="content_size">
            <div class="content_title">幼兒問卷</div>
            <div class="separate_line"></div>
            <div class="content_text">
                <ul>
                    <li class="text_rows">
                        <div class="text_style" onclick="fillstatus()">幼兒資訊</div>
                    </li>
                    @for( $i = 0;$i < count($Questionnaire) ;$i++ ) <li class="text_rows">
                        <div class="text_style" onclick="fillnumber({{$Questionnaire[$i]->QuestionCode}})">
                            {{ $Questionnaire[$i]->QuestionName }}
                        </div>
                        </li>
                        @endfor
                        <!--幼兒資料Modal-->
                        <div id="statuscard" class="modal fade">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div>ClaMEISER-幼兒狀態</div>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('child.infromation.show') }}" method="GET" id="ChooseStatus">
                                            @csrf
                                            <div class="student_framework">
                                                <label class="student_option">
                                                    <span class="option_position">
                                                        <input class="student_circle" type="radio" name="childstatus" value="confirm">
                                                    </span>
                                                    <div class="option_content">
                                                        <span class="option_value">特殊生</span>
                                                    </div>
                                                </label>
                                                <label class="student_option">
                                                    <span class="option_position">
                                                        <input class="student_circle" type="radio" name="childstatus" value="suspected">
                                                    </span>
                                                    <div class="option_content">
                                                        <span class="option_value">疑似生</span>
                                                    </div>
                                                </label>
                                                <label class="student_option">
                                                    <span class="option_position">
                                                        <input class="student_circle" type="radio" name="childstatus" value="none">
                                                    </span>
                                                    <div class="option_content">
                                                        <span class="option_value">無症狀</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="next-page">
                                                <button type="button" class="btn btn-secondary" onclick="checkstatussend()">確定</button>
                                                <div id="fill_alart" class="fill-alart"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--問卷Modal-->
                        @if($flag == 0)
                        @for( $i = 0;$i < count($Questionnaire) ;$i++ ) <div id="childcard{{$Questionnaire[$i]->QuestionCode}}" class="modal fade">
                            <div class="modal-dialog modal-dialog-centered modal" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div>ClaMEISER-幼兒資料</div>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            尚未填寫任何學生資料，請問是否立刻填寫?
                                        </div>
                                        <button id="fill" class="btn btn-info" onclick="location.href='{{ route('child.infromation.show') }}'">開始填寫</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
            </div>
            @endfor
            @elseif($flag == 1)
            @foreach ($ChildAndFill as $QuestionValue=>$ChildData )
            @php
            $QuestionCode = str_replace('代號','',$QuestionValue);
            @endphp
            <div id="childcard{{$QuestionCode}}" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>ClaMEISER-幼兒資料</div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.ClaMEISER.show') }}" method="GET" id="ChooseChild">
                                <input name="QuestionCode" id="QuestionCode" type="hidden" value="">
                                @foreach ( $ChildData as $cdata=>$cdata_class)
                                <div class="yearframwork">
                                    <div class="yearcontent">{{ $cdata }}</div>
                                    @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                    <div class="classcontent">{{ $cdata_title }}</div>
                                    <div class="student_framework">
                                        @for( $i = 0 ;$i < count($cdata_value) ; $i++ ) <label class="student_option">
                                            <span class="option_position">
                                                <input class="student_circle" type="radio" name="child" value="{{ $cdata_value[$i]['ChildValue'] }}">
                                            </span>
                                            <div class="option_content">
                                                <span class="option_value">姓名：{{ $cdata_value[$i]['ChildName'] }}</span>
                                                <span class="option_value">座號：{{ $cdata_value[$i]['ChildNumber'] }}</span>
                                                <span class="option_value">填寫：{{ $cdata_value[$i]['FillStatus'] }}</span>
                                            </div>
                                            </label>
                                            @endfor
                                    </div>

                                    @endforeach
                                </div>
                                @endforeach

                                <div class="next-page">
                                    <button type="button" class="btn btn-secondary" onclick="checkchildsend()">確定</button>
                                    <div id="fill_alart" class="fill-alart"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            </ul>
        </div>
        <div class="content_size">
        <div class="content_title">已完成</div>
        <div class="separate_line"></div>
        <div class="content_text">
            <ul>
                <li class="text_rows">
                    <div class="text_style" onclick="childhistorycheck()">幼兒資訊</div>
                </li>
                @for( $i = 0;$i < count($Questionnaire) ;$i++ ) <li class="text_rows">
                    <!--<div class="text_style" onclick="()">投入、獨立性及社會關係評估表(3~5歲)</div>-->
                    <div class="text_style" onclick="questionhistorycheck({{$Questionnaire[$i]->QuestionCode}})">
                        {{ $Questionnaire[$i]->QuestionName }}
                    </div>
                    </li>
                    @endfor
            </ul>
            <!--幼兒歷史紀錄Modal-->
            <div id="childhistorycard" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>ClaMEISER-幼兒資料</div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @if($flag == 0)
                            <div>
                                尚未填寫任何學生資料，請問是否立刻填寫?
                            </div>
                            <button id="fill" class="btn btn-info" onclick="location.href='{{ route('child.infromation.show') }}'">開始填寫</button>
                            @elseif($flag == 1)
                            <form action="{{ route('child.history.information.show') }}" method="GET" id="ChooseHistory">
                                @csrf
                                @foreach ( $ChildData as $cdata=>$cdata_class)
                                <div class="yearframwork">
                                    <div class="yearcontent">{{ $cdata }}</div>
                                    @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                    <div class="classcontent">{{ $cdata_title }}</div>
                                    <div class="student_framework">
                                        @for( $i = 0 ;$i < count($cdata_value) ; $i++ ) <label class="student_option">
                                            <span class="option_position">
                                                <input class="student_circle" type="radio" name="historychild" value="{{ $cdata_value[$i]['ChildValue'] }}">
                                            </span>
                                            <div class="option_content">
                                                <span class="option_value">姓名：{{ $cdata_value[$i]['ChildName'] }}</span>
                                                <span class="option_value">座號：{{ $cdata_value[$i]['ChildNumber'] }}</span>
                                            </div>
                                            </label>
                                            @endfor
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                <div class="next-page">
                                    <button type="button" class="btn btn-secondary" onclick="checkhistorysend()">確定</button>
                                    <div id="fill_alart" class="fill-alart"></div>
                                </div>
                            </form>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--問卷歷史紀錄Modal-->
            <div id="questionhistorycard" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>ClaMEISER-幼兒資料</div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @if($flag == 0)
                            <div>
                                尚未填寫任何學生資料，請問是否立刻填寫?
                            </div>
                            <button id="fill" class="btn btn-info" onclick="location.href='{{ route('child.infromation.show') }}'">開始填寫</button>
                            @elseif($flag == 1)
                            <form action="{{ route('user.ClaMEISER.show') }}" method="GET" id="ChooseQuestionHistory">
                                @csrf
                                <input name="QuestionCode" id="HistoryQuestionCode" type="hidden" value="">
                                @foreach ( $ChildData as $cdata=>$cdata_class)
                                <div class="yearframwork">
                                    <div class="yearcontent">{{ $cdata }}</div>
                                    @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                    <div class="classcontent">{{ $cdata_title }}</div>
                                    <div class="student_framework">
                                        @for( $i = 0 ;$i < count($cdata_value) ; $i++ ) <label class="student_option">
                                            <span class="option_position">
                                                <input class="student_circle" type="radio" name="historychild" value="{{ $cdata_value[$i]['ChildValue'] }}">
                                            </span>
                                            <div class="option_content">
                                                <span class="option_value">姓名：{{ $cdata_value[$i]['ChildName'] }}</span>
                                                <span class="option_value">座號：{{ $cdata_value[$i]['ChildNumber'] }}</span>
                                            </div>
                                            </label>
                                            @endfor
                                    </div>

                                    @endforeach
                                </div>
                                @endforeach
                                <div class="next-page">
                                    <button type="button" class="btn btn-secondary" onclick="checkquestionhistorysend()">確定</button>
                                    <div id="fill_alart" class="fill-alart"></div>
                                </div>
                            </form>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endif

    @endauth
    @guest
    <div>
        尚未登入
    </div>
    @endguest
</body>

</html>