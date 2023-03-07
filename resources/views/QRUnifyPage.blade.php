<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-紀錄查詢與報表</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">

    <script src="../js/jquery-3.5.0.min.js"></script>
    <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/QRUnifyPage.js"></script>
    <script src="../js/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/header.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/QRUnify_page.css" />
</head>

<body>
@include('layouts.header')
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
                            <th>填寫學年：學期</th>
                            <th>問卷名稱：填寫總次數</th>
                            <th class="arrow-space"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < count($FillData); $i++) 
                        @if($FillData[$i]["Finish"]=="1" ) 
                        <tr class="table-body default">
                            <td>{{ $FillData[$i]["Year"] }}</td>
                            <td>{{ $FillData[$i]["ClassName"] }}</td>
                            <td>{{ $FillData[$i]["StudentCode"] }}</td>
                            <td>{{ $FillData[$i]["StudentName"] }}</td>
                            <td>{{ $FillData[$i]["SchoolYear"] }}年-{{ $FillData[$i]["CurrentSemester"] }}</td>
                            <td type="submit">{{ $FillData[$i]["QuestionName"] }}：{{ $FillData[$i]["FillTime"] }}</td>
                            <td class="arrow-space"><span class="arrow">arrow</span></td>
                        </tr>
                        <tr class="sub-table-body">
                            <td colspan="7">
                            <div class="sub-table-wrap">
                            @for($j=1 ; $j <=intval($FillData[$i]["FillTime"]); $j++) 
                                <div class="full-sub-table">
                                <form action="{{ route('questionnaire.history.Receive') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="questionhistorydata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillData[$i]['SchoolYear'] }}-{{ $FillData[$i]['CurrentSemester'] }}-{{ $j }}">
                                    <span>{{ $FillData[$i]["QuestionName"] }}：</span>
                                    <button type="submit">第 {{ $j }} 次填寫紀錄</button>
                                </form>
                                <form action="{{ route('questionnaire.result.show') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="resultdata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillData[$i]['SchoolYear'] }}-{{ $FillData[$i]['CurrentSemester'] }}-{{ $j }}">
                                    <button type="submit">問卷結果</button>
                                </form>
                                </div>
                                @endfor
                            </div>
                            </td>
                        </tr>
                        @elseif($FillData[$i]["Finish"] == "0" && (intval($FillData[$i]["FillTime"]) > 1) )
                        <tr class="table-body default">
                            <td>{{ $FillData[$i]["Year"] }}</td>
                            <td>{{ $FillData[$i]["ClassName"] }}</td>
                            <td>{{ $FillData[$i]["StudentCode"] }}</td>
                            <td>{{ $FillData[$i]["StudentName"] }}</td>
                            <td>{{ $FillData[$i]["SchoolYear"] }}年-{{ $FillData[$i]["CurrentSemester"] }}</td>
                            <td type="submit">{{ $FillData[$i]["QuestionName"] }}：{{ $FillData[$i]["FillTime"]-1 }}</td>
                            <td class="arrow-space"><span class="arrow">arrow</span></td>
                        </tr>
                        <tr class="sub-table-body">
                            <td colspan="7">
                            <div class="sub-table-wrap">
                            @for($j=1 ; $j < intval($FillData[$i]["FillTime"]); $j++) 
                                <div class="full-sub-table">
                                <form action="{{ route('questionnaire.history.Receive') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="questionhistorydata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillData[$i]['SchoolYear'] }}-{{ $FillData[$i]['CurrentSemester'] }}-{{ $j }}">
                                    <span>{{ $FillData[$i]["QuestionName"] }}：</span>
                                    <button type="submit">第 {{ $j }} 次填寫紀錄</button>
                                </form>
                                <form action="{{ route('questionnaire.result.show') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="resultdata" value="{{ $FillData[$i]['StudentID'] }}-{{ $FillData[$i]['QuestionCode'] }}-{{ $FillData[$i]['SchoolYear'] }}-{{ $FillData[$i]['CurrentSemester'] }}-{{ $j }}">
                                    <button type="submit">問卷結果</button>
                                </form>
                                </div>
                            @endfor
                            </div>
                            </td>
                        </tr>
                        @endif
                    @endfor
                    </tbody>
                </table>
                <div class="pre-page">
                    <button type="button" class="pre-button" onclick="history.back()"><span>回上頁</span></button>
                </div>
            </div>
        </div>

    </div>
    </div>
</body>

</html>