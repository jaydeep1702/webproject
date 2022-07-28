<?php

require "_Database_Connection.php";

// CPU Utilization Details Fetching Code
$st = shell_exec("typeperf  \"\Processor(_Total)\% Processor Time\" -sc 1");

$pattern = "/\d+\.[0-9][0-9][0-9][0-9]\d+/i";
$patern1 = "/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/";

if (preg_match_all($pattern, $st, $matches)) {

  // CPU Utilization Values  
  $CpuUtilVal = $matches[0][0];
}

if (preg_match_all($patern1, $st, $matches)) {

  // Time 
  $time = $matches[0][0];
}


// Memory (RAM) Usage Code

// Command to get available Physical Memory
$cmd1 = shell_exec("systeminfo | find \"Available Physical Memory\"");

// Command to get Total Physical Memory
$cmd2 = shell_exec("systeminfo | findstr \"Total Physical Memory\"");
$pattern = '!\d+!';

if (preg_match_all($pattern, $cmd1, $matches)) {
  $elems = count($matches[0]);
  if ($elems == 2) {
    $v1 = $matches[0][0];
    $v2 = $matches[0][1];
    $freeSpace = $v1 . $v2;
  } else {
    $freeSpace = $matches[0][0];
  }
}

if (preg_match_all($pattern, $cmd2, $matche)) {

  $v3 = $matche[0][0];
  $v4 = $matche[0][1];

  $totalSpace = $v3 . $v4;

  $usedSpace = $totalSpace - $freeSpace;
}

// Code to Fetch Storage Details

// Command to Get Full Disk Storage
$st = shell_exec("wmic diskdrive get size");

// Command to Get Free Disk Storage
$sk = shell_exec("wmic logicaldisk get freespace");

$pattern = '!\d+!';

if (preg_match_all($pattern, $st, $matches)) {
  $totalStorage = $matches[0][0]; // Free Storage -- //38 for sent reciev loss data pack multiple line
  $totalStorage = $totalStorage / (1000 * 1000 * 1000);
}

if (preg_match_all($pattern, $sk, $matche)) {
  $availableStorage = $matche[0][0]; //38 for sent reciev loss data pack multiple line
  $availableStorage = $availableStorage / (1024 * 1024 * 1024);
}

$usedStorage = $totalStorage - $availableStorage;

// Current Date and Time
date_default_timezone_set("Asia/Kolkata");
$time = date('Y-m-d H:i:s');

// To Fetch any critical contidion of Server (for storing in alert table)
$CpuAlert = 0;
$RamAlert = 0;
$diskStorageAlert = 0;

if ((int) $CpuUtilVal >  90) {
  $CpuAlert = 1;
}
if ($usedSpace > (0.9 * $totalSpace)) {
  $RamAlert = 1;
}
if ($usedStorage > (0.9 * $totalStorage)) {
  $diskStorageAlert = 1;
}


// Inserting Data in Database
$query = "insert into local_server_data values('$CpuUtilVal','$usedSpace','$usedStorage', '$time' )";

if (mysqli_query($conn, $query)) {
} else {
  echo 'Unable to Not Inserted';
}

if ($CpuAlert == 1) {
  $query = "insert into cpu_utilization_alerts values('$CpuUtilVal', '$time')"; 
  
  if (mysqli_query($conn, $query)) {
  } else {
    echo 'Unable to Not Inserted';
  }
}

if ($RamAlert == 1) {
  $query = "insert into memory_overused_alert values('$usedSpace', '$time')"; 
  
  if (mysqli_query($conn, $query)) {
  } else {
    echo 'Unable to Not Inserted';
  }
}
if ($diskStorageAlert == 1) {
  $query = "insert into disk_storage_full_alert values('$usedStorage', '$time')"; 
  
  if (mysqli_query($conn, $query)) {
  } else {
    echo 'Unable to Not Inserted';
  }
}

// To execute code again and again 
header("Refresh:0"); 

// mysqli_close($conn);
