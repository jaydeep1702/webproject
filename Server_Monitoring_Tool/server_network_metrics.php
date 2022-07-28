<html>

<head>

    <link rel="stylesheet" href="CSS/server_network_metrics.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

</head>

<body>

    <div id="homePage">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid" id="nav">

                <img src="Images/Monnit_Tool_Logo.png" id="navLogo" width="140px" height="50px">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <b><a class="nav-link active" aria-current="page" href="index.php">Home</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">Link</a></b>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="form">

            <form>
                <h2> <b> Enter IP Address or Domain Name</b></h2>
                <input type="text" name="IP_or_Domain" id="IP_or_Domain"><br><br>
                <button type="submit" onClick="fetchAndDisplayData()" class="btn btn-primary"><b>Fetch Details</b></button>
            </form>

        </div>

        <div id="dashboard">
            <h2><b>Server Network Metrics</b></h2>
            <hr>

            <div id="graphs">

                <div class="card">
                    <div class="alert" id="min_max_latency_time_alert">
                        <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>High Latency Time.<a href="#" class="alert-link" style="text-decoration: none; color: black;"> Know More..</a>
                    </div>

                    <h5 class="card-text my-3">Latency Time</h5>
                    <canvas id="latency_time_min_max_average"></canvas>
                </div>

                <div class="card">
                    <div class="alert" id="overall_latency_time_alert">
                        <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>High Average Latency Time. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                    </div>

                    <h5 class="card-text my-3">Latency Time</h5>
                    <canvas id="latency_time_overall"></canvas>
                </div>

                <div class="card">
                    <div class="alert" id="data_packet_loss_alert">
                        <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>More No. of Data Packets are Getting Lost. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                    </div>

                    <h5 class="card-text my-3 ">Data Packet Transfer Info</h5>
                    <canvas id="packet_send_received" style="display: block; max-height: 220px; max-width: 220px;"></canvas>
                </div>

                <div class="card" id="min_max_latency_time_alert">
                    <h5 class="card-text my-3">Route Delay</h5>
                    <canvas id="route_delay" `></canvas>
                </div>

            </div>

            <button class="btn btn-primary" id="recheck" onclick="window.location.reload();" value="Recheck"><b>Recheck</b></button>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    </div>

    <script>
        // function fetchAndDisplayData() {

            <?php
            $name = $_GET["IP_or_Domain"];
            $st = shell_exec("ping  -n 10 " . $name);

            $patternerror = "/Request timed out/i";
            $snew = preg_replace($patternerror, 'time=0ms', $st);

            $pattern = "/time=\d+|Sent = \d+| Received = \d+|Lost = \d+|Minimum = \d+|Maximum = \d+|Average = \d+/i";

            if (preg_match_all($pattern, $snew, $matches)) {
            }


            $timestr = $matches[0][0] . $matches[0][1] . $matches[0][2] . $matches[0][3] . $matches[0][4] . $matches[0][5] . $matches[0][6] . $matches[0][7] . $matches[0][8] . $matches[0][9] . $matches[0][10] . $matches[0][11] . $matches[0][12] . $matches[0][13] . $matches[0][14] . $matches[0][15];    //array string pass to next sorting no pattern
            $patern1 = '!\d+!';

            if (preg_match_all($patern1, $timestr, $match1)) {
                $val = $match1[0][0];         //latency value 
                $val1 = $match1[0][1];
                $val2 = $match1[0][2];
                $val3 = $match1[0][3];
                $val4 = $match1[0][4];
                $val5 = $match1[0][5];
                $val6 = $match1[0][4];
                $val7 = $match1[0][7];
                $val8 = $match1[0][8];
                $val9 = $match1[0][9];         //latency value 
                $sent = $match1[0][10];        //sent packet
                $received = $match1[0][11];    //rec packet
                $lost = $match1[0][12];        //lost packet
                $minimum = $match1[0][13];     //minimum latency
                $maximum = $match1[0][14];     //maximum
                $average = $match1[0][15];     //average
            }

            $s = shell_exec(" tracert -h 5 ". $name);

            $pattern1 = "/\*/i";
            $snew = preg_replace($pattern1, '0 ms', $s);
            $pattern2 = "/\d+ ms/i";

            if (preg_match_all($pattern2, $snew, $matches)) {
            }

            $newstring = $matches[0][0] . $matches[0][1] . $matches[0][2] . $matches[0][3] . $matches[0][4] . $matches[0][5] . $matches[0][6] . $matches[0][7] . $matches[0][8] . $matches[0][9] . $matches[0][10] . $matches[0][11] . $matches[0][12] . $matches[0][13] . $matches[0][14];
            $pattern3 = "/\d+/i";

            if (preg_match_all($pattern3, $newstring, $matches2)) {
                $r11 = $matches2[0][0];
                $r12 = $matches2[0][3];
                $r13 = $matches2[0][6];
                $r14 = $matches2[0][9];
                $r15 = $matches2[0][12];
                $r21 = $matches2[0][1];
                $r22 = $matches2[0][4];
                $r23 = $matches2[0][7];
                $r24 = $matches2[0][10];
                $r25 = $matches2[0][13];
                $r31 = $matches2[0][2];
                $r32 = $matches2[0][5];
                $r33 = $matches2[0][8];
                $r34 = $matches2[0][11];
                $r35 = $matches2[0][14];
            }

            ?>

            var xValues = ["Minimum", "Maximum", "Average"];
            var yValues = [<?= $minimum ?>, <?= $maximum ?>, <?= $average ?>];
            var barColors = ["green", "red", "blue"];
            var zvalues = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];

            var elem = document.getElementById('min_max_latency_time_alert');

            if (<?= $maximum ?> > 90) {
                elem.style.display = "block";
            } else {
                elem.style.display = 'none';
            }


            new Chart("latency_time_min_max_average", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {

                    beginAtZero: true,


                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                    }
                },

                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'value'
                        }
                    }
                }
            });


            // Latency Chart Overall

            var elem = document.getElementById('overall_latency_time_alert');
            var avg_latency_time = (<?= $val ?> + <?= $val1 ?> + <?= $val2 ?> + <?= $val3 ?> + <?= $val4 ?> + <?= $val5 ?> + <?= $val6 ?> + <?= $val7 ?> + <?= $val8 ?> + <?= $val9 ?>) / 10;

            if (avg_latency_time > 75) {
                elem.style.display = "block";
            } else {
                elem.style.display = 'none';
            }
            new Chart("latency_time_overall", {
                type: "line",
                data: {
                    labels: zvalues,
                    datasets: [{
                        data: [<?= $val ?>, <?= $val1 ?>, <?= $val2 ?>, <?= $val3 ?>, <?= $val4 ?>, <?= $val5 ?>, <?= $val6 ?>, <?= $val7 ?>, <?= $val8 ?>, <?= $val9 ?>],
                        borderColor: "green",
                        fill: false
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                    }
                }
            });

            var aValues = ["Sent Packets", "Received Packets", "Loss Packets"];
            var bValues = [<?= $sent ?>, <?= $received ?>, <?= $lost ?>];
            var barColors = [
                "#0e1bab",
                "#04bf04",
                "#bf1704"
            ];

            var elem = document.getElementById('data_packet_loss_alert');

            if (<?= $lost ?> > <?= $received ?>) {
                elem.style.display = "block";
            } else {
                elem.style.display = 'none';
            }

            new Chart("packet_send_received", {
                type: "doughnut",
                data: {
                    labels: aValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: bValues
                    }]
                },
                options: {
                    title: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'value'
                        }
                    }
                }
            });

            var xValues = ["Hop 1", "Hop 2", "Hop 3", "Hop 4", "Hop 5"];

            new Chart("route_delay", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        label: "Route1",
                        data: [<?= $r11 ?>, <?= $r12 ?>, <?= $r13 ?>, <?= $r14 ?>, <?= $r15 ?>],
                        borderColor: "red",
                        fill: false
                    }, {
                        label: "Route2",
                        data: [<?= $r21 ?>, <?= $r22 ?>, <?= $r23 ?>, <?= $r24 ?>, <?= $r25 ?>],
                        borderColor: "green",
                        fill: false
                    }, {
                        label: "Route3",
                        data: [<?= $r31 ?>, <?= $r32 ?>, <?= $r33 ?>, <?= $r34 ?>, <?= $r35 ?>],
                        borderColor: "blue",
                        fill: false
                    }]
                },

                options: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: false,
                    }
                },

                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'value'
                        }
                    }
                }

            });
        // }
    </script>

</body>

</html>