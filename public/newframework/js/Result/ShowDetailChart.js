$(document).ready(function () {
    const funcctx = document.getElementById('FuncChart');
    const devctx = document.getElementById('DevChart');
    const outctx = document.getElementById('OutChart');

    const functopicarray = []
    const funcforagearray = []
    const funcallagearray = []

    const devtopicarray = []
    const devforagearray = []
    const devallagearray = []

    const outtopicarray = []
    const outforagearray = []
    const outallagearray = []

    let funcAllTopic = document.getElementsByName("functopic");
    let funcForAge = document.getElementsByName("funcforagedata");
    let funcAllAge = document.getElementsByName("funcforalldata");

    let devAllTopic = document.getElementsByName("devtopic");
    let devForAge = document.getElementsByName("devforagedata");
    let devAllAge = document.getElementsByName("devforalldata");

    let outAllTopic = document.getElementsByName("outtopic");
    let outForAge = document.getElementsByName("outforagedata");
    let outAllAge = document.getElementsByName("outforalldata");

    for (let k = 0; k < funcAllTopic.length; k++) {
        functopicarray.push(funcAllTopic[k].value);
    }
    for (let k = 0; k < funcForAge.length; k++) {
        funcforagearray.push(funcForAge[k].value);
    }
    for (let k = 0; k < funcAllAge.length; k++) {
        funcallagearray.push(funcAllAge[k].value);
    }

    for (let k = 0; k < devAllTopic.length; k++) {
        devtopicarray.push(devAllTopic[k].value);
    }
    for (let k = 0; k < devForAge.length; k++) {
        devforagearray.push(devForAge[k].value);
    }
    for (let k = 0; k < devAllAge.length; k++) {
        devallagearray.push(devAllAge[k].value);
    }

    for (let k = 0; k < outAllTopic.length; k++) {
        outtopicarray.push(outAllTopic[k].value);
    }
    for (let k = 0; k < outForAge.length; k++) {
        outforagearray.push(outForAge[k].value);
    }
    for (let k = 0; k < outAllAge.length; k++) {
        outallagearray.push(outAllAge[k].value);
    }

    const funcdata = {
        labels: functopicarray,
        datasets: [{
            label: '符合年齡的精熟度',
            data: funcforagearray,
            fill: true,
        }, {
            label: '作息整體精熟度',
            data: funcallagearray,
            fill: true,
        }]
    };
    const funcconfig = {
        type: 'radar',
        data: funcdata,
        options: {
            scales: {
                r: {
                    min: 0,
                    max: 100,
                    pointLabels: {
                        font: {
                            size: 16
                        }
                    }
                }
            },
            animation: false,
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 18
                        }
                    }
                }
            },
            responsive: true, // 设置图表为响应式，根据屏幕窗口变化而变化
            maintainAspectRatio: false, // 保持图表原有比例
            elements: {
                line: {
                    borderWidth: 3 // 设置线条宽度
                }
            }
        }
    };

    const devdata = {
        labels: devtopicarray,
        datasets: [{
            label: '符合年齡的精熟度',
            data: devforagearray,
            fill: true,
        }, {
            label: '作息整體精熟度',
            data: devallagearray,
            fill: true,
        }]
    };
    const devconfig = {
        type: 'radar',
        data: devdata,
        options: {
            scales: {
                r: {
                    min: 0,
                    max: 100,
                    pointLabels: {
                        font: {
                            size: 16
                        }
                    }
                }
            },
            animation: false,
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 18
                        }
                    }
                }
            },
            responsive: true, // 设置图表为响应式，根据屏幕窗口变化而变化
            maintainAspectRatio: false, // 保持图表原有比例
            elements: {
                line: {
                    borderWidth: 3 // 设置线条宽度
                }
            }
        }
    };

    const outdata = {
        labels: outtopicarray,
        datasets: [{
            label: '符合年齡的精熟度',
            data: outforagearray,
            fill: true,
        }, {
            label: '作息整體精熟度',
            data: outallagearray,
            fill: true,
        }]
    };
    const outconfig = {
        type: 'radar',
        data: outdata,
        options: {
            scales: {
                r: {
                    min: 0,
                    max: 100,
                    pointLabels: {
                        font: {
                            size: 16
                        }
                    }
                }
            },
            animation: false,
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 18
                        }
                    }
                }
            },
            responsive: true, // 设置图表为响应式，根据屏幕窗口变化而变化
            maintainAspectRatio: false, // 保持图表原有比例
            elements: {
                line: {
                    borderWidth: 3 // 设置线条宽度
                }
            }
        }
    };

    new Chart(funcctx, funcconfig);
    new Chart(devctx, devconfig);
    new Chart(outctx, outconfig);
})