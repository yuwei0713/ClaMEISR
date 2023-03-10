function checkoutput() {
    var status = document.querySelector('input[name="status"]:checked').value;
    //獲取幼兒身分 confirm,suspected,none

    var studentname = document.getElementById("student_name").value; //幼兒姓名
    var studentcode = document.getElementById("student_code").value; //幼兒座號
    var gender = document.querySelector('input[name="gender"]:checked');  //幼兒性別
    var birthdate = document.getElementById("age_datepicker").value; //幼兒生日

    var age = document.getElementById("child_age").value;
    var year = document.getElementById("year").value;
    var semester = document.querySelector('input[name="semester"]:checked'); //學期

    const currdate = new Date();
    let currday = currdate.getDate();
    let currmonth = currdate.getMonth() + 1;
    let curryear = currdate.getFullYear();
    var questdate = `${curryear}-${currmonth}-${currday}`;

    var schoolname = document.getElementById("school_name").value;
    var classname = document.getElementById("class_name").value;
    var questname = document.getElementById("quest_name").value;

    var identities;
    let identitiesvalues;
    var proofs;
    let proofsvalues;
    var manual;
    var diagnosis;
    var confirm_diagnosis_other;
    var suspected_diagnosis_other;
    var degree;
    var placement;
    var diagnosis_other_textarea;

    if (status == "confirm" || status == "suspected") {

        proofs = document.querySelectorAll('input[name="proofs[]"]:checked'); //鑑定安置佐證
        manual = document.querySelector('input[name="manual"]:checked'); //是否領有身障手冊
        try {
            diagnosis = document.querySelector('input[name="diagnosis"]:checked'); //診斷
            confirm_diagnosis_other = document.getElementById("diagnosis_other_content").value;
            suspected_diagnosis_other = document.getElementById("suspected_diagnosis_other_content").value;
            degree = document.querySelector('input[name="degree"]:checked'); //障礙程度
            if (diagnosis.value == "發展遲緩") {
                identities = document.querySelectorAll('input[name="identities[]"]:checked'); //鑑定安置類別
                identitiesvalues = [];
                identities.forEach((identities) => {
                    identitiesvalues.push(identities.value);
                });
            }
        } catch (e) { }
        placement = document.querySelector('input[name="placement"]:checked'); //安置結果


        proofsvalues = [];
        proofs.forEach((proofs) => {
            proofsvalues.push(proofs.value);
        });
    }

    var living = document.querySelectorAll('input[name="living[]"]:checked');
    let livingvalues = [];
    living.forEach((living) => {
        livingvalues.push(living.value);
    });
    var fstattend = document.querySelector('input[name="fst_attend"]:checked');


    var flag = 0
    if (studentname == "") { //檢查學生姓名
        document.getElementById("q1").style.border = "3px solid #FF006F";
        if (flag == 0) {
            document.location.hash = "#q1";
            flag = 1;
        }
    } else
        document.getElementById("q1").style.border = "none";

    if (classname == "" || studentcode == "") { //檢查班級座號
        document.getElementById("q2").style.border = "3px solid #FF006F";
        if (flag == 0) {
            document.location.hash = "#q2";
            flag = 1;
        }
    } else
        document.getElementById("q2").style.border = "none";

    if (gender == null) { //檢查兒童性別
        document.getElementById("q3").style.border = "3px solid #FF006F";
        if (flag == 0) {
            document.location.hash = "#q3";
            flag = 1;
        }
    } else
        document.getElementById("q3").style.border = "none";

    if (birthdate == "" || age == "") { //檢查兒童生日、年齡
        document.getElementById("q4").style.border = "3px solid #FF006F";
        if (flag == 0) {
            document.location.hash = "#q4";
            flag = 1;
        }
    } else
        document.getElementById("q4").style.border = "none";

    if (year == "" || semester == null) { //檢查入學年度與學期
        document.getElementById("q5").style.border = "3px solid #FF006F";
        if (flag == 0) {
            document.location.hash = "#q5";
            flag = 1;
        }
    } else
        document.getElementById("q5").style.border = "none";

    if (questname == "") { //檢查量表填答人
        document.getElementById("q6").style.border = "3px solid #FF006F";
        if (flag == 0) {
            document.location.hash = "#q6";
            flag = 1;
        }
    } else
        document.getElementById("q6").style.border = "none";

    if (status == "confirm") {
        if (proofsvalues.length == 0) {
            document.getElementById("q8").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#q8";
                flag = 1;
            }
        } else
            document.getElementById("q8").style.border = "none";

        if (manual == null) {
            document.getElementById("q9").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#q9";
                flag = 1;
            }
        } else {
            document.getElementById("q9").style.border = "none";
        }
        if (diagnosis == null || (diagnosis.value == "other" && confirm_diagnosis_other == "")) {
            document.getElementById("q10").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#q10";
                flag = 1;
            }
        } else {
            document.getElementById("q10").style.border = "none";
            if (degree == null && diagnosis.value != "other") {
                document.getElementById("q11").style.border = "3px solid #FF006F";
                if (flag == 0) {
                    document.location.hash = "#q11";
                    flag = 1;
                }
            } else {
                document.getElementById("q11").style.border = "none";
            }
            if(diagnosis.value == "發展遲緩"){
                if (identitiesvalues.length == 0) {
                    document.getElementById("q7").style.border = "3px solid #FF006F";
                    if (flag == 0) {
                        document.location.hash = "#q7";
                        flag = 1;
                    }
                } else {
                    document.getElementById("q7").style.border = "none";
                }
            }
        }
        if (placement == null) {
            document.getElementById("q12").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#q12";
                flag = 1;
            }
        } else {
            document.getElementById("q12").style.border = "none";
        }
    }

    if (status == "suspected") {
        if (proofsvalues.length == 0) {
            document.getElementById("sq8").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#sq8";
                flag = 1;
            }
        } else
            document.getElementById("sq8").style.border = "none";

        if (manual == null) {
            document.getElementById("sq9").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#sq9";
                flag = 1;
            }
        } else {
            document.getElementById("sq9").style.border = "none";
        }
        if (diagnosis == null || (diagnosis.value == "other" && suspected_diagnosis_other == "")) {
            document.getElementById("sq10").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#sq10";
                flag = 1;
            }
        } else {
            document.getElementById("sq10").style.border = "none";
            /*if (degree == null) {
                document.getElementById("sq11").style.border = "2px solid red";
                if (flag == 0) {
                    document.location.hash = "#sq11";
                    flag = 1;
                }
            } else {
                document.getElementById("sq11").style.border = "none";
            }*/
            if(diagnosis.value == "發展遲緩"){
                if (identitiesvalues.length == 0) {
                    document.getElementById("sq7").style.border = "3px solid #FF006F";
                    if (flag == 0) {
                        document.location.hash = "#sq7";
                        flag = 1;
                    }
                } else {
                    document.getElementById("sq7").style.border = "none";
                }
            }
        }
        if (placement == null) {
            document.getElementById("sq12").style.border = "3px solid #FF006F";
            if (flag == 0) {
                document.location.hash = "#sq12";
                flag = 1;
            }
        } else {
            document.getElementById("sq12").style.border = "none";
        }
    }

    if (livingvalues.length == 0 || fstattend == null) {
        document.getElementById("q14").style.border = "3px solid #FF006F";
        if (flag == 0) {
            document.location.hash = "#q14";
            flag = 1;
        }
    } else
        document.getElementById("q14").style.border = "none";

    if (flag == 1)
        document.getElementById("fill_alart").textContent = "資料尚未填寫完畢!!!"
    else {
        document.getElementById("fill_alart").style.display = "none";
        document.getElementById("CIForm").submit();
    }
}
$(document).ready(function () {
    var status = document.querySelector('input[name="status"]:checked').value;
    $('input[name="status"]').click(function () {
        if ($(this).attr("value") == "confirm") {
            $("#status-confirm").css("display", "block");
            $("#status-suspected").css("display", "none");
        } else if ($(this).attr("value") == "suspected") {
            $("#status-confirm").css("display", "none");
            $("#status-suspected").css("display", "block");
        }
        else if ($(this).attr("value") == "none") {
            $("#status-confirm").css("display", "none");
            $("#status-suspected").css("display", "none");
        }
    });
    $('input[name="status"]').click(function () {
        if ($(this).attr("value") != status) {
            //更新頁面
            //基本資料 上
            document.getElementById("q1").style.border = "none";
            document.getElementById("q2").style.border = "none";
            document.getElementById("q3").style.border = "none";
            document.getElementById("q4").style.border = "none";
            document.getElementById("q5").style.border = "none";
            document.getElementById("q6").style.border = "none";
            //特殊生資料
            document.getElementById("q7").style.border = "none";
            document.getElementById("q8").style.border = "none";
            document.getElementById("q9").style.border = "none";
            document.getElementById("q10").style.border = "none";
            document.getElementById("q11").style.border = "none";
            document.getElementById("q12").style.border = "none";

            document.getElementById("sq7").style.border = "none";
            document.getElementById("sq8").style.border = "none";
            document.getElementById("sq9").style.border = "none";
            document.getElementById("sq10").style.border = "none";
            //document.getElementById("sq11").style.border = "none";
            document.getElementById("sq12").style.border = "none";
            document.getElementById("sq13").style.border = "none";


            document.getElementById("q14").style.border = "none";
            document.getElementById("fill_alart").style.display = "none";

            $(".diagnosis_option").css("display", "none");
            $(".manual_option").css("display", "none");
            $('input[name="degree"]:checked').attr("checked", false);
            $('input[name="diagnosis"]:checked').attr("checked", false);
            $('input[name="manual"]:checked').attr("checked", false);
            $('input[name="placement"]:checked').attr("checked", false);
            $('input[name="identities[]"]:checked').prop('checked', false);
            $('input[name="proofs[]"]:checked').prop('checked', false);
            document.getElementById("note").value = "";
            status = $(this).attr("value");
        }
    });

    $('input[name="fst_attend"]').click(function () {
        if ($(this).attr("value") == "other") {
            $("#other_fst_attend").css("display", "block");
        } else {
            $("#other_fst_attend").css("display", "none");
            $("#fst_attend_other_content").val("");
        }
    });
    $('input[name="sec_attend"]').click(function () {
        if ($(this).attr("value") == "other") {
            $("#other_sec_attend").css("display", "block")
        } else {
            $("#other_sec_attend").css("display", "none")
            $("#sec_attend_other_content").val("");
        }
    });
    $('input[name="diagnosis"]').click(function () {
        if ($(this).attr("value") == "other") {
            $(".diagnosis_option").css("display", "none");
            $(".manual_option").css("display", "none");
            if(status == "confirm"){
                $("#other_diagnosis").css("display", "block");
            }
            if(status == "suspected"){
                $("#suspected_other_diagnosis").css("display", "block");
            }
            $('input[name="degree"]:checked').attr("checked", false);
            $('input[name="identities[]"]:checked').prop('checked', false);
        } else {
            $("#other_diagnosis").css("display", "none");
            $("#suspected_other_diagnosis").css("display", "none");
            $("#diagnosis_other_content").val("");
            $("#suspected_diagnosis_other_content").val("");
            $(".manual_option").css("display", "block");
            if ($(this).attr("value") == "發展遲緩") {
                $(".diagnosis_option").css("display", "block");
            } else {
                $('input[name="identities[]"]:checked').prop('checked', false);
                $(".diagnosis_option").css("display", "none");
            }
        }
    });
});
function living_other() {
    const ifclick = document.getElementById('other_living');
    const text = document.getElementById('living_other_content');
    if (ifclick.style.display === 'none' || ifclick.style.display === '') {
        ifclick.style.display = 'block';

    } else {
        ifclick.style.display = 'none';
        if (text.value != null) {
            text.value = "";
        }
    }
}