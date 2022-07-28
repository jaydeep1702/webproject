// // Past Data Monitoring
// CPU Utilization Line Graph

function plotGraphs(CpuUtilization, Memory_Used, Disk_Storage, Time) {
    var xValues = Time;

    new Chart("cpu_utilization_history", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                data: CpuUtilization,
                borderColor: "green",
                fill: true
            }]
        },
        options: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                }
            },
            y: {
                title: {
                    display: true,
                    text: "CPU Utilization (%)"
                }
            }
        }
    });

    // Memory Used Line Graph

    new Chart("memory_used_history", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                data: Memory_Used,
                borderColor: "blue",
                fill: true
            }]
        },
        options: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Memory Used (MB)'
                }
            }
        }
    });

    // Disk Storage Line Graph

    new Chart("disk_storage_history", {
        type: "line",
        data: {
            datasets: [{
                data: Disk_Storage,
                borderColor: "red",
                fill: true,
            }]
        },
        options: {
            legend: {
                display: false,
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Time'
                }
            },
            xAxes: [{
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time'
                }
            }]
        }
    });
}