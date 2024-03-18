<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>ClaMEISER-問卷詳細結果</title>
  <meta name="viewport" http-equiv="Content-Type" content="text/html;charset=UTF-8 width=device-width,initial-scale=1">
  <link href="../newframework/css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery-3.5.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../newframework/css/Result/ResultPage.css" />
  <link rel="stylesheet" type="text/css" href="../newframework/css/Result/Result.css" />
  <link rel="stylesheet" type="text/css" href="../newframework/css/Result/DetailResult.css" />

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
  @include('newframework.layouts.universal.nav')
  <div class="container Block">
    @if($errors->any())
    <input type="hidden" id="errormessage" value="{{ $errors->first() }}">
    <script src="../newframework/js/Result/Anyerror.js"></script>
    @endif

    <!--學生資訊-->
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
    <div class="container">
      <div class="table-title flip">
        <span><strong>功能性領域(Func)：分數總表</strong></span>
        <span class="arrow">arrow</span>
      </div>
      <table id="Functable" class="option-table panel">
        <thead>
          <tr class="table-primary">
            <th class="header-class">ClaMEISR 作息類別</th>
            <th class="header-class">成效領域名稱</th>
            <th class="header-class">評分為 3 分的題數</th>
            <th class="header-class">符合年齡的題數</th>
            <th class="header-class">符合年齡的精熟度 </th>
            <th class="header-class">填寫總題數</th>
            <th class="header-class">整體的精熟度</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i < count($TopicName); $i++) <tr>
            <td rowspan="3">
              @php
              $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
              @endphp {{ $TopicName[$i] }}
            </td>
            <td>
              <span>{{ $DetailData["FuncE"][$i]->DetailName }}</span>
            </td>
            <td>
              <span>{{ $DetailData["FuncE"][$i]->ThreePoint }}</span>
            </td>
            <td>
              <span>{{ $DetailData["FuncE"][$i]->FillByAge }}</span>
            </td>

            @if( $DetailData["FuncE"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
              @if( $DetailData["FuncE"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["FuncI"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["FuncI"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["FuncSR"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["FuncSR"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
          @for($i = 1; $i < count($TopicName); $i++) <tr>
            <td rowspan="5">
              @php
              $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
              @endphp {{ $TopicName[$i] }}
            </td>
            <td>
              <span>{{ $DetailData["DevA"][$i]->DetailName }}</span>
            </td>
            <td>
              <span>{{ $DetailData["DevA"][$i]->ThreePoint }}</span>
            </td>
            <td>
              <span>{{ $DetailData["DevA"][$i]->FillByAge }}</span>
            </td>

            @if( $DetailData["DevA"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
              @if( $DetailData["DevA"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["DevCG"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["DevCG"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["DevCM"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["DevCM"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["DevM"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["DevM"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["DevS"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["DevS"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
          @for($i = 1; $i < count($TopicName); $i++) <tr>
            <td rowspan="3">
              @php
              $TopicName[$i] = preg_replace("/\([^)]+\)/", "", $TopicName[$i]);
              @endphp {{ $TopicName[$i] }}
            </td>
            <td>
              <span>{{ $DetailData["OutOne"][$i]->Category }} {{ $DetailData["OutOne"][$i]->DetailName }}</span>
            </td>
            <td>
              <span>{{ $DetailData["OutOne"][$i]->ThreePoint }}</span>
            </td>
            <td>
              <span>{{ $DetailData["OutOne"][$i]->FillByAge }}</span>
            </td>

            @if( $DetailData["OutOne"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
              @if( $DetailData["OutOne"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["OutTwo"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["OutTwo"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                  @if( $DetailData["OutThree"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
                    @if( $DetailData["OutThree"][$i]->FillByAll < 3 ) <td class="Nan_class">
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
        <button type="button" class="pre-button" id="prebutton" data-action="back"><span>回上頁</span></button>
        <script src="../newframework/js/Result/prebutton.js"></script>
      </div>
    </div>
    <div class="dataput">
      <div class="Func">
        <div class="topic">
          <input type="hidden" name="functopic" value="E：投入">
          <input type="hidden" name="functopic" value="I：獨立性">
          <input type="hidden" name="functopic" value="SR：社會關係">
        </div>
        <div class="data">
          <input type="hidden" name="funcforagedata" value="{{ $DetailData["FuncE"][0]->AgeProficientPercent }}">
          <input type="hidden" name="funcforagedata" value="{{ $DetailData["FuncI"][0]->AgeProficientPercent }}">
          <input type="hidden" name="funcforagedata" value="{{ $DetailData["FuncSR"][0]->AgeProficientPercent }}">
          <input type="hidden" name="funcforalldata" value="{{ $DetailData["FuncE"][0]->AllProficientPercent }}">
          <input type="hidden" name="funcforalldata" value="{{ $DetailData["FuncI"][0]->AllProficientPercent }}">
          <input type="hidden" name="funcforalldata" value="{{ $DetailData["FuncSR"][0]->AllProficientPercent }}">
        </div>
      </div>
      <div class="Dev">
        <div class="topic">
          <input type="hidden" name="devtopic" value="A：適應性">
          <input type="hidden" name="devctopic" value="CG：認知">
          <input type="hidden" name="devctopic" value="CM：溝通">
          <input type="hidden" name="devctopic" value="M：動作">
          <input type="hidden" name="devctopic" value="S：社交">
        </div>
        <div class="data">
          <input type="hidden" name="devforagedata" value="{{ $DetailData["DevA"][0]->AgeProficientPercent }}">
          <input type="hidden" name="devforagedata" value="{{ $DetailData["DevCG"][0]->AgeProficientPercent }}">
          <input type="hidden" name="devforagedata" value="{{ $DetailData["DevCM"][0]->AgeProficientPercent }}">
          <input type="hidden" name="devforagedata" value="{{ $DetailData["DevM"][0]->AgeProficientPercent }}">
          <input type="hidden" name="devforagedata" value="{{ $DetailData["DevS"][0]->AgeProficientPercent }}">
          <input type="hidden" name="devforalldata" value="{{ $DetailData["DevS"][0]->AllProficientPercent }}">
          <input type="hidden" name="devforalldata" value="{{ $DetailData["DevS"][0]->AllProficientPercent }}">
          <input type="hidden" name="devforalldata" value="{{ $DetailData["DevS"][0]->AllProficientPercent }}">
          <input type="hidden" name="devforalldata" value="{{ $DetailData["DevS"][0]->AllProficientPercent }}">
          <input type="hidden" name="devforalldata" value="{{ $DetailData["DevS"][0]->AllProficientPercent }}">
        </div>
      </div>
      <div class="Out">
        <div class="topic">
          <input type="hidden" name="outtopic" value="1：正向社會關係">
          <input type="hidden" name="outtopic" value="2：獲得和使用知識和技巧">
          <input type="hidden" name="outtopic" value="3：採取行動以滿足需求">
        </div>
        <div class="data">
          <input type="hidden" name="outforagedata" value="{{ $DetailData["OutOne"][0]->AgeProficientPercent }}">
          <input type="hidden" name="outforagedata" value="{{ $DetailData["OutTwo"][0]->AgeProficientPercent }}">
          <input type="hidden" name="outforagedata" value="{{ $DetailData["OutThree"][0]->AgeProficientPercent }}">
          <input type="hidden" name="outforalldata" value="{{ $DetailData["OutOne"][0]->AllProficientPercent }}">
          <input type="hidden" name="outforalldata" value="{{ $DetailData["OutTwo"][0]->AllProficientPercent }}">
          <input type="hidden" name="outforalldata" value="{{ $DetailData["OutThree"][0]->AllProficientPercent }}">
        </div>
      </div>
    </div>
    <!--視覺化圖形 script-->
    <!--視覺化圖形 script end-->
    
  </div>
</body>

<script src="../newframework/js/Result/ShowDetailChart.js"></script>
<script src="../newframework/js/Questionnaire/flipslide.js"></script>
</html>