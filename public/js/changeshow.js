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
try{
    var changeshowElements = document.getElementsByName("changeshow");
    changeshowElements.forEach(function(element) {
        element.addEventListener("click", function() {
            var number = this.getAttribute("data-changepanel");
            changeshow(number);
        });
    });
}catch(e){}

try{
    var prepageElements = document.getElementsByName("prepage");
    prepageElements.forEach(function(element) {
        element.addEventListener("click", function() {
            var number = this.getAttribute("data-changepanel");
            if(number == "front"){
                window.location.href='/front';
            }else{
                changeshow(number);
            }
            if(number == "backtosearch"){
                window.location.href='/InformationHistory';
            }
        });
    });
}catch(e){}

try{
    var nextpageElements = document.getElementsByName("nextpage");
    nextpageElements.forEach(function(element) {
        element.addEventListener("click", function() {
            var number = this.getAttribute("data-changepanel");
            if(number == "checkoutput"){
                checkoutput(1)
            }else{
                changeshow(number);
            }
            if(number == "backtosearch"){
                window.location.href='/InformationHistory';
            }
        });
    });
}catch(e){}