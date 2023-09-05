@if($flag == 0)
    @include('newframework.layouts.cardmodel.childempty')
@elseif($flag == 1)
    @foreach ($ChildAndFill as $QuestionValue=>$ChildData )
        @php
        $QuestionCode = str_replace('代號','',$QuestionValue);
        @endphp
        <div id="childcard{{$QuestionCode}}" class="modal fade">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>ClaMEISER-幼兒資料</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.ClaMEISER.show') }}" method="GET" id="ChooseChild{{$QuestionCode}}">
                            @csrf
                            <input name="QuestionCode" id="QuestionCode" type="hidden" value="{{$QuestionCode}}">
                            @foreach ( $ChildData as $cdata=>$cdata_class)
                                @if (!empty($cdata_class))
                                    @php
                                        $searchyear = str_replace('年度','',$cdata);
                                    @endphp
                                <div class="yearframwork" name="qsearch-{{$searchyear}}">
                                    <div class="yearcontent">{{ $cdata }}</div>
                                    @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                        <div name="qsearch-{{ $cdata_title }}">
                                            <div class="classcontent">{{ $cdata_title }}</div>
                                            <div class="student_framework">
                                                @for( $i = 0 ;$i < count($cdata_value) ; $i++ ) 
                                                    <label class="student_option qwrap" data-qindex="{{ $cdata_value[$i]['ChildName'] }}-{{ $cdata_value[$i]['ChildNumber'] }}">
                                                        <span class="option_position">
                                                            <input class="student_circle" type="radio" name="child" value="{{ $cdata_value[$i]['ChildValue'] }}">
                                                        </span>
                                                        <div class="option_content">
                                                            <span class="option_value">姓名：{{ $cdata_value[$i]['ChildName'] }}</span>
                                                            <span class="option_value">座號：{{ $cdata_value[$i]['ChildNumber'] }}</span>
                                                            <span class="option_value">填寫：{{ $cdata_value[$i]['FillStatus'] }}</span>
                                                        </div>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            @endforeach
                            <div class="next-page">
                                <button type="button" class="btn btn-secondary" onclick="checkchildsend({{$QuestionCode}})">確定</button>
                                <div id="checkchild_fill_alart" class="fill-alart"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
@endif