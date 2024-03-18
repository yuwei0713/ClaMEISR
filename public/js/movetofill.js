function movetounfill(){
    var TopicQuantity = document.getElementById("CountOfTopic").value;
    var finish_flag = 0;
    for (var i = 1; i <= TopicQuantity; i++) {
        let tablename = "Topic" + i;
        var cells = document.getElementById(tablename).value;
        for (var j = 1; j <= cells; j++) {
            let option_name = "q" + i + "-" + j;
            if (!(document.getElementById(option_name).classList.contains("over_age"))) {
                var getSelectedValue = document.querySelector('input[name="' + option_name + '"]:checked');
                if (getSelectedValue == null) {
                    if (finish_flag == 0) {
                        changeshow(i);
                        document.getElementById(option_name).classList.add("notfillyet");
                        document.location.hash = "#" + option_name; //jump
                        finish_flag = 1;
                    }
                }
            }
        }
    }
}
$(".rTableRow").click(function(){
    var divID = this.id;
    document.getElementById(divID).classList.remove("notfillyet");
    document.getElementById(divID).classList.remove("shouldfill");
});
try{
    document.getElementById("movetofill").addEventListener('click', function(){
        movetounfill();
    });
}catch(e){}