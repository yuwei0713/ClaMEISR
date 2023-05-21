function checkteacherdatasend(){
    var teachername = document.getElementById("TeacherName").value;
    var separate = document.querySelector('input[name="separate"]:checked');
    var kindergarten = document.querySelector('input[name="kindergarten"]:checked');
    var counseling = document.querySelector('input[name="counseling"]:checked');
    var routinesbased = document.querySelector('input[name="routinesbased"]:checked');
    if(teachername == ""){
        document.getElementById("name_fill_alart").textContent = "姓名尚未填寫";
    }
    if((teachername == "")||(separate == null)||(kindergarten == null)||(counseling == null)||(routinesbased == null)){
        document.getElementById("teacher_fill_alart").textContent = "問卷尚未填寫完畢!!!"
    }
    else {
        document.getElementById("teacher_fill_alart").style.display = "none";
        document.getElementById("name_fill_alart").style.display = "none";
        document.getElementById("TeacherBasicData").submit();
    }
}
function checkhistoryteacherdatasend(){
    var teachername = document.getElementById("TeacherName").value;
    var separate = document.querySelector('input[name="separate"]:checked');
    var kindergarten = document.querySelector('input[name="kindergarten"]:checked');
    var counseling = document.querySelector('input[name="counseling"]:checked');
    var routinesbased = document.querySelector('input[name="routinesbased"]:checked');
    if(teachername == ""){
        document.getElementById("name_fill_alart").textContent = "姓名尚未填寫";
    }
    if((teachername == "")||(separate == null)||(kindergarten == null)||(counseling == null)||(routinesbased == null)){
        document.getElementById("teacher_fill_alart").textContent = "問卷尚未填寫完畢!!!";
    }
    else {
        document.getElementById("teacher_fill_alart").style.display = "none";
        document.getElementById("name_fill_alart").style.display = "none";
        document.getElementById("TeacherHistoryData").submit();
    }
}

function checkchildsend(questioncode) {
    document.getElementById("fill_alart").style.display = "none";
    var getSelectedValue = document.querySelector('input[name="child"]:checked');
    if (getSelectedValue == null)
        document.getElementById("checkchild_fill_alart").textContent = "尚未選擇幼兒!"
    else {
        document.getElementById("checkchild_fill_alart").style.display = "none";
        document.getElementById("ChooseChild"+questioncode).submit();
    }
}
function checkstatussend() {
    document.getElementById("fill_alart").style.display = "none";
    var getSelectedValue = document.querySelector('input[name="childstatus"]:checked');
    if (getSelectedValue == null)
        document.getElementById("fill_alart").textContent = "尚未選擇狀態!"
    else {
        document.getElementById("fill_alart").style.display = "none";
        document.getElementById("ChooseStatus").submit();
    }
}
function checkhistorysend() {
    document.getElementById("fill_alart").style.display = "none";
    var getSelectedValue = document.querySelector('input[name="historychild"]:checked');
    if (getSelectedValue == null)
        document.getElementById("fill_alart").textContent = "尚未選擇幼兒!"
    else {
        document.getElementById("fill_alart").style.display = "none";
        document.getElementById("ChooseHistory").submit();
    }
}
function checkquestionhistorysend() {
    document.getElementById("fill_alart").style.display = "none";
    var getSelectedValue = document.querySelector('input[name="historychild"]:checked');
    if (getSelectedValue == null)
        document.getElementById("fill_alart").textContent = "尚未選擇幼兒!"
    else {
        document.getElementById("fill_alart").style.display = "none";
        document.getElementById("ChooseQuestionHistory").submit();
    }
}
function jumptostatussend(modalid){
    let modalname = '#' + modalid;
    $(modalname).modal('hide');
    fillstatus();
}

function fillnumber(code) {
    try {
        document.getElementById("QuestionCode").value = code;
    } catch (e) {

    }
    let modalname = '#childcard' + code;
    $(modalname).modal('show');
}
function fillteacher() {
    $('#teachercard').modal('show');
}
function historyteacher() {
    $('#historyteachercard').modal('show');
}
function fillstatus() {
    $('#statuscard').modal('show');
}
function childhistorycheck() {
    $('#childhistorycard').modal('show');
}
function questionhistorycheck(code) {
    document.getElementById("HistoryQuestionCode").value = code;
    $('#questionhistorycard').modal('show');
}
function questionresultunify(){
    $('#QandRUnify').modal('show');
}
//教師基本資料 未送出，關掉Modal時重置內容
$(document).ready(function (){
    $('#historyteachercard').on('hidden.bs.modal', function(){
        $('#TeacherHistoryData')[0].reset();
    });
});