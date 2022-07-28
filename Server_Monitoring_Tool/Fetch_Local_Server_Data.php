<?php

function fetch_local_server_data($query): array
{

    require "_Database_Connection.php";

    $CpuUtilization = array();
    $Memory_Used = array();
    $Disk_Storage = array();
    $DateTime = array();

    $result = mysqli_query($conn, $query);

    $Date = array();
    $Time = array();

    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($CpuUtilization, (int) $row["CPU_Utilization"]);
        array_push($Memory_Used, (int) $row["Memory_Used"]);
        array_push($Disk_Storage, (int) $row["Disk_Storage"]);
        array_push($DateTime, strtotime($row["Time"]));

        $currentRecordDate = date('d-m-Y', $DateTime[$i]);
        $currentRecordTime = date('H:i:s', $DateTime[$i]);

        if ($i != 0) {
            if (date('d/M/Y', $DateTime[$i - 1]) <> $currentRecordDate) {
                array_push($Date, $currentRecordDate);
            }
        }
        
        array_push($Time, $currentRecordTime);
        $i = $i + 1;
    }

    $TotalDays = count($Date);

    $result = array($CpuUtilization, $Memory_Used, $Disk_Storage, $Time, $Date, $TotalDays);

    return $result;
}
