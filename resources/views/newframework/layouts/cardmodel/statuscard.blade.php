<!--幼兒資料Modal-->
<div id="statuscard" class="modal fade">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>ClaMEISER-幼兒狀態</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('child.infromation.show') }}" method="GET" id="ChooseStatus">
                    @csrf
                    <div class="student_framework">
                        <label class="student_option">
                            <span class="option_position">
                                <input class="student_circle" type="radio" name="childstatus" value="confirm">
                            </span>
                            <div class="option_content">
                                <span class="option_value">特殊生</span>
                            </div>
                        </label>
                        <label class="student_option">
                            <span class="option_position">
                                <input class="student_circle" type="radio" name="childstatus" value="suspected">
                            </span>
                            <div class="option_content">
                                <span class="option_value">疑似生</span>
                            </div>
                        </label>
                        <label class="student_option">
                            <span class="option_position">
                                <input class="student_circle" type="radio" name="childstatus" value="none">
                            </span>
                            <div class="option_content">
                                <span class="option_value">一般生</span>
                            </div>
                        </label>
                    </div>
                    <div class="next-page">
                        <button type="button" class="btn btn-secondary" onclick="checkstatussend()">確定</button>
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