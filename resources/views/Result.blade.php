<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-計算結果</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <link href="../css/header.css" rel="stylesheet">
    <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-3.5.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/ResultPage.css" />
    <link rel="stylesheet" type="text/css" href="../css/Result.css" />

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
    @include('layouts.header')
    <div class="container">
        <!--視覺化圖形-->
        <div>
            <canvas id="myChart" class="vision"></canvas>
        </div>
        <div class="result-detail">
            @if( $ifcompare == 1)
            <div class="result-detail-content">
                <form action="{{ route('questionnaire.result.compare.show') }}" method="GET">
                    @csrf
                    <input type="hidden" name="resultdata" value="{{ $CurrentData }}">
                    <button type="submit">歷史紀錄比較</button>
                </form>
            </div>
            @elseif( $ifcompare == 0)
            <script>
                function notcompare(){
                    alert("填寫次數未超過2次");
                }
            </script>
            <div class="result-detail-content">
                <button type="button" onclick="notcompare()">歷史紀錄比較</button>
            </div>
            @endif

            <div class="result-detail-content">
                <form action="{{ route('questionnaire.detailresult.show') }}" method="GET">
                    @csrf
                    <input type="hidden" name="resultdata" value="{{ $CurrentData }}">
                    <button type="submit">詳細資訊</button>
                </form>
            </div>
        </div>
        <!--視覺化圖形end-->
        <table id="table" class="option-table">
            <thead>
                <tr class="table-primary">
                    <th class="header-class">ClaMEISR 作息類別 (各類作息的題數)</th>
                    <th class="header-class">作息被為評 3 分的題數</th>
                    <th class="header-class">作息符合年齡的所有題數</th>
                    <th class="header-class">符合年齡的精熟度 </th>
                    <th class="header-class">作息全部的題數</th>
                    <th class="header-class">作息整體的精熟度</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i < count($TopicName); $i++) <tr>
                    <td>{{ $TopicName[$i] }}</td>

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
                            <span>{{ $TopicName[0] }}</span>
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

        <div class="pre-page">
<<<<<<< HEAD
=======
            @if( $ifdirect == 1 )
            <button type="button" class="pre-button" onclick="location.href='{{ url('/front') }}'"><span>回首頁</span></button>
            @elseif( $ifdirect == 0 )
            <button type="button" class="pre-button" onclick="history.back()"><span>回上頁</span></button>
            @endif
>>>>>>> dev
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