var worker
function startcount() {
    if (typeof (Worker) !== "undefined") {
        if (typeof (worker) == "undefined") {
            worker = new Worker('../js/countdown.js')
            var timer = document.getElementById('countdowntime');
            var counttime = 1200;
            worker.postMessage(counttime);

            worker.onmessage = function (event) {
                var dur = event.data;
                if(dur <= 0){
                    alert("您已閒置過久，請重新登入");
                    window.location.href = "/logout";
                }
                var min = Math.floor(dur / 60);
                var sec = parseInt(dur - (min * 60));
                if (min > 0) {
                    counttime = String(min) + "分 " + String(sec) + "秒";
                } else {
                    counttime = String(sec) + "秒";
                }
                timer.innerHTML = counttime;
            }
        }
    }
}
function stopWorker() {
    worker.terminate();
    worker = undefined;
}
['mousemove', 'click','touchmove' ,'keydown' ,'touchstart'].forEach(function (e) {
    window.addEventListener(e, function (event) {
        document.getElementById('countdowntime').innerHTML = "20分 0秒";
        stopWorker();
        startcount();
    });
});
startcount();
document.getElementById('countdowntime').innerHTML = "20分 0秒";

