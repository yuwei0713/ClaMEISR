<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-問卷比較</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <link href="../newframework/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/jquery-3.5.0.min.js"></script>
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

    
    <link rel="stylesheet" type="text/css" href="../newframework/css/Result/ResultPage.css" />
    <link rel="stylesheet" type="text/css" href="../newframework/css/Result/Result.css" />
    <link rel="stylesheet" type="text/css" href="../newframework/css/Result/Compare.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
@include('newframework.layouts.universal.nav')
    <div class="container Block">
        <div class="choose-framework">
            @for($filltime = 0; $filltime < count($gradedata); $filltime++) 
            <label class="choose-inner-fraework flip">
                    <input type="checkbox" id="{{$filltime+1}}" onclick="insert_data({{$filltime}})" name="horns">
                    <span>第{{$filltime+1}}筆資料</span>
            </label>
            @endfor
        </div>
        
        <script>
            let first_old_data = [
                @for($filltime = 0; $filltime < count($gradedata); $filltime++)[
                    @for($i = 1; $i < count($TopicName); $i++)
                    '{{ $gradedata[$filltime][$i]->AgeProficientPercent }}',
                    @endfor '{{ $gradedata[$filltime][0]->AgeProficientPercent }}'
                ],
                @endfor
            ];
            let second_old_data = [
                @for($filltime = 0; $filltime < count($gradedata); $filltime++)[
                    @for($i = 1; $i < count($TopicName); $i++)
                    '{{ $gradedata[$filltime][$i]->AllProficientPercent }}',
                    @endfor '{{ $gradedata[$filltime][0]->AllProficientPercent }}'
                ],
                @endfor
            ]
            var first_new_data = []; //勾選後修改資料(新資料集)
            var second_new_data = []; //勾選後修改資料(新資料集)

            function insert_data(id) {
                var num = document.getElementById(id + 1);
                var label = num.closest("label")
                if (num.checked) { //確認勾選後，將完整資料集中勾選的該筆資料加入新資料
                    label.classList.add("active");
                    first_new_data[id] = first_old_data[id];
                    second_new_data[id] = second_old_data[id];
                }
                if (!num.checked) { //取消勾選後，將新資料集中該筆勾選資料刪除
                    label.classList.remove("active");
                    first_new_data[id] = null;
                    second_new_data[id] = null;
                }
                FirstChart.data = {
                    labels: [
                        @for($i = 1; $i < count($TopicName); $i++)
                        @php
                        $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
                        @endphp '{{ $TopicName[$i] }}',
                        @endfor
                        @php
                        $TopicName[0] = preg_replace("/\([^)]+\)/", "", $TopicName[0]);
                        @endphp '{{ $TopicName[0] }}'
                    ],
                    datasets: [
                        @for($filltime = 1; $filltime <= count($gradedata); $filltime++) {
                            type: 'line',
                            label: '第{{((int)$filltime)}}次填寫',
                            data: first_new_data[
                                {{$filltime - 1}}
                            ],
                            borderWidth: 1
                        },
                        @endfor
                    ]
                };
                SecondChart.data = {
                    labels: [
                        @for($i = 1; $i < count($TopicName); $i++)
                        @php
                        $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
                        @endphp '{{ $TopicName[$i] }}',
                        @endfor
                        @php
                        $TopicName[0] = preg_replace("/\([^)]+\)/", "", $TopicName[0]);
                        @endphp '{{ $TopicName[0] }}'
                    ],
                    datasets: [
                        @for($filltime = 1; $filltime <= count($gradedata); $filltime++) {
                            type: 'line',
                            label: '第{{((int)$filltime)}}次填寫',
                            data: second_new_data[
                                {{$filltime - 1}}
                            ],
                            borderWidth: 1
                        },
                        @endfor
                    ]
                };
                FirstChart.update(); //更新
                SecondChart.update();
            }
        </script>
        <!--視覺化圖形-->
        <div>
            <canvas id="FirstChart" class="vision"></canvas>
        </div>
        <div>
            <canvas id="SecondChart" class="vision"></canvas>
        </div>
        <!--視覺化圖形end-->
        @for($filltime = 0; $filltime < count($gradedata); $filltime++ ) 
        <h3 class="table-title">第{{$filltime+1}}次填寫</h3>
        <table id="table{{((int)$filltime)+1}}" class="option-table">
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
                    <td>{{ $TopicName[$i] }}</td>

                    @if( $gradedata[$filltime][$i]->ThreePoint == 0 )
                    <td class="Nan_class">
                        <span>NaN</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$filltime][$i]->ThreePoint }}</span>
                    </td>
                    @endif

                    @if( $gradedata[$filltime][$i]->FillByAge == 0 )
                    <td class="Nan_class">
                        <span>NaN</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$filltime][$i]->FillByAge }}</span>
                    </td>
                    @endif

                    @if( $gradedata[$filltime][$i]->AgeProficientPercent == 0 )
                    <td class="Nan_class">
                        <span>NaN</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$filltime][$i]->AgeProficientPercent }}%</span>
                    </td>
                    @endif

                    @if( $gradedata[$filltime][$i]->FillByAll == 0 )
                    <td class="Nan_class">
                        <span>NaN</span>
                    </td>
                    @else
                    <td>
                        <span>
                            {{ $gradedata[$filltime][$i]->FillByAll }}
                        </span>
                    </td>
                    @endif

                    @if( $gradedata[$filltime][$i]->AllProficientPercent == 0 )
                    <td class="Nan_class">
                        <span>NaN</span>
                    </td>
                    @else
                    <td>
                        <span>{{ $gradedata[$filltime][$i]->AllProficientPercent }}%</span>
                    </td>
                    @endif
                    </tr>
                    @endfor
                    <tr>
                        <td>
                            <span>{{ $TopicName[0] }}</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[$filltime][0]->ThreePoint }}</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[$filltime][0]->FillByAge }}</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[$filltime][0]->AgeProficientPercent }}%</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[$filltime][0]->FillByAll }}</span>
                        </td>
                        <td>
                            <span>{{ $gradedata[$filltime][0]->AllProficientPercent }}%</span>
                        </td>
                    </tr>
            </tbody>
            </table>
            @endfor

            <div class="pre-page">
                <button type="button" class="pre-button" onclick="history.back()"><span>回上頁</span></button>
            </div>
    </div>

    <script>
        const ctx = document.getElementById('FirstChart');
        const data = {
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
                label: '',
                data: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                fill: true,
                backgroundColor: 'rgba(255,255,255,0)',
                borderColor: 'rgba(255,255,255,0)',
                hidden: true
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 25
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: '符合年齡的精熟度',
                        padding: {
                            top: 10,
                            bottom: 30
                        },
                        font: {
                            size: 30
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
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
        };
        const FirstChart = new Chart(ctx, config);
    </script>
    <script>
        const ctx2 = document.getElementById('SecondChart');
        const data2 = {
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
                label: '',
                data: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                fill: true,
                backgroundColor: 'rgba(255,255,255,0)',
                borderColor: 'rgba(255,255,255,0)',
                hidden: true
            }]
        };
        const config2 = {
            type: 'line',
            data: data2,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 25
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: '作息整體的精熟度',
                        padding: {
                            top: 10,
                            bottom: 30
                        },
                        font: {
                            size: 30
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
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
        }
        const SecondChart = new Chart(ctx2, config2);
    </script>

</body>

</html>