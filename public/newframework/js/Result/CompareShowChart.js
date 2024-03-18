$(document).ready(function () {
    initialchart();

    let totalfilltime = document.getElementById("totalfill").value;
    for(let i = 1; i <= totalfilltime; i++){
        let inputagename = "forage" + i;
        let inputallname = "forall" + i;
        let ForAge = document.getElementsByName(inputagename);
        let AllAge = document.getElementsByName(inputallname); 

        for( let j = 0; j < ForAge.length; j++){
            each_first_old_data.push(ForAge[j].value)
        }
        for( let j = 0; j < AllAge.length; j++){
            each_second_old_data.push(AllAge[j].value)
        }
        first_old_data.push(each_first_old_data);
        second_old_data.push(each_second_old_data);
        each_first_old_data = [];
        each_second_old_data = [];

        first_new_data.push([])
        second_new_data.push([])

        let labelname = "第" + i + "次填寫"
        let formatforfirst = { ...dataformat } // { ... }直接複製，防止dataformat資料更改，如果只使用 '=' 會變成引用
        let formatforsecond = { ...dataformat }
        // console.log(dataformat)
        formatforfirst.data = first_new_data[i-1];
        formatforfirst.label = labelname;
        firstdataformat.push(formatforfirst);
        
        formatforsecond.data = second_new_data[i-1];
        formatforsecond.label = labelname;
        seconddataformat.push(formatforsecond);
    }
    
});
function insert_data(id) {
    var num = document.getElementById(id);
    var label = num.closest("label")
    let AllTopic = document.getElementsByName("topic");
    const topicarray = []
    for (let k = 0; k < AllTopic.length; k++) {
        topicarray.push(AllTopic[k].value);
    }

    if (num.checked) { //確認勾選後，將完整資料集中勾選的該筆資料加入新資料
        label.classList.add("active");
        firstdataformat[id-1].data = first_old_data[id-1];
        seconddataformat[id-1].data = second_old_data[id-1];
    }
    if (!num.checked) { //取消勾選後，將新資料集中該筆勾選資料刪除
        label.classList.remove("active");
        firstdataformat[id-1].data = null;
        seconddataformat[id-1].data = null;
    }
    
    FirstChart.data = {
        labels: topicarray,
        datasets: firstdataformat
    } 
    SecondChart.data = {
        labels: topicarray,
        datasets: seconddataformat
    }
    FirstChart.update(); //更新
    SecondChart.update();
}
function initialchart() {
    const ctx = document.getElementById('FirstChart');
    const ctx2 = document.getElementById('SecondChart');

    let AllTopic = document.getElementsByName("topic");
    const topicarray = []
    for (let k = 0; k < AllTopic.length; k++) {
        topicarray.push(AllTopic[k].value);
    }
    const firstdata = {
        labels: topicarray,
        datasets: [{
            label: '',
            data: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
            fill: true,
            backgroundColor: 'rgba(255,255,255,0)',
            borderColor: 'rgba(255,255,255,0)',
            hidden: true
        }]
    };
    const fiestconfig = {
        type: 'line',
        data: firstdata,
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 25
                        }
                    }
                },
                title: {
                    display: true,
                    text: '符合年齡的精熟度',
                    padding: {
                        top: 10,
                        bottom: 30
                    },
                    font: {
                        size: 30
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        font: {
                            size: 18,
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 20,
                        }
                    }
                }
            }
        }
    };
    const seconddata = {
        labels: topicarray,
        datasets: [{
            label: '',
            data: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
            fill: true,
            backgroundColor: 'rgba(255,255,255,0)',
            borderColor: 'rgba(255,255,255,0)',
            hidden: true
        }]
    };
    const secondconfig = {
        type: 'line',
        data: seconddata,
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 25
                        }
                    }
                },
                title: {
                    display: true,
                    text: '作息整體的精熟度',
                    padding: {
                        top: 10,
                        bottom: 30
                    },
                    font: {
                        size: 30
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        font: {
                            size: 18,
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 20,
                        }
                    }
                }
            }
        }
    };

    FirstChart = new Chart(ctx, fiestconfig);
    SecondChart = new Chart(ctx2, secondconfig);
}
try {
    var fillbuttonElements = document.getElementsByName("fillbutton");
    fillbuttonElements.forEach(function (element) {
        element.addEventListener("click", function () {
            var number = this.getAttribute("data-filltime");
            insert_data(number);
        });
    });
} catch (e) { }
var FirstChart 
var SecondChart
var first_old_data = [];
var each_first_old_data = [];
var second_old_data = [];
var each_second_old_data = [];

var firstdataformat = [];
var seconddataformat = [];

var dataformat = {
    type: 'line',
    label: '',
    data: [],
    borderWidth: 1
}
var first_new_data = []; //勾選後修改資料(新資料集)
var second_new_data = []; //勾選後修改資料(新資料集)