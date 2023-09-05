<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-問卷填寫</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html;charset=UTF-8 width=device-width,initial-scale=1">


    <!-- Favicon -->
    <link href="../newframework/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="../newframework/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../newframework/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../newframework/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../newframework/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <!-- <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <link href="../newframework/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../newframework/css/woodstyle.css" rel="stylesheet">
    <link href="../newframework/css/caferesponsive.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">
    <!-- nav need -->
    <link href="../newframework/css/exception-nav.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">

    <link href="../newframework/css/questionnaire/ClaMEISER_History.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../newframework/css/questionnaire/layout.css" />
    <script src="../js/jquery-3.5.0.min.js"></script>
</head>

<body>
    @include('layouts.session-message')
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <div class="container-fluid position-relative p-0">
        <!-- Navbar Start -->
        @include('newframework.layouts.universal.nav')
        <!-- Navbar End -->
    </div>

    <div>
        <div id="actualpage" class="actualpage">
            <div class="choosetopic container">
                <div class="choosetopic-title-framework flip">
                    <div class="main-white-button">
                        <div>
                            <i class="fa fa-eye"></i>
                            <span class="choosetopic-title">作息表</span>
                            <span class="arrow">arrow</span>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    @for ($i = 0; $i < count($HistoryData); $i++) <label class="chooseframeworklabel" for="span{{ $HistoryData[$i]['BigTopicNumber'] }}" id="label{{ $HistoryData[$i]['BigTopicNumber'] }}">
                        <div class="chooseframework" onclick="changeshow({{ $HistoryData[$i]['BigTopicNumber'] }})">
                            <span id="span{{ $HistoryData[$i]['BigTopicNumber'] }}">{{ $HistoryData[$i]['BigTopicName'] }}</span>
                        </div>
                        </label>
                    @endfor
                </div>
            </div>
        </div>
        <input type="hidden" id="currenttalbe" value="">
        <div class="store-framework">
            <button type="button" class="next-button" onclick="checkoutput(0)"><span>儲存</span></button>
            <button type="button" class="next-button" onclick="movetounfill()"><span>尚未填寫的地方</span></button>
        </div>
        <form action="{{ route('user.Receive') }}" method="POST" id="MeiserForm">
            @csrf
            <input type="hidden" name="QuestionCode" value="{{ $HistoryData[0]['QuestionCode'] }}">
            <input type="hidden" name="StudentID" value="{{ $StudentID }}">
            <input type="hidden" name="ChildAge" value="{{ $ChildAge }}">
            <input type="hidden" name="FillTime" value="{{ $FillData->FillTime }}">
            <input type="hidden" name="FillStatus" value="{{ $FillData->Finish }}">
            <input type="hidden" id="CountOfTopic" name="CountOfTopic" value="{{ count($HistoryData) }}">
            <input type="hidden" id="NextOrFinal" name="NextOrFinal" value="0">
            @for ($i = 0; $i < count($HistoryData); $i++) <div class="main-framwork" id="table{{ $HistoryData[$i]['BigTopicNumber'] }}">
                <!--問答-->
                <div class="question-framwork">
                    <div class="inner-framwork">
                        <div class="theme-framework">
                            <h5 class="theme-css">
                                <div class="theme-flex">
                                    <div>
                                        {{ $HistoryData[$i]['BigTopicName'] }}
                                    </div>
                                </div>
                            </h5>
                            <div class="theme-right">
                                <span>班級：{{ $ChildBasicData->ClassName }}</span>
                                <span>座號：{{ $ChildBasicData->StudentCode }}</span>
                                <span>姓名：{{ $ChildBasicData->StudentName }}</span>
                                <span>年齡：{{ $ChildBasicData->Age }}</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div>
                                    <div class="replenish-framwork">
                                        <ol>
                                            <li><span>Func(功能性領域)： E=投入，I=獨立性，SR=社會關係</span></li>
                                            <li><span>Dev(發展領域)： A=適應性，CG=認知，CM=溝通，M=動作，S=社交</span></li>
                                            <li><span>Out(成效)： 1=正向社會關係，2=獲得和使用知識和技巧，3=採取行動以滿足需求</span></li>
                                        </ol>
                                    </div>
                                    <div class="rTable option-table" id="checktable{{ $HistoryData[$i]['BigTopicNumber'] }}">
                                        @php
                                        $child_flag = 0;
                                        @endphp
                                        <input type="hidden" id="Topic{{ $HistoryData[$i]['BigTopicNumber'] }}" name="Topic{{ $HistoryData[$i]['BigTopicNumber'] }}" value="{{ count($HistoryData[$i]['Detail']) }}">
                                        <div class="rTableRow tablehead">
                                            <div class="rTableCell rTableHead"></div>
                                            <div class="rTableCell rTableHead old-css option-css">年齡</div>
                                            @foreach ($HistoryData[$i]['OptionContent'] as $optioncontent)
                                            <div class="rTableCell rTableHead old-css option-css">
                                                {{ $optioncontent }}
                                            </div>
                                            @endforeach
                                            @foreach ($HistoryData[$i]['AdditionTitle'] as $additiontitle)
                                            <div class="rTableCell rTableHead represent-css option-css">
                                                {{ $additiontitle }}
                                            </div>
                                            @endforeach
                                        </div>
                                        @foreach ($HistoryData[$i]['Detail'] as $detail)
                                        @if ($ChildBasicData->Age >= $detail['SuitableAge'])
                                        <div class="rTableRow topic-rows" id="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}">
                                            @else
                                            @if ($child_flag == 0)
                                            @php
                                            $child_flag = 1;
                                            @endphp
                                            <div class="rTableRow topic-rows not-yet over_age" id="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}">
                                                @elseif($child_flag == 1)
                                                <div class="rTableRow topic-rows over_age" id="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}">
                                                    @endif
                                                    @endif
                                                    <div class="rTableCell">
                                                        <div class="topic-css">{{ $detail['SmTopicContent'] }}</div>
                                                    </div>
                                                    <div class="rTableCell old-css option-css" data-th="年齡:">
                                                        {{ $detail['SuitableAge'] }}
                                                    </div>
                                                    @for ($k = 0; $k < count($detail['OptionValue']); $k++) <label class="rwd-option-framework rTableCell">
                                                        <div class="option-css" data-th="{{ $HistoryData[$i]['OptionContent'][$k] }}">
                                                            <span class="option-size">
                                                                <span class="option-size-adjust">
                                                                    <div class="option-size-inner">
                                                                        @if ($detail['FillTopic'] == $k + 1)
                                                                        <input type="radio" name="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}" value="{{ $k + 1 }}-{{ $detail['OptionValue'][$k] }}" class="option-circle" checked>
                                                                        @else
                                                                        <input type="radio" name="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}" value="{{ $k + 1 }}-{{ $detail['OptionValue'][$k] }}" class="option-circle">
                                                                        @endif
                                                                    </div>
                                                                </span>
                                                            </span>
                                                        </div>
                                                        </label>
                                                        @endfor
                                                        @for ($j = 0; $j < count($detail['AdditionContent']); $j++) <div class="rTableCell represent-css option-css">
                                                            {{ $detail['AdditionContent'][$j] }}
                                                </div>
                                                @endfor
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--各大題分數表-->
                            <div class="questiongrade-framework" id="TableCount{{ $HistoryData[$i]['BigTopicNumber'] }}">
                                <div class="questiongrade-title">
                                    <span>大題分數表</span>
                                </div>
                                <div class="rTable">
                                    <div class="rTableRow">
                                        <div class="rTableCell">
                                            <span>A1. 根據年齡評分為經常或更多的數量：</span>
                                            <span id="countgradeA1-{{ $HistoryData[$i]['BigTopicNumber'] }}">5</span>
                                        </div>
                                        <div class="rTableCell">
                                            <span>A2. 所有評分為經常或更多的數量：</span>
                                            <span id="countgradeA2-{{ $HistoryData[$i]['BigTopicNumber'] }}">6</span>
                                        </div>
                                    </div>
                                    <div class="rTableRow">
                                        <div class="rTableCell">
                                            <span>B1. 根據年齡幼兒被評分的總項目數：</span>
                                            <span id="countgradeB1-{{ $HistoryData[$i]['BigTopicNumber'] }}">7</span>
                                        </div>
                                        <div class="rTableCell">
                                            <span>C1. 所有被評分的總作息數量：</span>
                                            <span id="countgradeC1-{{ $HistoryData[$i]['BigTopicNumber'] }}">8</span>
                                        </div>
                                    </div>
                                    <div class="rTableRow">
                                        <div class="rTableCell">
                                            <span>B2. 根據年齡幼兒精熟項目百分比(A2/B1*100)：</span>
                                            <span id="countgradeB2-{{ $HistoryData[$i]['BigTopicNumber'] }}">9</span>
                                        </div>
                                        <div class="rTableCell">
                                            <span>C2. 幼兒精熟項目百分比(A2/C1*100)：</span>
                                            <span id="countgradeC2-{{ $HistoryData[$i]['BigTopicNumber'] }}">10</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--各大題分數表end-->
                            <div class="send-framwork">
                                @if($i == 0)
                                <div class="pre-page">
                                <button type="button" class="pre-button" onclick="location.href='{{ url('/front') }}'"><span>回首頁</span></button>
                                </div>
                                @else
                                <div class="pre-page">
                                    <button type="button" class="pre-button" onclick="changeshow({{ $HistoryData[$i]['BigTopicNumber'] - 1 }})"><span>上一頁</span></button>
                                </div>
                                @endif
                                @if ($i == count($HistoryData) - 1)
                                <div class="next-page" id="finalpagebutton">
                                    <button type="button" class="next-button" onclick="checkoutput(1)"><span>保存並計算結果</span></button>
                                    <div id="fill_alart" class="fill-alart"></div>
                                </div>
                                @else
                                <div class="next-page" id="finalpagebutton">
                                    <button type="button" class="next-button" onclick="changeshow({{ $HistoryData[$i]['BigTopicNumber'] + 1 }})"><span>下一頁</span></button>
                                </div>
                                @endif
                            </div>
                            <!--進度條-->
                            <div class="css-13z4rfv">
                                <div class="css-1kvwmfc progress-moved">
                                    <progress class="progress-framework" id="progress{{ $HistoryData[$i]['BigTopicNumber'] }}" max="" value=""></progress>
                                    <span class="progress-text" id="progress_text{{ $HistoryData[$i]['BigTopicNumber'] }}"></span>
                                </div>
                            </div>
                            <!--進度條end-->
                        </div>
                    </div>
                </div>
                @endfor
        </form>
    </div>

    <!-- JavaScript Libraries -->
    <script src="../newframework/lib/easing/easing.min.js"></script>
    <script src="../newframework/lib/waypoints/waypoints.min.js"></script>
    <script src="../newframework/lib/counterup/counterup.min.js"></script>
    <script src="../newframework/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../newframework/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../newframework/lib/lightbox/js/lightbox.min.js"></script>
    <script src="../newframework/js/main.js"></script>

    <script src="../js/option_click.js"></script>
    <script src="../js/changeshow.js"></script>
    <script src="../js/progress_value_count.js"></script>
    <script src="../js/movetofill.js"></script>
    <script src="../js/countinggrade.js"></script>
    <script>
        $(function() {
            $(".flip").click(function() {
                $(this).next(".panel").slideToggle(300);
                $(this).toggleClass('active');
            });
        });
    </script>
    <script>
        window.onload = function() {
            movetounfill();
            firstprogressbar();
            firstcountgrade();
        }
    </script>


</body>

</html>