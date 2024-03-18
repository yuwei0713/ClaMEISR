$(document).ready(function() {
    const ctx = document.getElementById('myChart');
    const topicarray = []
    const foragearray = []
    const allagearray = []
    let AllTopic =document.getElementsByName("topic");
    let ForAge =document.getElementsByName("foragedata");
    let AllAge =document.getElementsByName("foralldata");
    for (let k = 0; k < AllTopic.length; k++) {
        topicarray.push(AllTopic[k].value);
    }
    for (let k = 0; k < ForAge.length; k++) {
        foragearray.push(ForAge[k].value);
    }
    for (let k = 0; k < AllAge.length; k++) {
        allagearray.push(AllAge[k].value);
    }
    new Chart(ctx, {
        data: {
            labels: topicarray,
            datasets: [{
                type: 'line',
                label: '符合年齡的精熟度',

                data: foragearray,
                borderWidth: 1
            }, {
                type: 'line',
                label: '作息整體的精熟度',
                data: allagearray
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 25
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
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
    });
})