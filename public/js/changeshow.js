function changeshow(number){
    let currenttable = document.getElementById("currenttalbe").value;
    let currenttablename = "#table"+currenttable;
    let newtablename = "#table"+number;
    let currentlabel = "#label"+currenttable;
    let newlabel = "#label"+number;

    $(currentlabel).removeClass("tabActive");
    $(newlabel).addClass("tabActive");
    $(currenttablename).css("display", "none");
    $(newtablename).css("display", "block");
    $("#currenttalbe").val(number);
}
$(document).ready(function () {
    $("#table1").css("display", "block");
    $("#currenttalbe").val("1");
    $("#label1").addClass("tabActive");
});