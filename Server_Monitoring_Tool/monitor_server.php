<?php

require "_Database_Connection.php";
require "Monitor_Current_Data.php";
require "Fetch_Local_Server_Data.php";

?>

<html>

<head>

    <link rel="stylesheet" href="CSS/monitor_server.css">
    <script src="JavaScript/Past_Data_Monitoring_Graphs.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
                    <button type="submit" id="errorLog" onclick="MoveToLogs()"><b>Show Error Logs</b></button>
                </div>
            </div>
        </nav>

        <div id="dashboard">
            <h2><b>Server Metrics</b></h2>
            <hr>

            <div id="graphs">

                <div class="heading" id="currentDataGraphs">Monitor Current Data</div>
                <hr style="margin: 20px auto; width: 80%">
                <div id="Current_Usage" onfocus="refreshPage()">

                    <div class="card">
                        <div class="alert" id="ram_alert">
                            <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>Memory OverUsed. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                        </div>

                        <h5 class="card-text my-3">RAM Usage</h5>
                        <canvas id="RAMusage"></canvas>
                    </div>

                    <div class="card">
                        <div class="alert" id="disk_storage_alert">
                            <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong> Storage Almost Full. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                        </div>

                        <h5 class="card-text my-3">Disk Storage</h5>
                        <canvas id="diskStorage"></canvas>
                    </div>


                    <div class="card">
                        <div class="alert" id="cpu_utilization_alert">
                            <strong><i class="material-icons" style="font-size:24px;"></i>Warning!</strong>Very High CPU Utilization. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                        </div>

                        <h5 class="card-text my-3">CPU Utilization</h5>
                        <canvas id="cpuUtilization"></canvas>
                    </div>

                    <div class="card">
                        <h5 class="card-text my-3">CPU Information</h5>

                        <div id="">
                        <?php
                          

                        $cpuname = shell_exec("wmic cpu get name /value");
                        echo $cpuname . "<br>";

                        $cpuvolt = shell_exec("wmic cpu get currentvoltage /value");
                        echo $cpuvolt . "<br>";

                        $cpumaxclockspeed = shell_exec("wmic cpu get maxclockspeed /value ");
                        echo $cpumaxclockspeed . "<br>";

                        $cpucurrentclckspeed = shell_exec("wmic cpu get currentclockspeed /value");
                        echo $cpucurrentclckspeed . "<br>";

                        $cpucores = shell_exec("wmic cpu get numberofcores /value");
                        echo $cpucores . "<br>";
                   
                            
                        ?>
                        </div>

                    </div>

                </div>

                <hr>
                <div class="heading">Monitor Past Data</div>
                <hr style="margin: auto; width: 80%">

                <div id="select_duration">

                    

                        Select Duration :

                        <button type="buttton" onClick="fetchPastOneHourData()" class="btn btn-primary"><b>Past 1 Hour</b></button>
                        <button type="button" onClick="fetchPastOneDayData()" class="btn btn-primary"><b>Past 1 Day</b></button>
                        <button type="buttton" onClick="fetchPastFiveDayData()" class="btn btn-primary"><b>Past 5 Day's</b></button>
                        <button type="buttton" onClick="fetchPastOneMonthData()" class="btn btn-primary"><b>Past 1 Month</b></button>

                    
                </div>

                <hr>
                <div id="Past_Data_Monitoring">

                    <div class="card">
                        <h5 class="card-text my-3">CPU Utilization</h5>
                        <canvas id="cpu_utilization_history"></canvas>
                    </div>


                    <div class="card">
                        <h5 class="card-text my-3">RAM Usage</h5>
                        <canvas id="memory_used_history"></canvas>
                    </div>

                    <div class="card">
                        <h5 class="card-text my-3">Disk Storage</h5>
                        <canvas id="disk_storage_history"></canvas>
                    </div>

                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    </div>

    <!-- JavaScript Code for Current Data Monitoring -->
    <script>
        
        
     // Current Data Monitoring
        // RAM Usage Pie Chart 
        var xValues = ["Free Space(In MB)", "Used Space(In MB)"];
        var yValues = [<?= $freeSpace ?>, <?= $usedSpace ?>];

        var elem = document.getElementById('ram_alert');
        var usedSpace = <?= $usedSpace ?>;

        if (<?= $usedSpace ?> > 0.5 * <?= $totalSpace ?>) {
            elem.style.display = "block";
        } else {
            elem.style.display = 'none';
        }

        var barColors = [
            "#48F706",
            "#F72D02"
        ];

        new Chart("RAMusage", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: false,
                }
            }
        });

        // Disk Storage Pie Chart
        var xValues = ["Used Storage (In GB)", "Available Storage (In GB)"];
        var yValues = [<?= $usedStorage ?>, <?= $availableStorage ?>];
        var barColors = ["#b91d47", "#00aba9"];

        var elem = document.getElementById('disk_storage_alert');
        var usedStorage = <?= $usedStorage ?>;

        if (<?= $usedStorage ?> > 0.1 * <?= $TotalStorage ?>) {
            elem.style.display = "block";
        } else {
            elem.style.display = 'none';
        }

        new Chart("diskStorage", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: false,
                }
            }
        });

        // CPU Utilization - Current Data
        var xValues = ["<?= $t1 ?>", "<?= $t2 ?>", "<?= $t3 ?>", "<?= $t4 ?>", "<?= $t5 ?>"];

        var elem = document.getElementById('cpu_utilization_alert');

        $CpuUtilAvg = (<?= $CpuUtilVal1 ?> + <?= $CpuUtilVal2 ?> + <?= $CpuUtilVal3 ?> + <?= $CpuUtilVal4 ?> + <?= $CpuUtilVal5 ?>) / 5;

        if ($CpuUtilAvg > 1) {
            elem.style.display = "block";
        } else {
            elem.style.display = "none";
        }

        new Chart("cpuUtilization", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [<?= $CpuUtilVal1 ?>, <?= $CpuUtilVal2 ?>, <?= $CpuUtilVal3 ?>, <?= $CpuUtilVal4 ?>, <?= $CpuUtilVal5 ?>],
                    borderColor: "red",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Data'

                    }
                }]
            }
        });
    </script>

    <!-- JavaScript Code for Plotting Past Data Graph -->
    <script>
        function MoveToLogs() {
            window.location = "Error_Logs.php";
        }

        function fetchPastOneHourData() {

            <?php

            date_default_timezone_set("Asia/Kolkata");
            $currentTime = time();
            $OneHourBefore = $currentTime - 3600;

            $queryingTime = date("Y-m-d H:i:s", $OneHourBefore);

            $query = "select * from local_server_data where time>'$queryingTime'";
            $result = fetch_local_server_data($query);

            $CpuUtilization = $result[0];
            $Memory_Used = $result[1];
            $Disk_Storage = $result[2];
            $Time = $result[3];
            $TotalDays = $result[4];
            $Date = $result[5];

            ?>

            plotGraphs(<?= json_encode(array_values($CpuUtilization)); ?>, <?= json_encode(array_values($Memory_Used)); ?>, <?= json_encode(array_values($Disk_Storage)); ?>, <?= json_encode(array_values($Time)); ?>);

        }

        plotGraphs(<?= json_encode(array_values($CpuUtilization)); ?>, <?= json_encode(array_values($Memory_Used)); ?>, <?= json_encode(array_values($Disk_Storage)); ?>, <?= json_encode(array_values($Time)); ?>);


        function fetchPastOneDayData() {

            <?php

            date_default_timezone_set("Asia/Kolkata");
            $currentTime = time();
            $OneHourBefore = $currentTime - 86400;

            $queryingTime = date("Y-m-d H:i:s", $OneHourBefore);

            $query = "select * from local_server_data where time>'$queryingTime'";
            $result = fetch_local_server_data($query);

            $CpuUtilization = $result[0];
            $Memory_Used = $result[1];
            $Disk_Storage = $result[2];
            $Time = $result[3];
            $TotalDays = $result[4];
            $Date = $result[5];


            ?>

            plotGraphs(<?= json_encode(array_values($CpuUtilization)); ?>, <?= json_encode(array_values($Memory_Used)); ?>, <?= json_encode(array_values($Disk_Storage)); ?>, <?= json_encode(array_values($Time)); ?>);

        }

        function fetchPastFiveDayData() {

            <?php

            date_default_timezone_set("Asia/Kolkata");
            $currentTime = time();
            $OneHourBefore = $currentTime - 432000;

            $queryingTime = date("Y-m-d H:i:s", $OneHourBefore);

            $query = "select * from local_server_data where time>'$queryingTime'";
            $result = fetch_local_server_data($query);

            $CpuUtilization = $result[0];
            $Memory_Used = $result[1];
            $Disk_Storage = $result[2];
            $Time = $result[3];
            $TotalDays = $result[4];
            $Date = $result[5];


            ?>
            plotGraphs(<?= json_encode(array_values($CpuUtilization)); ?>, <?= json_encode(array_values($Memory_Used)); ?>, <?= json_encode(array_values($Disk_Storage)); ?>, <?= json_encode(array_values($Time)); ?>);
        }

        function fetchPastOneMonthData() {

            <?php

            date_default_timezone_set("Asia/Kolkata");
            $currentTime = time();
            echo time();
            $OneHourBefore = $currentTime - 78840000;

            $queryingTime = date("Y-m-d H:i:s", $OneHourBefore);

            $query = "select * from local_server_data where time>'$queryingTime'";
            $result = fetch_local_server_data($query);

            $CpuUtilization = $result[0];
            $Memory_Used = $result[1];
            $Disk_Storage = $result[2];
            $Time = $result[3];
            $TotalDays = $result[4];
            $Date = $result[5];


            ?>

            plotGraphs(<?= json_encode(array_values($CpuUtilization)); ?>, <?= json_encode(array_values($Memory_Used)); ?>, <?= json_encode(array_values($Disk_Storage)); ?>, <?= json_encode(array_values($Time)); ?>);
        }
    </script>


</body>

</html>