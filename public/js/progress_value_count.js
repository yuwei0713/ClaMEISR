//progress init setting
function firstprogressbar() {
    var TopicQuantity = document.getElementById("CountOfTopic").value;
    for (var i = 1; i <= TopicQuantity; i++) {
        let tablename = "Topic" + i;
        var cells = document.getElementById(tablename).value; //progress all max
        var max = 0;
        var fill_count = 0; //value
        for (var j = 1; j <= cells; j++) {
            let option_name = "q" + i + "-" + j;
            if (!(document.getElementById(option_name).classList.contains("over_age"))) {
                var getSelectedValue = document.querySelector('input[name="' + option_name + '"]:checked');
                max++;
                if (getSelectedValue != null) {
                    fill_count++; //value count
                }
            }
        }
        let progressname = "progress" + i;
        let progresstextname = "progress_text" + i;
        document.getElementById(progressname).setAttribute("max", max);
        document.getElementById(progressname).setAttribute("value", fill_count);
        document.getElementById(progresstextname).innerHTML = "題數：" + fill_count + "/" + max;
        fill_count = 0;
        max = 0;
    }
}
//input radio listen
window.addEventListener('click', function () {
    let currenttable = document.getElementById("currenttalbe").value;
    let tablename = "Topic" + currenttable;
    var cells = document.getElementById(tablename).value;
    var fill_count = 0; //value
    var max = 0
    for (var j = 1; j <= cells; j++) {
        let option_name = "q" + currenttable + "-" + j;
        var getSelectedValue = document.querySelector('input[name="' + option_name + '"]:checked');
        if (!(document.getElementById(option_name).classList.contains("over_age"))) {
            max++;
            if (getSelectedValue != null) {
                fill_count++; //value count
            }
        }
    }
    let progressname = "progress" + currenttable;
    let progresstextname = "progress_text" + currenttable;
    document.getElementById(progressname).setAttribute("max", max);
    document.getElementById(progressname).setAttribute("value", fill_count);
    document.getElementById(progresstextname).innerHTML = "題數：" + fill_count + "/" + max;
});