<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-紀錄查詢與報表</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <!--<link href="../newframework/img/favicon.ico" rel="icon">-->

    <!-- Google Web Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="../newframework/font-awesome/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../newframework/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../newframework/css/woodstyle.css" rel="stylesheet">
    <link href="../newframework/css/caferesponsive.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">
    <!-- nav need -->
    <link href="../newframework/css/exception-nav.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../newframework/css/Result/QRUnify_page.css" />
    <link href="../js/gijgo/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.5.0.min.js"></script>
    <script src="../js/gijgo/js/gijgo.min.js" type="text/javascript"></script>

    <script src="../newframework/js/Result/QRUnifyPage.js"></script>

</head>

<body>
    @include('newframework.layouts.universal.nav')
    <div class="container">
        <!--查詢欄位-->
        <div></div>
        <!--列表 Table-->
        <div class="table-out-framework">
            <table class="option-table">
                <thead>
                    <tr class="table-head">
                        <th>入學年度</th>
                        <th>班級</th>
                        <th>座號</th>
                        <th>姓名</th>
                        <th class="question-space">問卷名稱</th>
                        <th class="arrow-space"></th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < count($FillData); $i++)
                    <tr class="table-body default">
                        <td>{{ $FillData[$i]["Year"] }}-{{ $FillData[$i]["Semester"] }}</td>
                        <td>{{ $FillData[$i]["ClassName"] }}</td>
                        <td>{{ $FillData[$i]["StudentCode"] }}</td>
                        <td>{{ $FillData[$i]["StudentName"] }}</td>
                        <td type="submit">{{ $FillData[$i]["QuestionName"] }}</td>
                        <td class="arrow-space"><span class="arrow">arrow</span></td>
                    </tr>
                    <tr class="sub-table-body">
                        <td colspan="7">
                            <div class="sub-table-wrap">
                        @for($j = 0; $j < count($FillData[$i]["FillContent"]); $j++)
                            @php
                                $FillContent = $FillData[$i]["FillContent"][$j];
                            @endphp
                            @if($FillContent["Finish"]=="1" )
                                    @for($DataTime = 1 ; $DataTime <=intval($FillContent["FillTime"]); $DataTime++) 
                                    <div class="full-sub-table">
                                        <span>{{ $FillContent["SchoolYear"] }}-{{ $FillContent["Semester"] }}：{{ $FillContent["FillDate"][$DataTime-1] }}</span>
                                        <form action="{{ route('questionnaire.history.Receive') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="questionhistorydata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillContent['SchoolYear'] }}-{{ $FillContent['Semester'] }}-{{ $DataTime }}">
                                            <button type="submit">第 {{ $DataTime }} 次填寫紀錄</button>
                                        </form>
                                        <form action="{{ route('questionnaire.result.show') }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="resultdata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillContent['SchoolYear'] }}-{{ $FillContent['Semester'] }}-{{ $DataTime }}">
                                            <button type="submit">問卷結果</button>
                                        </form>
                                    </div>
                                    @endfor
                            @elseif($FillContent["Finish"] == "0" && (intval($FillContent["FillTime"]) > 1) )
                                    @for($DataTime = 1 ; $DataTime < intval($FillContent["FillTime"]); $DataTime++) 
                                            <div class="full-sub-table">
                                                <span>{{ $FillContent["SchoolYear"] }}-{{ $FillContent["Semester"] }}：{{ $FillContent["FillDate"][$DataTime-1] }}</span>
                                                <form action="{{ route('questionnaire.history.Receive') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="questionhistorydata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillContent['SchoolYear'] }}-{{ $FillContent['Semester'] }}-{{ $DataTime }}">
                                                    <button type="submit">第 {{ $DataTime }} 次填寫紀錄</button>
                                                </form>
                                                <form action="{{ route('questionnaire.result.show') }}" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="resultdata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillContent['SchoolYear'] }}-{{ $FillContent['Semester'] }}-{{ $DataTime }}">
                                                    <button type="submit">問卷結果</button>
                                                </form>
                                            </div>
                                            @endfor
                                    @endif
                        @endfor
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            <div class="pre-page">
                <button type="button" class="pre-button" onclick="history.back()"><span>回上頁</span></button>
            </div>
        </div>
    </div>
</body>

</html>