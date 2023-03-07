function checkoutput(flag) {
    if (flag == 0) {
        document.getElementById("NextOrFinal").value = flag;
        document.getElementById("fill_alart").style.display = "none";
        document.getElementById("MeiserForm").submit();
    }
    else if (flag == 1) {
        document.getElementById("NextOrFinal").value = flag;
        var TopicQuantity = document.getElementById("CountOfTopic").value;
        var finalcheck = 0;
        var jump_count = 0;
        for (var i = 1; i <= TopicQuantity; i++) {
            let tablename = "Topic" + i;
            var cells = document.getElementById(tablename).value;
            var fill_count = 0;
            for (var j = 1; j < cells; j++) {
                let option_name = "q"+ i + "-" + j;
                var getSelectedValue = document.querySelector('input[name="' + option_name + '"]:checked');
                if (getSelectedValue == null) {
                    if (document.getElementById(option_name).classList.contains("over_age")) {
                        fill_count++;
                    } else {
                        document.getElementById(option_name).style.border = "3px solid #FF006F";
                        if (jump_count == 0) {
                            changeshow(i);
                            document.location.hash = "#" + option_name;
                            jump_count = 1;
                        }
                    }
                    document.getElementById("fill_alart").textContent = "問卷尚未填寫完畢!!!"
                }
                else {
                    document.getElementById(option_name).style.border = "none";
                    fill_count++;
                }
            }
            if (fill_count == (cells - 1)) {
                finalcheck++;
            }
        }
        if (finalcheck == TopicQuantity) {
            document.getElementById("fill_alart").style.display = "none";
            document.getElementById("MeiserForm").submit();
        }
    }
}