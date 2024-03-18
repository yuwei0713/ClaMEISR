<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-計算結果</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html;charset=UTF-8 width=device-width,initial-scale=1">
    <link href="../newframework/css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery-3.5.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../newframework/css/Result/ResultPage.css" />
    <link rel="stylesheet" type="text/css" href="../newframework/css/Result/Result.css" />

    <!-- Icon Font Stylesheet -->
    <link href="../newframework/font-awesome/css/all.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="../newframework/css/woodstyle.css" rel="stylesheet">
    <link href="../newframework/css/caferesponsive.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">
    <!-- nav need -->
    <link href="../newframework/css/exception-nav.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">
    <script src="../newframework/lib/wow/wow.min.js"></script>
    <script src="../newframework/js/main.js"></script>
    <script src="../newframework/js/Chartjs/dist/chart.umd.js"></script>
</head>

<body>
    @if($errors->any())
    <input type="hidden" id="errormessage" value="{{ $errors->first() }}">
    <script src="../newframework/js/Result/Anyerror.js"></script>
    @endif
    @include('newframework.layouts.universal.nav')
    <div class="container Block">
        <div class="QuestionName">
            <span>{{ $QuestionName}}</span>
        </div>
        <!--學生資訊-->
        <div class="BasicInformation">
            <!--問卷名稱，班級，座號，姓名，填寫次數，填寫日期-->
            <div class="BasicBlock">
                <div class="InformationContent">
                    <div class="BasicContent">
                        <span>班級：</span>
                        <span>{{ $ChildBasic->ClassName}}</span>
                    </div>
                    <div class="BasicContent">
                        <span>座號：</span>
                        <span>{{ $ChildBasic->StudentCode}}</span>
                    </div>
                    <div class="BasicContent">
                        <span>姓名：</span>
                        <span>{{ $ChildBasic->StudentName}}</span>
                    </div>
                </div>
                <div class="QuestionContent">
                    <div class="BasicContent">
                        <span>填寫次數：</span>
                        <span>{{ $FillTime}}</span>
                    </div>
                    <div class="BasicContent">
                        <span>日期：</span>
                        <span>{{ $FillDate}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!--學生資訊end-->
        <!--視覺化圖形-->
        <div>
            <canvas id="myChart" class="vision"></canvas>
        </div>
        <!--視覺化圖形end-->
        <table id="table" class="option-table">
            <thead>
                <tr class="table-primary">
                    <th class="header-class">ClaMEISR 作息類別</th>
                    <th class="header-class">評分為 3 分的題數</th>
                    <th class="header-class">符合年齡的題數</th>
                    <th class="header-class">符合年齡的精熟度 </th>
                    <th class="header-class">填寫總題數</th>
                    <th class="header-class">整體的精熟度</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i < count($TopicName); $i++) <tr>
                    <td>
                        @php
                        $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
                        @endphp {{ $TopicName[$i] }}
                    </td>

                    @if( $gradedata[$i]->ThreePoint == 0 )
                    <td class="Nan_class">
                        <span>N/A</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$i]->ThreePoint }}</span>
                    </td>
                    @endif

                    @if( $gradedata[$i]->FillByAge == 0 )
                    <td class="Nan_class">
                        <span>N/A</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$i]->FillByAge }}</span>
                    </td>
                    @endif

                    @if( $gradedata[$i]->AgeProficientPercent == 0 )
                    <td class="Nan_class">
                        <span>N/A%</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$i]->AgeProficientPercent }}%</span>
                    </td>
                    @endif

                    @if( $gradedata[$i]->FillByAll == 0 )
                    <td class="Nan_class">
                        <span>N/A</span>
                    </td>
                    @else
                    <td>
                        <span>
                            {{ $gradedata[$i]->FillByAll }}
                        </span>
                    </td>
                    @endif

                    @if( $gradedata[$i]->AllProficientPercent == 0 )
                    <td class="Nan_class">
                        <span>N/A%</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$i]->AllProficientPercent }}%</span>
                    </td>
                    @endif
                    </tr>
                    @endfor
                    <tr>
                        <td>
                            <span>
                                @php
                                $TopicName[0] = preg_replace("/\([^)]+\)/", "", $TopicName[0]);
                                @endphp {{ $TopicName[0] }}
                            </span>
                        </td>
                        <td>
                            <span>{{ $gradedata[0]->ThreePoint }}</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[0]->FillByAge }}</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[0]->AgeProficientPercent }}%</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[0]->FillByAll }}</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[0]->AllProficientPercent }}%</span>
                        </td>
                    </tr>
            </tbody>
        </table>
        <div class="result-detail">
            @if( $ifcompare == 1)
            <label class="result-detail-content">
                <form action="{{ route('questionnaire.result.compare.show') }}" method="GET">
                    @csrf
                    <input type="hidden" name="resultdata" value="{{ $CurrentData }}">
                    <button type="submit">歷史紀錄比較</button>
                </form>
            </label>
            @elseif( $ifcompare == 0)
            <label class="result-detail-content">
                <button type="button" id="notcompare">歷史紀錄比較</button>
            </label>
            <script src="../newframework/js/Result/notcompare.js"></script>
            @endif
            <label class="result-detail-content">
                <form action="{{ route('questionnaire.detailresult.show') }}" method="GET">
                    @csrf
                    <input type="hidden" name="resultdata" value="{{ $CurrentData }}">
                    <button type="submit">詳細資訊</button>
                </form>
            </label>
        </div>
        <div class="pre-page">
            @if( $ifdirect == 1 )
            <button type="button" class="pre-button" id="prebutton" data-action="front"><span>回首頁</span></button>
            @elseif( $ifdirect == 0 )
            <button type="button" class="pre-button" id="prebutton" data-action="back"><span>回上頁</span></button>
            @endif
            <script src="../newframework/js/Result/prebutton.js"></script>
        </div>
    </div>
    <div class="dataput">
        <div class="topic">
        @for($i = 1; $i < count($TopicName); $i++)
            @php
                $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
            @endphp
        <input type="hidden" name="topic" value="{{ $TopicName[$i] }}">
        @endfor
        @php
            $TopicName[0] = preg_replace("/\([^)]+\)/", "", $TopicName[0]);
        @endphp
        <input type="hidden" name="topic" value="{{ $TopicName[0] }}">
        </div>
        <div class="data">
            <div class="forage">
                @for($i = 1; $i < count($TopicName); $i++)
                    <input type="hidden" name="foragedata" value="{{ $gradedata[$i]->AgeProficientPercent }}">
                @endfor
                    <input type="hidden" name="foragedata" value="{{ $gradedata[0]->AgeProficientPercent }}">
            </div>
            <div class="forall">
                @for($i = 1; $i < count($TopicName); $i++)
                    <input type="hidden" name="foralldata" value="{{ $gradedata[$i]->AllProficientPercent }}">
                @endfor
                    <input type="hidden" name="foralldata" value="{{ $gradedata[0]->AllProficientPercent }}">
            </div>
        </div>
    </div>

</body>
<script src="../newframework/js/Result/ShowChart.js"></script>
</html>