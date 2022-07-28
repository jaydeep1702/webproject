<?php

require "_Database_Connection.php";

$query1 = "select * from cpu_utilization_alerts";
$query2 = "select * from memory_overused_alert";
$query3 = "select * from disk_storage_full_alert";

$CpuUtilizationLogs = mysqli_query($conn, $query1);
$cpu_util_rows = mysqli_num_rows($CpuUtilizationLogs);

$CpuLogTableBody = '';
$MemoryOverUsedTableBody = '';
$DiskStorageTableBody = '';

while ($row = mysqli_fetch_assoc($CpuUtilizationLogs)) {
    global $tableBody;
    $col1 = $row["CPU_Utilization"];
    $col2 = $row["Time"];

    $currRowData = "<tr class='table-secondary'><td class='table-secondary'>$col1</td><td class='table-secondary'>$col2</td></tr>";
    $CpuLogTableBody = $CpuLogTableBody . $currRowData;
}


$MemoryOverUsedLogs = mysqli_query($conn, $query2);
$memory_used_rows = mysqli_num_rows($MemoryOverUsedLogs);

while ($row = mysqli_fetch_assoc($MemoryOverUsedLogs)) {
    global $tableBody;
    
    $col1 = $row["Memory_Used"];
    $col2 = $row["Time"];
    
    $currRowData = "<tr class='table-secondary'><td class='table-secondary'>$col1</td><td class='table-secondary'>$col2</td></tr>";
    $MemoryOverUsedTableBody = $MemoryOverUsedTableBody . $currRowData;
}

$DiskStorageFullLogs = mysqli_query($conn, $query3);
$disk_storage_rows = mysqli_num_rows($DiskStorageFullLogs);

while ($row = mysqli_fetch_assoc($DiskStorageFullLogs)) {
    global $tableBody;

    $col1 = $row["Disk_Storage"];
    $col2 = $row["Time"];

    $currRowData = "<tr class='table-secondary'><td class='table-secondary'>$col1</td><td class='table-secondary'>$col2</td></tr>";
    $DiskStorageTableBody = $DiskStorageTableBody . $currRowData;
}

?>


<html>

<head>

    <link rel="stylesheet" href="CSS/Error_Logs.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">    

</head>

<body>
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

    <div id="LogTables">
        <div id="CpuUtilizationLogs">
            <div class="heading"> CPU Overutilization Logs </div>
            <table>
                <tr>
                    <th>CPU Utilization</th>
                    <th>Time</th>
                </tr>

                <?= $CpuLogTableBody ?>
            </table>
        </div>

        <div id="MemoryOverusedLogs">
            <div class="heading"> Memory Overused Logs</div>
            <table>
                <tr>
                    <th>Memory Used</th>
                    <th>Time</th>
                </tr>

                <?= $MemoryOverUsedTableBody ?>
            </table>
        </div>

        <div id="DiskStorageLogs">
            <div class="heading"> Disk Storage Full Logs</div>
            <table>
                <tr>
                    <th>Disk Storage</th>
                    <th>Time</th>
                </tr>

                <?= $DiskStorageTableBody ?>

            </table>
        </div>
    </div>
</body>

</html>