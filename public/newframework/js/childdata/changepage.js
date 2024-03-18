function ChangePage(pagename) {

    var basicpage = document.getElementById("Basic");
    var diagnosispage = document.getElementById("Diagnosis");
    var familypage = document.getElementById("Family");

    var basicdiv = document.getElementById("Basic-label");
    var diagnosisdiv = document.getElementById("Diagnosis-label");
    var familydiv = document.getElementById("Family-label");

    //change page show
    if (pagename == 'basic') {
        basicpage.style.display = "block";
        diagnosispage.style.display = "none";
        familypage.style.display = "none";

        basicdiv.classList.add("pageactive");
        diagnosisdiv.classList.remove("pageactive");
        familydiv.classList.remove("pageactive");

        basicdiv.querySelector("div").classList.add("pageactive-border");
        diagnosisdiv.querySelector("div").classList.remove("pageactive-border");
        familydiv.querySelector("div").classList.remove("pageactive-border");
    }
    if (pagename == 'diagnosis') {
        basicpage.style.display = "none";
        diagnosispage.style.display = "block";
        familypage.style.display = "none";

        basicdiv.classList.remove("pageactive");
        diagnosisdiv.classList.add("pageactive");
        familydiv.classList.remove("pageactive");

        basicdiv.querySelector("div").classList.remove("pageactive-border");
        diagnosisdiv.querySelector("div").classList.add("pageactive-border");
        familydiv.querySelector("div").classList.remove("pageactive-border");
    }
    if (pagename == 'family') {
        basicpage.style.display = "none";
        diagnosispage.style.display = "none";
        familypage.style.display = "block";

        basicdiv.classList.remove("pageactive");
        diagnosisdiv.classList.remove("pageactive");
        familydiv.classList.add("pageactive");

        basicdiv.querySelector("div").classList.remove("pageactive-border");
        diagnosisdiv.querySelector("div").classList.remove("pageactive-border");
        familydiv.querySelector("div").classList.add("pageactive-border");
    }
    JudgePage(pagename);
}

function JudgePage(pagename) {
    //change button which for next or pre
    var status = document.querySelector('input[name="status"]:checked').value;

    var next_button = document.getElementById("next_page_button");
    var next_span = next_button.querySelector("span");

    var pre_button = document.getElementById("pre_page_button");
    var pre_span = pre_button.querySelector("span");

    if (status == "confirm" || status == "suspected") {
        //have diagnosis
        if (pagename == 'basic') {
            next_button.setAttribute("data-changepage", "diagnosis");
            next_span.textContent = "下一頁";

            pre_button.setAttribute("data-changepage", "front");
            pre_span.textContent = "回首頁";
        }
        if (pagename == 'diagnosis') {
            next_button.setAttribute("data-changepage", "family");
            next_span.textContent = "下一頁";

            pre_button.setAttribute("data-changepage", "basic");
            pre_span.textContent = "上一頁";
        }
        if (pagename == 'family') {
            next_button.setAttribute("data-changepage", "checkoutput");
            next_span.textContent = "完成";

            pre_button.setAttribute("data-changepage", "diagnosis");
            pre_span.textContent = "上一頁";
        }
        ChangeDiagnosis(status);
    }
    if (status == "none") {
        //havn't diagnosis
        if (pagename == 'basic') {
            next_button.setAttribute("data-changepage", "family");
            next_span.textContent = "下一頁";

            pre_button.setAttribute("data-changepage", "front");
            pre_span.textContent = "回首頁";
        }
        if (pagename == 'family') {
            next_button.setAttribute("data-changepage", "checkoutput");
            next_span.textContent = "完成";

            pre_button.setAttribute("data-changepage", "basic");
            pre_span.textContent = "上一頁";
        }
    }
}
function ChangeDiagnosis(status) {
    if (status == "confirm") {
        document.getElementById("q7").querySelector(".option_title").innerHTML = "障礙類別 <span class=\"need\">*</span>";
        document.getElementById("q9").style.display = "none";

        //when status change and fianl one is confirm, then check diagnosis if click, if checked, then show degree manual
        var diagnosis = document.querySelector('input[name="diagnosis"]:checked');
        if (diagnosis) {
            if (diagnosis.value != "other" && diagnosis) {
                $(".manual_option").css("display", "block");
            }
            if (diagnosis.value == "other" && diagnosis){
                $(".manual_option").css("display", "none");
            }
        }
    }
    if (status == "suspected") {
        document.getElementById("q7").querySelector(".option_title").innerHTML = "疑似障礙類別 <span class=\"need\">*</span>";
        document.getElementById("q8").style.display = "none";
        document.getElementById("q9").style.display = "block";
    }
}
$(document).ready(function () {
    ChangePage('basic');
});
try{
    document.getElementById('Basic-label').addEventListener('click',function(){
        var changepage = this.getAttribute("data-changepage");
        ChangePage(changepage)
    });
}catch(e){}
try{
    document.getElementById('Diagnosis-label').addEventListener('click',function(){
        var changepage = this.getAttribute("data-changepage");
        ChangePage(changepage)
    });
}catch(e){}
try{
    document.getElementById('Family-label').addEventListener('click',function(){
        var changepage = this.getAttribute("data-changepage");
        ChangePage(changepage)
    });
}catch(e){}
try{
    document.getElementById('pre_page_button').addEventListener('click',function(){
        var changepage = this.getAttribute("data-changepage");
        //front
        if(changepage == "front"){
            window.location.href='/front';
        }else{
            ChangePage(changepage);
        }
        
    });
}catch(e){}
try{
    document.getElementById('next_page_button').addEventListener('click',function(){
        var changepage = this.getAttribute("data-changepage");
        //checkoutput
        if(changepage == "checkoutput"){
            checkoutput();
        }else{
            ChangePage(changepage);
        }
        
    });
}catch(e){}
