<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-計算結果</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @if($errors->any())
    <script>
        $(document).ready(function() {
            alert("{{ $errors->first() }}")
        })
    </script>
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
            <script>
                function notcompare() {
                    alert("填寫次數未超過2次");
                }
            </script>
            <label class="result-detail-content">
                <button type="button" onclick="notcompare()">歷史紀錄比較</button>
            </label>
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
            <button type="button" class="pre-button" onclick="location.href='{{ url('/front') }}'"><span>回首頁</span></button>
            @elseif( $ifdirect == 0 )
            <button type="button" class="pre-button" onclick="history.back()"><span>回上頁</span></button>
            @endif
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            data: {
                labels: [@for($i = 1; $i < count($TopicName); $i++)
                    @php
                    $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
                    @endphp '{{ $TopicName[$i] }}',
                    @endfor
                    @php
                    $TopicName[0] = preg_replace("/\([^)]+\)/", "", $TopicName[0]);
                    @endphp '{{ $TopicName[0] }}'
                ],
                datasets: [{
                    type: 'line',
                    label: '符合年齡的精熟度',

                    data: [
                        @for($i = 1; $i < count($TopicName); $i++)
                        '{{ $gradedata[$i]->AgeProficientPercent }}',
                        @endfor '{{ $gradedata[0]->AgeProficientPercent }}'
                    ],
                    borderWidth: 1
                }, {
                    type: 'line',
                    label: '作息整體的精熟度',
                    data: [@for($i = 1; $i < count($TopicName); $i++)
                        '{{ $gradedata[$i]->AllProficientPercent }}',
                        @endfor '{{ $gradedata[0]->AllProficientPercent }}'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 25
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 18,
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 20,
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>