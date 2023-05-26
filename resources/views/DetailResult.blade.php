<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-問卷詳細結果</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <link href="../../css/header.css" rel="stylesheet">
    <link href="../../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../../js/jquery-3.5.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/ResultPage.css" />
    <link rel="stylesheet" type="text/css" href="../../css/DetailResult.css" />

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
     <!--學生資訊-->
     <div class="BasicInformation">
        <!--問卷名稱，班級，座號，姓名，填寫次數，填寫日期-->
        <div>
            <span>問卷名稱：</span>
            <span>{{ $QuestionName}}</span>
        </div>
        <div>
            <span>班級：</span>
            <span>{{ $ChildBasic->ClassName}}</span>
        </div>
        <div>
            <span>座號：</span>
            <span>{{ $ChildBasic->StudentCode}}</span>
        </div>
        <div>
            <span>姓名：</span>
            <span>{{ $ChildBasic->StudentName}}</span>
        </div>
        <div>
            <span>填寫次數：</span>
            <span>{{ $FillTime}}</span>
        </div>
        <div>
            <span>填寫日期：</span>
            <span>{{ $FillDate}}</span>
        </div>
    </div>
    <!--學生資訊end-->
    <!--視覺化圖形-->
    <div class="main-container">
            <div class="chart-container">
                <div class="table-title">
                    <span><strong>功能性領域(Func)</strong></span>
                </div>
                <canvas id="FuncChart" width="400px"></canvas>
            </div>
            <div class="chart-container">
                <div class="table-title">
                    <span><strong>發展領域(Dev)</strong></span>
                </div>
                <canvas id="DevChart" width="400px"></canvas>
            </div>
            <div class="chart-container">
                <div class="table-title">
                    <span><strong>成效(Out)</strong></span>
                </div>
                <canvas id="OutChart" width="400px"></canvas>
            </div>
        </div>
        <!--視覺化圖形end-->
    <script>
        $(function(){
            $(".flip").click(function(){
                $(this).next(".panel").slideToggle(300);
                $(this).toggleClass('active');
            });
        });
    </script>
    <div class="container">
        <div class="table-title flip">
            <span><strong>功能性領域(Func)：分數總表</strong></span>
            <span class="arrow">arrow</span>
        </div>
        <table id="Functable" class="option-table panel">
            <thead>
                <tr class="table-primary">
                <th class="header-class">ClaMEISR 作息類別 (各類作息的題數)</th>
                <th class="header-class">成效領域名稱</th>
                <th class="header-class">作息被為評 3 分的題數</th>
                <th class="header-class">作息符合年齡的所有題數</th>
                <th class="header-class">符合年齡的精熟度 </th>
                <th class="header-class">作息全部的題數</th>
                <th class="header-class">作息整體的精熟度</th>
                </tr>
            </thead>
            <tbody>
            @for($i = 1; $i < count($TopicName); $i++) 
            <tr>
                <td rowspan="3">{{ $TopicName[$i] }}</td>
                <td>
                    <span>{{ $DetailData["FuncE"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][$i]->FillByAge }}</span>
                </td>

                @if( $DetailData["FuncE"][$i]->FillByAll < 3 ) 
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["FuncE"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["FuncE"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["FuncE"][$i]->FillByAll < 3 ) 
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["FuncE"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["FuncI"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncI"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncI"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["FuncI"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["FuncI"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["FuncI"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["FuncI"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["FuncI"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["FuncSR"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncSR"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncSR"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["FuncSR"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["FuncSR"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["FuncSR"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["FuncSR"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["FuncSR"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            @endfor
            <tr>
                <td rowspan="3">
                    <span>{{ $TopicName[0] }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncE"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["FuncI"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncI"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncI"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncI"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncI"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncI"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["FuncSR"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncSR"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncSR"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncSR"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncSR"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["FuncSR"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="table-title flip">
            <span><strong>ClaMEISER 發展領域(Dev)：分數總表</strong></span>
            <span class="arrow">arrow</span>
        </div>
        <table id="Devtable" class="option-table panel">
            <thead>
            <tr class="table-primary">
                <th class="header-class">ClaMEISR 作息類別 (各類作息的題數)</th>
                <th class="header-class">成效領域名稱</th>
                <th class="header-class">作息被為評 3 分的題數</th>
                <th class="header-class">作息符合年齡的所有題數</th>
                <th class="header-class">符合年齡的精熟度 </th>
                <th class="header-class">作息全部的題數</th>
                <th class="header-class">作息整體的精熟度</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 1; $i < count($TopicName); $i++) 
            <tr>
                <td rowspan="5">{{ $TopicName[$i] }}</td>
                <td>
                    <span>{{ $DetailData["DevA"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][$i]->FillByAge }}</span>
                </td>

                @if( $DetailData["DevA"][$i]->FillByAll < 3 ) 
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevA"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["DevA"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["DevA"][$i]->FillByAll < 3 ) 
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevA"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevCG"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCG"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCG"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["DevCG"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevCG"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["DevCG"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["DevCG"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevCG"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevCM"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCM"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCM"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["DevCM"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevCM"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["DevCM"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["DevCM"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevCM"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevM"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevM"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevM"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["DevM"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevM"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["DevM"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["DevM"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevM"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevS"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevS"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevS"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["DevS"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevS"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["DevS"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["DevS"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["DevS"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            @endfor
            <tr>
                <td rowspan="5">
                    <span>{{ $TopicName[0] }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevA"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevCG"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCG"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCG"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCG"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCG"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCG"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevCM"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCM"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCM"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCM"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCM"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevCM"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevM"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevM"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevM"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevM"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevM"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevM"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["DevS"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevS"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevS"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevS"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevS"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["DevS"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
        </table>
        <div class="table-title flip">
            <span><strong>ClaMEISER 兒童成效領域精熟情形(Out)：分數總表</strong></span>
            <span class="arrow">arrow</span>
        </div>
        <table id="Outtable" class="option-table panel">
        <thead>
            <tr class="table-primary">
                <th class="header-class">ClaMEISR 作息類別 (各類作息的題數)</th>
                <th class="header-class">成效領域名稱</th>
                <th class="header-class">作息被為評 3 分的題數</th>
                <th class="header-class">作息符合年齡的所有題數</th>
                <th class="header-class">符合年齡的精熟度 </th>
                <th class="header-class">作息全部的題數</th>
                <th class="header-class">作息整體的精熟度</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 1; $i < count($TopicName); $i++) 
            <tr>
                <td rowspan="3">{{ $TopicName[$i] }}</td>
                <td>
                    <span>{{ $DetailData["OutOne"][$i]->Category }} {{ $DetailData["OutOne"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][$i]->FillByAge }}</span>
                </td>

                @if( $DetailData["OutOne"][$i]->FillByAll < 3 ) 
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["OutOne"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["OutOne"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["OutOne"][$i]->FillByAll < 3 ) 
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["OutOne"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["OutTwo"][$i]->Category }} {{ $DetailData["OutTwo"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutTwo"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutTwo"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["OutTwo"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["OutTwo"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["OutTwo"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["OutTwo"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["OutTwo"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["OutThree"][$i]->Category }} {{ $DetailData["OutThree"][$i]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutThree"][$i]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutThree"][$i]->FillByAge }}</span>
                </td>
                @if( $DetailData["OutThree"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["OutThree"][$i]->AgeProficientPercent }}%</span>
                </td>
                @endif
                <td>
                    <span>{{ $DetailData["OutThree"][$i]->FillByAll }}</span>
                </td>
                @if( $DetailData["OutThree"][$i]->FillByAll < 3 )
                <td class="Nan_class">
                    <span>N/A%</span>
                </td>
                @else
                <td>
                    <span>{{ $DetailData["OutThree"][$i]->AllProficientPercent }}%</span>
                </td>
                @endif
            </tr>
            @endfor
            <tr>
                <td rowspan="3">
                    <span>{{ $TopicName[0] }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][0]->Category }} {{ $DetailData["OutOne"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutOne"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["OutTwo"][0]->Category }} {{ $DetailData["OutTwo"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutTwo"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutTwo"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutTwo"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutTwo"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutTwo"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>{{ $DetailData["OutThree"][0]->Category }} {{ $DetailData["OutThree"][0]->DetailName }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutThree"][0]->ThreePoint }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutThree"][0]->FillByAge }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutThree"][0]->AgeProficientPercent }}%</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutThree"][0]->FillByAll }}</span>
                </td>
                <td>
                    <span>{{ $DetailData["OutThree"][0]->AllProficientPercent }}%</span>
                </td>
            </tr>
        </tbody>
        </table>
    <div class="pre-page">
        <button type="button" class="pre-button" onclick="history.back()"><span>回上頁</span></button>
    </div>
    </div>
    <!--視覺化圖形 script-->
    <script>
        const funcctx = document.getElementById('FuncChart');
        const funcdata = {
      labels: [
        "E：投入",
        "I：獨立性",
        "SR：社會關係"
      ],
      datasets: [{
        label: '符合年齡的精熟度',
        data: [
            '{{ $DetailData["FuncE"][0]->AgeProficientPercent }}',
            '{{ $DetailData["FuncI"][0]->AgeProficientPercent }}',
            '{{ $DetailData["FuncSR"][0]->AgeProficientPercent }}'
        ],
        fill: true,
      },{
        label: '作息整體精熟度',
        data: [
            '{{ $DetailData["FuncE"][0]->AllProficientPercent }}',
            '{{ $DetailData["FuncI"][0]->AllProficientPercent }}',
            '{{ $DetailData["FuncSR"][0]->AllProficientPercent }}'
        ],
        fill: true,
      }
        ]
        };
        const funcconfig = {
      type: 'radar',
      data: funcdata,
      options: {
        scales: {
                r: {
                    min: 0,
                    max: 100,
                    pointLabels: {
                        font: {
                            size: 16
                        }
                    }
                }
        },
        animation: false,
        plugins: {
          legend: {
            labels: {
              // This more specific font property overrides the global property
              font: {
                size: 18
              }
            }
          }
        },
        responsive: true, // 设置图表为响应式，根据屏幕窗口变化而变化
        maintainAspectRatio: false,// 保持图表原有比例
        elements: {
          line: {
            borderWidth: 3 // 设置线条宽度
          }
        }
      }
        };
        const FuncChart = new Chart(funcctx, funcconfig);
    </script>
    <script>
        const devctx = document.getElementById('DevChart');
        const devdata = {
      labels: [
        "A：適應性",
        "CG：認知",
        "CM：溝通",
        "M：動作",
        "S：社交"
      ],
      datasets: [{
        label: '符合年齡的精熟度',
        data: [
            '{{ $DetailData["DevA"][0]->AgeProficientPercent }}',
            '{{ $DetailData["DevCG"][0]->AgeProficientPercent }}',
            '{{ $DetailData["DevCM"][0]->AgeProficientPercent }}',
            '{{ $DetailData["DevM"][0]->AgeProficientPercent }}',
            '{{ $DetailData["DevS"][0]->AgeProficientPercent }}',
        ],
        fill: true,
      },{
        label: '作息整體精熟度',
        data: [
            '{{ $DetailData["DevA"][0]->AllProficientPercent }}',
            '{{ $DetailData["DevCG"][0]->AllProficientPercent }}',
            '{{ $DetailData["DevCM"][0]->AllProficientPercent }}',
            '{{ $DetailData["DevM"][0]->AllProficientPercent }}',
            '{{ $DetailData["DevS"][0]->AllProficientPercent }}',
        ],
        fill: true,
      }
        ]
        };
        const devconfig = {
      type: 'radar',
      data: devdata,
      options: {
        scales: {
                r: {
                    min: 0,
                    max: 100,
                    pointLabels: {
                        font: {
                            size: 16
                        }
                    }
                }
        },
        animation: false,
        plugins: {
          legend: {
            labels: {
              // This more specific font property overrides the global property
              font: {
                size: 18
              }
            }
          }
        },
        responsive: true, // 设置图表为响应式，根据屏幕窗口变化而变化
        maintainAspectRatio: false,// 保持图表原有比例
        elements: {
          line: {
            borderWidth: 3 // 设置线条宽度
          }
        }
      }
        };
        const DevChart = new Chart(devctx, devconfig);
    </script>
    <script>
        const outctx = document.getElementById('OutChart');
        const outdata = {
      labels: [
        "1：正向社會關係",
        "2：獲得和使用知識和技巧",
        "3：採取行動以滿足需求"
      ],
      datasets: [{
        label: '符合年齡的精熟度',
        data: [
            '{{ $DetailData["OutOne"][0]->AgeProficientPercent }}',
            '{{ $DetailData["OutTwo"][0]->AgeProficientPercent }}',
            '{{ $DetailData["OutThree"][0]->AgeProficientPercent }}'
        ],
        fill: true,
      },{
        label: '作息整體精熟度',
        data: [
            '{{ $DetailData["OutOne"][0]->AllProficientPercent }}',
            '{{ $DetailData["OutTwo"][0]->AllProficientPercent }}',
            '{{ $DetailData["OutThree"][0]->AllProficientPercent }}'
        ],
        fill: true,
      }
        ]
        };
        const outconfig = {
      type: 'radar',
      data: outdata,
      options: {
        scales: {
                r: {
                    min: 0,
                    max: 100,
                    pointLabels: {
                        font: {
                            size: 16
                        }
                    }
                }
        },
        animation: false,
        plugins: {
          legend: {
            labels: {
              // This more specific font property overrides the global property
              font: {
                size: 18
              }
            }
          }
        },
        responsive: true, // 设置图表为响应式，根据屏幕窗口变化而变化
        maintainAspectRatio: false,// 保持图表原有比例
        elements: {
          line: {
            borderWidth: 3 // 设置线条宽度
          }
        }
      }
        };
        const OutChart = new Chart(outctx, outconfig);
    </script>
    <!--視覺化圖形 script end-->

</body>

</html>