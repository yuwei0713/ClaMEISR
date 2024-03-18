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
    <script src="../newframework/js/Chartjs/dist/chart.umd.js"></script>
</head>
<body>
@include('newframework.layouts.universal.nav')
    <div class="container Block">
        <div class="choose-framework">
            @for($filltime = 0; $filltime < count($gradedata); $filltime++) 
            <label class="choose-inner-fraework flip">
                    <input type="checkbox" name="fillbutton" data-filltime="{{$filltime+1}}" id="{{$filltime+1}}">
                    <span>第{{$filltime+1}}筆資料</span>
            </label>
            @endfor
        </div>
        <!--視覺化圖形-->
        <div>
            <canvas id="FirstChart" class="vision"></canvas>
        </div>
        <div>
            <canvas id="SecondChart" class="vision"></canvas>
        </div>
        <div class="dataput">
            <input type="hidden" id="totalfill" value="{{ count($gradedata) }}">
            <div class="topic">
                @for($i = 1; $i < count($TopicName); $i++)
                    @php
                        $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
                    @endphp 
                    <input type="hidden" name="topic" value="{{ $TopicName[$i] }}" >
                @endfor
                @php
                    $TopicName[0] = preg_replace("/\([^)]+\)/", "", $TopicName[0]);
                @endphp
                <input type="hidden" name="topic" value="{{ $TopicName[0] }}">
            </div>
            <div class="fisrtdata">
                @for($filltime = 0; $filltime < count($gradedata); $filltime++)
                <label class="foragelabel">
                    @for($i = 1; $i < count($TopicName); $i++)
                    <input type="hidden" name="forage{{ (int)$filltime + 1 }}" value="{{ $gradedata[$filltime][$i]->AgeProficientPercent }}">
                    @endfor
                    <input type="hidden" name="forage{{ (int)$filltime + 1 }}" value="{{ $gradedata[$filltime][0]->AgeProficientPercent }}">
                </label>
                @endfor
            </div>
            <div class="seconddata">
                @for($filltime = 0; $filltime < count($gradedata); $filltime++)
                <label class="foragelabel">
                    @for($i = 1; $i < count($TopicName); $i++)
                    <input type="hidden" name="forall{{ (int)$filltime + 1 }}" value="{{ $gradedata[$filltime][$i]->AllProficientPercent }}">
                    @endfor
                    <input type="hidden" name="forall{{ (int)$filltime + 1 }}" value="{{ $gradedata[$filltime][0]->AllProficientPercent }}">
                </label>
                @endfor
            </div>
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
            <button type="button" class="pre-button" id="prebutton" data-action="back"><span>回上頁</span></button>
            </div>
    </div>
    <script src="../newframework/js/Result/prebutton.js"></script>
    <script src="../newframework/js/Result/CompareShowChart.js"></script>
</body>

</html>