function firstcountgrade(){
    var TopicQuantity = document.getElementById("CountOfTopic").value;
    for (var i = 1; i <= TopicQuantity; i++) {
        let tablename = "Topic" + i;
        var cells = document.getElementById(tablename).value; //progress all max
        var inage_max = 0; //符合年齡題數
        var allage_max = 0; //所有題數
        var inage_pass = 0; //符合年齡中評分為3
        var allage_pass = 0; //所有題數中評分為3
        for (var j = 1; j <= cells; j++) {
            let option_name = "q" + i + "-" + j;
            //檢查有無填寫
            var getSelectedValue = document.querySelector('input[name="' + option_name + '"]:checked');
            if (getSelectedValue != null) {
                let gradevalue = getSelectedValue.value;
                var grade = parseInt(gradevalue.slice(-1));
                allage_max++;
                if (document.getElementById(option_name).classList.contains("over_age")) {
                    //超過年齡
                    if(grade == 3){
                        allage_pass++;
                    }
                }else{
                    //符合年齡
                    inage_max++;
                    if(grade == 3){
                        inage_pass++;
                        allage_pass++;
                    }
                }
            }
        }
        //計算
        let Aone = "countgradeA1-" + i; //根據年齡評分3以上
        let Atwo = "countgradeA2-" + i; //所有評分3以上
        let Bone = "countgradeB1-" + i; //根據年齡填寫數
        let Btwo = "countgradeB2-" + i; //根據年齡百分比
        let Cone = "countgradeC1-" + i; //所有填寫數
        let Ctwo = "countgradeC2-" + i; //所有百分比

        document.getElementById(Aone).innerHTML = inage_pass;
        document.getElementById(Atwo).innerHTML = allage_pass;
        document.getElementById(Bone).innerHTML = inage_max;
        document.getElementById(Cone).innerHTML = allage_max;
        if(inage_max == 0 || allage_max == 0){
            document.getElementById(Btwo).innerHTML = "0%";
            document.getElementById(Ctwo).innerHTML = "0%";
        }else{
            document.getElementById(Btwo).innerHTML = (Math.round((inage_pass/inage_max) * 10000) / 100) + "%";
            document.getElementById(Ctwo).innerHTML = (Math.round((allage_pass/allage_max) * 10000) / 100) + "%";
        }
        

        //清空
        inage_max = 0;
        allage_max = 0;
        inage_pass = 0;
        allage_pass = 0;
    }
};
window.addEventListener('click' ,function(){
    let currenttable = document.getElementById("currenttalbe").value;
    let tablename = "Topic" + currenttable;
    var cells = document.getElementById(tablename).value;

    var inage_max = 0; //符合年齡題數
        var allage_max = 0; //所有題數
        var inage_pass = 0; //符合年齡中評分為3
        var allage_pass = 0; //所有題數中評分為3
        for (var j = 1; j <= cells; j++) {
            let option_name = "q" + currenttable + "-" + j;
            //檢查有無填寫
            var getSelectedValue = document.querySelector('input[name="' + option_name + '"]:checked');
            if (getSelectedValue != null) {
                let gradevalue = getSelectedValue.value;
                var grade = parseInt(gradevalue.slice(-1));
                allage_max++;
                if (document.getElementById(option_name).classList.contains("over_age")) {
                    //超過年齡
                    if(grade == 3){
                        allage_pass++;
                    }
                }else{
                    //符合年齡
                    inage_max++;
                    if(grade == 3){
                        inage_pass++;
                        allage_pass++;
                    }
                }
            }
        }
        //計算
        let Aone = "countgradeA1-" + currenttable; //根據年齡評分3以上
        let Atwo = "countgradeA2-" + currenttable; //所有評分3以上
        let Bone = "countgradeB1-" + currenttable; //根據年齡填寫數
        let Btwo = "countgradeB2-" + currenttable; //根據年齡百分比
        let Cone = "countgradeC1-" + currenttable; //所有填寫數
        let Ctwo = "countgradeC2-" + currenttable; //所有百分比

        document.getElementById(Aone).innerHTML = inage_pass;
        document.getElementById(Atwo).innerHTML = allage_pass;
        document.getElementById(Bone).innerHTML = inage_max;
        document.getElementById(Cone).innerHTML = allage_max;
        if(inage_max == 0 || allage_max == 0){
            document.getElementById(Btwo).innerHTML = "0%";
            document.getElementById(Ctwo).innerHTML = "0%";
        }else{
            document.getElementById(Btwo).innerHTML = (Math.round((inage_pass/inage_max) * 10000) / 100) + "%";
            document.getElementById(Ctwo).innerHTML = (Math.round((allage_pass/allage_max) * 10000) / 100) + "%";
        }
});