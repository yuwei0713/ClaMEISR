<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ClaMEISER-問卷填寫</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/layout.css" />
    <script src="../js/jquery-3.5.0.min.js"></script>
    <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet">
    <script src="../js/option_click.js"></script>
    <script src="../js/changeshow.js"></script>
    <link href="../css/ClaMEISER_History.css" rel="stylesheet">
</head>

<body>
    @include('layouts.session-message')
    @include('layouts.header')
    <script>
        $(function(){
            $(".flip").click(function(){
                $(this).next(".panel").slideToggle(300);
                $(this).toggleClass('active');
            });
        });
    </script>
    <div class="choosetopic container">
        <div class="choosetopic-title-framework flip">
            <span class="choosetopic-title">作息表</span>
            <span class="arrow">arrow</span>
        </div>
        <div class="panel">
        @for($i = 0 ;$i < count($HistoryData); $i++) 
        <label class="chooseframeworklabel" for="span{{ $HistoryData[$i]['BigTopicNumber'] }}" id="label{{ $HistoryData[$i]['BigTopicNumber'] }}">
            <div class="chooseframework" onclick="changeshow({{ $HistoryData[$i]['BigTopicNumber'] }})">
                <span id="span{{ $HistoryData[$i]['BigTopicNumber'] }}">{{ $HistoryData[$i]["BigTopicName"] }}</span>
            </div>
        </label>
        @endfor
        </div>
        
    </div>
    <input type="hidden" id="currenttalbe" value="">
    <div class="store-framework">
        <button type="button" class="next-button" onclick="checkoutput(0)"><span>儲存</span></button>
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
        @for($i = 0 ;$i< count($HistoryData); $i++)
        <div class="main-framwork" id="table{{ $HistoryData[$i]['BigTopicNumber'] }}">
            <!--問答-->
            <div class="question-framwork">
                <div class="inner-framwork">
                    <div class="theme-framework">
                        <h5 class="theme-css">
                            <div class="theme-flex">
                                <div>
                                    {{ $HistoryData[$i]["BigTopicName"] }}
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
                                        $child_flag = 0
                                        @endphp
                                        <input type="hidden" id="Topic{{ $HistoryData[$i]['BigTopicNumber'] }}" name="Topic{{ $HistoryData[$i]['BigTopicNumber'] }}" value="{{ count($HistoryData[$i]['Detail']) }}">
                                        <div class="rTableRow tablehead">
                                            <div class="rTableCell rTableHead"></div>
                                            <div class="rTableCell rTableHead old-css option-css">年齡</div>
                                            @foreach ( $HistoryData[$i]["OptionContent"] as $optioncontent)
                                            <div class="rTableCell rTableHead old-css option-css">{{ $optioncontent }}</div>
                                            @endforeach
                                            @foreach ( $HistoryData[$i]["AdditionTitle"] as $additiontitle)
                                            <div class="rTableCell rTableHead represent-css option-css">{{ $additiontitle }}</div>
                                            @endforeach
                                        </div>
                                        @foreach ( $HistoryData[$i]["Detail"] as $detail)
                                        @if ($ChildBasicData->Age >= $detail['SuitableAge'])
                                        <div class="rTableRow topic-rows" id="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}">
                                            @else
                                            @if($child_flag == 0)
                                            @php
                                            $child_flag = 1
                                            @endphp
                                        <div class="rTableRow topic-rows not-yet over_age" id="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}">
                                            @elseif($child_flag == 1)
                                        <div class="rTableRow topic-rows over_age" id="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}">
                                            @endif
                                            @endif
                                            <div class="rTableCell">
                                                <div class="topic-css">{{ $detail['SmTopicContent'] }}</div>
                                            </div>
                                            <div class="rTableCell old-css option-css" data-th="年齡:">{{ $detail['SuitableAge'] }}</div>
                                            @for( $k=0;$k < count($detail['OptionValue']) ; $k++) 
                                            <label class="rwd-option-framework rTableCell">
                                                <div class="option-css" data-th="{{ $HistoryData[$i]["OptionContent"][$k] }}">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            @if( $detail['FillTopic'] == ($k+1) )
                                                            <input type="radio" name="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}" value="{{$k+1}}-{{ $detail['OptionValue'][$k] }}" class="option-circle" checked>
                                                            @else
                                                            <input type="radio" name="q{{ $HistoryData[$i]['BigTopicNumber'] }}-{{ $detail['SmTopicNumber'] }}" value="{{$k+1}}-{{ $detail['OptionValue'][$k] }}" class="option-circle">
                                                            @endif
                                                        </div>
                                                    </span>
                                                </span>
                                                </div>
                                            </label>
                                            @endfor
                                            @for( $j=0;$j< count($detail['AdditionContent']) ; $j++) 
                                            <div class="rTableCell represent-css option-css">{{ $detail['AdditionContent'][$j] }}</div>
                                            @endfor
                                        </div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="send-framwork">
                        <div class="pre-page">
                            <button type="button" class="pre-button" onclick="location.href='{{ url('/front') }}'"><span>回首頁</span></button>
                        </div>
                        @if($i == count($HistoryData)-1)
                        <div class="next-page" id="finalpagebutton">
                            <button type="button" class="next-button" onclick="checkoutput(1)"><span>保存並計算結果</span></button>
                            <div id="fill_alart" class="fill-alart"></div>
                        </div>
                        @else
                        <div class="next-page" id="finalpagebutton">
                            <button type="button" class="next-button" onclick="changeshow({{ $HistoryData[$i]['BigTopicNumber']+1 }})"><span>下一頁</span></button>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endfor
    </form>
</body>

</html>