//delete button
function delete_check() {
    var check = confirm("是否確定刪除資料，刪除後資料將無法復原!");
    if (check == true) {
        document.getElementById("DIForm").submit();
    }
}
//input click and checked, change label's css
$(document).ready(function () {
    var radioInputs = document.querySelectorAll(".option_circle");
    var checkboxInputs = document.querySelectorAll(".option_square");

    // Attach a click event listener to each input element
    radioInputs.forEach(function (input) {

        input.addEventListener("click", function () {
            // Get the parent label element
            var name = this.getAttribute("name")
            // Check if the input is checked
            let rates = document.getElementsByName(name);
            rates.forEach((rate) => {
                var label = rate.closest(".input-option");
                if (rate.checked) {
                    label.classList.add("input-click-option");
                } else {
                    label.classList.remove("input-click-option");
                }
            });
            if (this.checked) {
                // Change the class of the label to "input-click-option"

            } else {
                // Change the class of the label back to "input-option"

            }
        });
    });
    checkboxInputs.forEach(function (input) {

        input.addEventListener("click", function () {
            // Get the parent label element
            var name = this.getAttribute("name")
            // Check if the input is checked
            let rates = document.getElementsByName(name);
            rates.forEach((rate) => {
                var label = rate.closest(".input-option");
                if (rate.checked) {
                    label.classList.add("input-click-option");
                } else {
                    label.classList.remove("input-click-option");
                }
            });
            if (this.checked) {
                // Change the class of the label to "input-click-option"

            } else {
                // Change the class of the label back to "input-option"

            }
        });
    });
})
//change child status, change title option
$(document).ready(function () {
    //default setting
    var status = document.querySelector('input[name="status"]:checked').value;
    if (status == "confirm" || status == "suspected") {
        $("#Diagnosis-label").css("display", "block");
    }
    if (status == "none") {
        $("#Diagnosis-label").css("display", "none");
    }
    //after status input click
    $('input[name="status"]').click(function () {
        if ($(this).attr("value") == "confirm" || $(this).attr("value") == "suspected") {
            $("#Diagnosis-label").css("display", "block");
        }
        if ($(this).attr("value") == "none") {
            $("#Diagnosis-label").css("display", "none");
        }
        //because input[name="status"] only on basic page, so parameter always = 'basic'
        JudgePage('basic');
    })
})
//change child status, change diagnosis show
$(document).ready(function () {
    $('input[name="status"]').click(function () {
        if ($(this).attr("value") == "") {

        }
    });
    //when click "other", show text area
    $('input[name="living[]"]').click(function () {
        var ifother = false;
        var living = document.querySelectorAll('input[name="living[]"]:checked');
        var other = document.getElementById('other_living');
        living.forEach((living) => {
            if (living.value == "other") {
                ifother = true;
            }
        });
        if (ifother) {
            other.style.display = 'block';
        } else {
            other.style.display = 'none';
        }
    });
    $('input[name="fst_attend"]').click(function () {
        if ($(this).attr("value") == "other") {
            $("#other_fst_attend").css("display", "block");
        } else {
            $("#other_fst_attend").css("display", "none");
        }
    });
    $('input[name="sec_attend"]').click(function () {
        if ($(this).attr("value") == "other") {
            $("#other_sec_attend").css("display", "block")
        } else {
            $("#other_sec_attend").css("display", "none")
        }
    });
    //障礙類別 判斷
    $('input[name="diagnosis"]').click(function () {
        var status = document.querySelector('input[name="status"]:checked').value;
        if ($(this).attr("value") == "other") {
            $("#other_diagnosis").css("display", "block");

            $(".diagnosis_option").css("display", "none");
            $(".manual_option").css("display", "none");
        } else {
            $("#other_diagnosis").css("display", "none");
            if ($(this).attr("value") == "發展遲緩") {
                $(".diagnosis_option").css("display", "block");
            } else {
                $(".diagnosis_option").css("display", "none");
            }
            if (status == "confirm") {
                $(".manual_option").css("display", "block");
            }
            if (status == "suspected") {
                $(".manual_option").css("display", "none");
            }
        }
    });
})
//get proof value (鑑定安置佐證) change select
$(document).ready(function () {
    $('input[name="proofs[]"]').click(function () {
        disableflag = true;
        var proofs = document.querySelectorAll('input[name="proofs[]"]:checked');
        var allvalue = document.querySelectorAll('input[name="proofs[]"]');
        var manual = document.querySelectorAll('input[name="manual"]');
        proofs.forEach((proof) => {
            if (proof.value == "不需填寫") { //disable q
                disableflag = false;
                allvalue.forEach((ifdisable) => {
                    if (ifdisable.value !== "不需填寫") {
                        ifdisable.disable = true
                        ifdisable.checked = false;
                        ifdisable.parentElement.classList.remove("input-click-option");
                    }
                })
                manual.forEach((dismanual) => {
                    dismanual.checked = false;
                    dismanual.parentElement.classList.remove("input-click-option");
                })
                document.getElementById("q12").style.display = "none";
            }
        });
        if (disableflag) {
            allvalue.disable = false;
            document.getElementById("q12").style.display = "block";
        }
    });
})

//check before submit
function checkoutput() {
    var status = document.querySelector('input[name="status"]:checked').value;
    //check basic
    basicflag = checkbasic()
    //check diagnosis (confirm or suspected)
    diagnosisflag = checkdiagnosis(status);
    //check family
    familyflag = checkfamily()

    //final
    if(basicflag){
        document.getElementById("fill_alart").textContent = "資料尚未填寫完畢!!!"
        ChangePage('basic')
    }else if(diagnosisflag){
        document.getElementById("fill_alart").textContent = "資料尚未填寫完畢!!!"
        ChangePage('diagnosis')
    }else if(familyflag){
        document.getElementById("fill_alart").textContent = "資料尚未填寫完畢!!!"
        ChangePage('family')
    }else{
        document.getElementById("fill_alart").style.display = "none";
        document.getElementById("CIForm").submit();
    }
}
function checkbasic() { //基本資料
    var jumpflag = false

    var studentname = document.getElementById("student_name").value; //姓名
    var gender = document.querySelector('input[name="gender"]:checked'); //性別
    var birthdate = document.getElementById("age_datepicker").value; //生日
    var age = document.getElementById("child_age").value; //年齡

    var year = document.getElementById("year").value; //入學學年
    var semester = document.querySelector('input[name="semester"]:checked'); //入學學期
    var schoolname = document.getElementById("school_name").value; //學校
    var classname = document.getElementById("class_name").value; //班級
    var studentcode = document.getElementById("student_code").value; //座號

    var questname = document.getElementById("quest_name").value; //填寫人

    if (studentname == "") { //檢查學生姓名
        document.getElementById("q1").style.border = "3px solid #FF006F";
        jumpflag = true;
    } else
        document.getElementById("q1").style.border = "none";

    if (classname == "" || studentcode == "" || schoolname == "") { //檢查班級座號
        document.getElementById("q2").style.border = "3px solid #FF006F";
        jumpflag = true;
    } else
        document.getElementById("q2").style.border = "none";

    if (gender == null) { //檢查兒童性別
        document.getElementById("q3").style.border = "3px solid #FF006F";
        jumpflag = true;
    } else
        document.getElementById("q3").style.border = "none";

    if (birthdate == "" || age == "") { //檢查兒童生日、年齡
        document.getElementById("q4").style.border = "3px solid #FF006F";
        jumpflag = true;
    } else
        document.getElementById("q4").style.border = "none";

    if (year == "" || semester == null) { //檢查入學年度與學期
        document.getElementById("q5").style.border = "3px solid #FF006F";
        jumpflag = true;
    } else
        document.getElementById("q5").style.border = "none";

    if (questname == "") { //檢查量表填答人
        document.getElementById("q6").style.border = "3px solid #FF006F";
        jumpflag = true;
    } else
        document.getElementById("q6").style.border = "none";

    return jumpflag;
}
function checkdiagnosis(status) { //診斷資料
    var jumpflag = false

    if (status == "none") {
        return false;
    }
    var diagnosis = document.querySelector('input[name="diagnosis"]:checked'); //障礙類別
    var diagnosis_other = document.getElementById("diagnosis_other_content"); //障礙類別，其他 內容

    var degree = document.querySelector('input[name="degree"]:checked'); //障礙程度 (特殊生)
    var note = document.getElementById("note"); //補充說明 (疑似生)

    var identities = document.querySelectorAll('input[name="identities[]"]:checked'); //鑑定安置類別
    var proofs = document.querySelectorAll('input[name="proofs[]"]:checked'); //鑑定安置佐證
    var manual = document.querySelector('input[name="manual"]:checked'); //身障證明(手冊)
    var placement = document.querySelector('input[name="placement"]:checked'); //安置結果

    if (diagnosis) { //q7
        if (diagnosis.value == "other") { //q7 other context
            if (!diagnosis_other.value) {
                document.getElementById("q7").style.border = "3px solid #FF006F";
                jumpflag = true;
            } else {
                document.getElementById("q7").style.border = "none";
            }
        } else if (diagnosis.value == "發展遲緩") { //q7 發展遲緩 -> q10
            if (Boolean(identities.length !== 0)) { //q10
                document.getElementById("q10").style.border = "none";
            } else {
                document.getElementById("q10").style.border = "3px solid #FF006F";
                jumpflag = true;
            }
        } else {
            document.getElementById("q7").style.border = "none";
        }
    } else {
        document.getElementById("q7").style.border = "3px solid #FF006F";
        jumpflag = true;
    }

    if (status == "confirm") {
        //degree
        if (diagnosis.value != "other"){
            if (degree) {
                document.getElementById("q8").style.border = "none";
            } else {
                document.getElementById("q8").style.border = "3px solid #FF006F";
                jumpflag = true;
            }
        }
    }
    if (status == "suspected") {
        //note
        if (note.value) {
            document.getElementById("q9").style.border = "none";
        } else {
            document.getElementById("q9").style.border = "3px solid #FF006F";
            jumpflag = true;
        }
    }

    if (Boolean(proofs.length !== 0)) {
        document.getElementById("q11").style.border = "none";
        proofs.forEach((proof) => {
            if (proof.value == "不需填寫") {
                //don't need to check manual
                document.getElementById("q12").style.border = "none";
            }
            if (proof.value !== "不需填寫") {
                if (manual) {
                    document.getElementById("q12").style.border = "none";
                } else {
                    document.getElementById("q12").style.border = "3px solid #FF006F";
                    jumpflag = true;
                }
            }
        });
    } else {
        document.getElementById("q11").style.border = "3px solid #FF006F";
        jumpflag = true;
        if (manual) {
            document.getElementById("q12").style.border = "none";
        } else {
            document.getElementById("q12").style.border = "3px solid #FF006F";
        }
    }

    if (placement) {
        document.getElementById("q13").style.border = "none";
    } else {
        document.getElementById("q13").style.border = "3px solid #FF006F";
        jumpflag = true;
    }

    return jumpflag
}
function checkfamily() { //家庭資料
    var jumpflag = false

    var living = document.querySelectorAll('input[name="living[]"]:checked');
    var fstattend = document.querySelector('input[name="fst_attend"]:checked');

    if ( Boolean(living.length) == 0 || fstattend == null) {
        document.getElementById("q14").style.border = "3px solid #FF006F";
        jumpflag = true;
    } else
        document.getElementById("q14").style.border = "none";
    return jumpflag;
}