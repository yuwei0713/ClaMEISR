<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISR-首頁</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <script src="../js/jquery-3.5.0.min.js"></script>
    <script src="../js/first_page.js"></script>
    <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/slick-1.8.1/slick/slick.css" rel="stylesheet" type="text/css"></link>
    <link href="../css/slick-1.8.1/slick/slick-theme.css" rel="stylesheet" type="text/css"></link>
    <script src="../js/slick-1.8.1/slick/slick.min.js"></script>
    <script src="../js/banner.js"></script>
    
    <link href="../css/first_page_layout.css" rel="stylesheet">
    <link href="../css/header.css" rel="stylesheet">
    <script src="../js/search.js"></script>
</head>

<body>
    @include('layouts.session-message')
    @include('layouts.header')
    <div class="wrapper">
        <!--左-->
        <div class="left-wrapper">
            <!--敘述-->
            <div class="narrative">
                <!--Title-->
                <div>
                    <span class="Title">
                        <strong>
                            課堂投入、獨立性及社會關係之評量表 (ClaMEISR)
                        </strong>
                    </span>
                    <br>
                    <span class="full-name">
                        Classroom Measure of Engagement, Independence, and Social Relationships
                    </span>
                </div>
                <!--Content-->
                @auth
                <div class="Content">
                    <span>&emsp;&emsp;課堂投入量表項目內容涵蓋幼兒在幼兒園的13類作息／236投入子項目，觀察人員以李克特三點量表進行計分(1=尚未、2=有時、3=經常/更多)進行觀察紀錄。完成全量表觀察後可統計分析個別幼兒在每一類作息以及總量表之精熟 (即評為3分)項目之百分比。</span>
                </div>
                @endauth
                @guest
                <div class="Content">
                    <span>&emsp;&emsp;數位優化的課堂投入量表輔助第一線教育工作者有效能的觀察、記錄幼兒在真實生活作息中的參與，並能統計分析產生可供聯合諮詢參考的實證資料，讓家庭、照顧者或專業團隊了解日常生活中幼兒的發展及參與成效，並訂定適合特殊需要幼兒個別化的服務計畫(IEP)。</span>
                </div>
                @endguest
            </div>
            <!--常用功能-->
            <div class="common-functions">
            @auth
                <ul class="functions-framework">
                    <li>
                        <div class="text_style" onclick="fillstatus()">
                            <span>
                                <img class="common-functions-image" src="../image/person-add.svg">
                                兒童資料新增
                            </span>
                    </div>
                    </li>
                    <li>
                        <div class="text_style" onclick="fillnumber({{$Questionnaire[0]->QuestionCode}})">
                            <span>
                                <img class="common-functions-image" src="../image/pencil-square.svg">
                                {{ $Questionnaire[0]->QuestionName }}
                            </span>
                        </div>
                    </li>
                </ul>
            @endauth
            </div>
        </div>
        <!--右-->
        <div class="center-frame">
            <div class="center">
                <div class="banner">
                    <div>
                        <img src="../image/houli.png">
                    </div>
                    <div>
                        <img src="../image/shizi.jpg">
                    </div>
                    <div>
                        <img src="../image/tanxiu.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content_body justify-content-center">
        <!--首頁 左敘述 右圖片-->
        
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
                        <button type="button" class="close" onclick="location.href='{{ route('logout.perform') }}'" data-dismiss="modal">登出</button>
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
                                <button type="button" class="btn btn-secondary" onclick="checkteacherdatasend()">確定</button>
                                <div id="teacher_fill_alart" class="fill-alart"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="content_size">
            <!--icon-->
            <div class="icon-framework">
                <img class="icon-style" src="../image/childfile.png">
            </div>
            <div class="content-introduction-framework">
                <div class="content-title">兒童檔案</div>
                <div class="content-introduction">&emsp;&emsp;填寫或修改兒童基本資料</div>
            </div>
            <div class="content_text">
                <ul>
                    <li class="text_rows">
                        <div class="text_style" onclick="fillstatus()">兒童資料新增</div>
                    </li>
                    <li class="text_rows">
                        <div class="text_style" onclick="childhistorycheck()">兒童資料查看</div>
                    </li>
                </ul>
            </div>
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
                                                <span class="option_value">一般生</span>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <button id="fill" class="btn btn-info" onclick="jumptostatussend('childhistorycard')">開始填寫</button>
                                @elseif($flag == 1)
                                <!-- 搜尋欄位-->
                                <div class="search" id="childsearch">
                                    <div class="multiSelect">
                                        <span class="selectTitle">入學年度</span>
                                        <div class="selectContent">
                                            <div class="selectBtn" data-title="全部" id="searchyear"></div>
                                            <div class="optionGroup">
                                                @foreach ( $ChildData as $cdata=>$cdata_class)
                                                    @if (!empty($cdata_class))
                                                    @php
                                                    $searchyear = str_replace('年度','',$cdata);
                                                    @endphp
                                                    <label><input type="checkbox" name="year[]" value="{{ $searchyear }}">{{ $cdata }}</label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="multiSelect">
                                        <span class="selectTitle">班級</span>
                                        <div class="selectContent">
                                            <div class="selectBtn" data-title="全部" id="searchyear"></div>
                                            <div class="optionGroup">
                                            @foreach ( $ChildData as $cdata=>$cdata_class)
                                                @if (!empty($cdata_class))
                                                    @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                                        <label>
                                                            <input type="checkbox" name="class[]" value="{{ $cdata_title }}">{{ $cdata_title }}
                                                        </label>
                                                    @endforeach
                                                    @break
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="multiSelect searchBox-framework">
                                        <img src="../image/searchicon.png" width="16" height="16">
                                        <input type="search" id="search-input" class="light-table-filter searchBox" data-table="order-table" placeholder="輸入座號或姓名">
                                    </div>
                                    <style id="m-search"></style>
                                    <script>
                                        
                                    </script>
                                </div>
                                <!-- 搜尋欄位 end-->
                                <form action="{{ route('child.history.information.show') }}" method="GET" id="ChooseHistory">
                                    @csrf
                                    @foreach ( $ChildData as $cdata=>$cdata_class)
                                    @if (!empty($cdata_class))
                                    @php
                                    $searchyear = str_replace('年度','',$cdata);
                                    @endphp
                                    <div class="yearframwork" id="search-{{ $searchyear }}">
                                        <div class="yearcontent">{{ $cdata }}</div>
                                        @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                        <div id="search-{{ $cdata_title }}">
                                            <div class="classcontent">{{ $cdata_title }}</div>
                                            <div class="student_framework">
                                            @for( $i = 0 ;$i < count($cdata_value) ; $i++ )
                                            <label class="student_option wrap" data-index="{{ $cdata_value[$i]['ChildName'] }}-{{ $cdata_value[$i]['ChildNumber'] }}">
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
                                        </div>
                                        @endforeach
                                    </div>                                    
                                    @endif
                                    @endforeach
                                    <div class="next-page">
                                        <button type="button" class="btn btn-secondary" onclick="checkhistorysend()">確定</button>
                                        <div id="fill_alart" class="fill-alart"></div>
                                    </div>
                                </form>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="content_size">
            <div class="icon-framework">
                <img class="icon-style" src="../image/questionnaire.png">
            </div>
            <div class="content-introduction-framework">
                <div class="content-title">兒童問卷</div>
                <div class="content-introduction">&emsp;&emsp;問卷填寫</div>
            </div>
            <div class="content_text">
                <ul>
                    @for( $i = 0;$i < count($Questionnaire) ;$i++ ) <li class="text_rows">
                        <div class="text_style" onclick="fillnumber({{$Questionnaire[$i]->QuestionCode}})">
                            {{ $Questionnaire[$i]->QuestionName }}
                        </div>
                        </li>
                    @endfor
                </ul>
            </div>
            @if($flag == 0)
                        @for( $i = 0;$i < count($Questionnaire) ;$i++ ) 
                        <!--問卷Modal-->
                            <div id="childcard{{$Questionnaire[$i]->QuestionCode}}" class="modal fade">
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
                                            <button id="fill" class="btn btn-info" onclick="jumptostatussend('childcard{{$Questionnaire[$i]->QuestionCode}}')">開始填寫</button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
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
                                
                                            <form action="{{ route('user.ClaMEISER.show') }}" method="GET" id="ChooseChild{{$QuestionCode}}">
                                                @csrf
                                                <input name="QuestionCode" id="QuestionCode" type="hidden" value="{{$QuestionCode}}">
                                                @foreach ( $ChildData as $cdata=>$cdata_class)
                                                @if (!empty($cdata_class))
                                                @php
                                                $searchyear = str_replace('年度','',$cdata);
                                                @endphp
                                                <div class="yearframwork" name="qsearch-{{$searchyear}}">
                                                    <div class="yearcontent">{{ $cdata }}</div>
                                                    @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                                    <div name="qsearch-{{ $cdata_title }}">
                                                    <div class="classcontent">{{ $cdata_title }}</div>
                                                    <div class="student_framework">
                                                        @for( $i = 0 ;$i < count($cdata_value) ; $i++ ) 
                                                        <label class="student_option qwrap" data-qindex="{{ $cdata_value[$i]['ChildName'] }}-{{ $cdata_value[$i]['ChildNumber'] }}">
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
                                                </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                                @endforeach

                                                <div class="next-page">
                                                    <button type="button" class="btn btn-secondary" onclick="checkchildsend({{$QuestionCode}})">確定</button>
                                                    <div id="checkchild_fill_alart" class="fill-alart"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
        </div>
        <div class="content_size">
            <div class="icon-framework">
                <img class="icon-style" src="../image/search.png">
            </div>
            <div class="content-introduction-framework">
                <div class="content-title">紀錄查詢與報表</div>
                <div class="content-introduction">&emsp;&emsp;查看問卷填寫的紀錄以及問卷結果</div>
            </div>
            <div class="content_text">
                <ul>
                    @if($flag == 0)
                    <li class="text_rows">
                        <div class="text_style" onclick="questionresultunify()">問卷與結果查詢</div>
                    </li>
                    @else
                    <li class="text_rows">
                        <div class="text_style" onclick="location.href='{{ route('cla.unify.show') }}'">問卷與結果查詢</div>
                    </li>
                    @endif
                </ul>
            </div>
            @if($flag == 0)
                <div id="QandRUnify" class="modal fade">
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
                                <button id="fill" class="btn btn-info" onclick="jumptostatussend('QandRUnify')">開始填寫</button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
        </div>
        <div class="content_size">
            <div class="icon-framework">
                <img class="icon-style" src="../image/teacherfile.png">
            </div>
            <div class="content-introduction-framework">
                <div class="content-title">個人資料</div>
                <div class="content-introduction">&emsp;&emsp;修改教師基本資料以及教學手冊的下載</div>
            </div>
            <div class="content_text">
                <ul>
                    <li class="text_rows">
                        <div class="text_style" onclick="historyteacher()">教師基本資料</div>
                    </li>
                    <li class="text_rows">
                            <a class="text_style downloadfile" href="../file/ClaMEISR-manual.pdf" download="教學手冊.pdf">教學手冊下載(PDF檔)</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--教師歷史資料Modal-->
        <div id="historyteachercard" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>教師基本資料</div>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.teacherdata.Receive') }}" method="POST" id="TeacherHistoryData">
                                    @csrf
                                    <div class="SchoolBasicFramework">
                                        <div class="SchoolBasicInnerFramework">
                                            <label class="Basic_option">
                                                <div class="option_title">
                                                <span style="color:red">*</span>姓名：</div>
                                                <div class="input_style">
                                                    <input name="TeacherName" id="TeacherName" class="text_style" type="text" value="{{ $TeacherData["TeacherName"] }}" maxlength="10">
                                                    <div id="name_fill_alart" class="fill-alart"></div>
                                                </div>
                                            </label>
                                            <label class="Basic_option">
                                                <div class="option_title">
                                                <span style="color:red">*</span>帳號：</div>
                                                <div class="input_style">
                                                    <input name="Account" id="Account" class="text_style" type="text" readonly="readonly" value="{{ $TeacherData["Username"] }}">
                                                </div>
                                            </label>
                                            <label class="Basic_option">
                                                <div class="option_title">
                                                <span style="color:red">*</span>學校：</div>
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
                                        <button type="button" class="btn btn-secondary" onclick="checkhistoryteacherdatasend()">修改</button>
                                        <div id="teacher_fill_alart" class="fill-alart"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
    </div>
    <script>
        window.onload = function() {
            initsearch();
            inputsearch();
        }
    </script>
    @endauth
    @guest
    <div>
        尚未登入
    </div>
    @endguest
</body>

</html>