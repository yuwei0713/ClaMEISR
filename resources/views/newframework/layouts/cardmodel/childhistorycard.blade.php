<!--幼兒歷史紀錄Modal-->
<div id="childhistorycard" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>ClaMEISER-幼兒資料</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <!-- 搜尋欄位-->
                <div class="search" id="childsearch">
                    <div class="multiSelect">
                        <span class="selectTitle">入學年度</span>
                        <div class="selectContent">
                            <div class="selectBtn" data-title="全部" id="searchyear"></div>
                            <div class="optionGroup">
                                @if(!empty($ChildData))
                                @foreach ( $ChildData as $cdata=>$cdata_class)
                                @if (!empty($cdata_class))
                                @php
                                $searchyear = str_replace('年度','',$cdata);
                                @endphp
                                <label><input type="checkbox" name="year[]" value="{{ $searchyear }}">{{ $cdata }}</label>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="multiSelect">
                        <span class="selectTitle">班級</span>
                        <div class="selectContent">
                            <div class="selectBtn" data-title="全部" id="searchyear"></div>
                            <div class="optionGroup">
                                @if(!empty($ChildData))
                                @foreach ( $ChildData as $cdata=>$cdata_class)
                                @if (!empty($cdata_class))
                                @foreach( $cdata_class as $cdata_title=>$cdata_value )
                                <label>
                                    <input type="checkbox" name="class[]" value="{{ $cdata_title }}">{{ $cdata_title }}
                                </label>
                                @endforeach
                                @break
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="multiSelect searchBox-framework">
                        <img src="../image/searchicon.png" width="16" height="16">
                        <input type="search" id="search-input" class="light-table-filter searchBox" data-table="order-table" placeholder="輸入座號或姓名">
                    </div>
                    <style id="m-search"></style>
                    <script>

                    </script>
                </div>
                <!-- 搜尋欄位 end-->
                <form action="{{ route('child.history.information.show') }}" method="GET" id="ChooseHistory">
                    @csrf
                    @if(!empty($ChildData))
                    @foreach ( $ChildData as $cdata=>$cdata_class)
                    @if (!empty($cdata_class))
                    @php
                    $searchyear = str_replace('年度','',$cdata);
                    @endphp
                    <div class="yearframwork" id="search-{{ $searchyear }}">
                        <div class="yearcontent">{{ $cdata }}</div>
                        @foreach( $cdata_class as $cdata_title=>$cdata_value )
                        <div id="search-{{ $cdata_title }}">
                            <div class="classcontent">{{ $cdata_title }}</div>
                            <div class="student_framework">
                                @for( $i = 0 ;$i < count($cdata_value) ; $i++ ) <label class="student_option wrap" data-index="{{ $cdata_value[$i]['ChildName'] }}-{{ $cdata_value[$i]['ChildNumber'] }}">
                                    <span class="option_position">
                                        <input class="student_circle" type="radio" name="historychild" value="{{ $cdata_value[$i]['ChildValue'] }}">
                                    </span>
                                    <div class="option_content">
                                        <span class="option_value">姓名：{{ $cdata_value[$i]['ChildName'] }}</span>
                                        <span class="option_value">座號：{{ $cdata_value[$i]['ChildNumber'] }}</span>
                                    </div>
                                    </label>
                                    @endfor
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @endforeach
                    @endif
                    <div class="next-page">
                        <button type="button" class="btn btn-secondary" onclick="checkhistorysend()">確定</button>
                        <div id="fill_alart" class="fill-alart"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>