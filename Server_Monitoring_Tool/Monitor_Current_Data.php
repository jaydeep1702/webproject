<?php

        // Code to fetch RAM Usage
        // Command to get available Physical Memory
        $cmd1 = shell_exec("systeminfo | find \"Available Physical Memory\"");

        // Command to get Total Physical Memory
        $cmd2 = shell_exec("systeminfo | findstr \"Total Physical Memory\"");
        $pattern = '!\d+!';

        if (preg_match_all($pattern, $cmd1, $matches)) {            
            $elems = count($matches[0]);
            if($elems == 2){
                $v1 = $matches[0][0];
                $v2 = $matches[0][1];
                $freeSpace = $v1 . $v2;
            }
            else{
                $freeSpace = $matches[0][0];
            }
        }

        if (preg_match_all($pattern, $cmd2, $matche)) {

            $v3 = $matche[0][0];
            $v4 = $matche[0][1];

            $totalSpace = $v3 . $v4;

            $usedSpace = $totalSpace - $freeSpace;
        }

        // Code to fetch Disk Storage
        // Command to Get Full Disk Storage
        $st = shell_exec("wmic diskdrive get size");

        // Command to Get Free Disk Storage
        $sk = shell_exec("wmic logicaldisk get freespace");

        $pattern = '!\d+!';

        if (preg_match_all($pattern, $st, $matches)) {
            $TotalStorage = $matches[0][0]; // Free Storage -- //38 for sent reciev loss data pack multiple line
            $TotalStorage = $TotalStorage / (1000 * 1000 * 1000);
        }

        if (preg_match_all($pattern, $sk, $matche)) {
            $availableStorage = $matche[0][0]; //38 for sent reciev loss data pack multiple line
            $availableStorage = $availableStorage / (1024 * 1024 * 1024);
        }

        $usedStorage = $TotalStorage - $availableStorage;

        // CPU Utilization Current Data Code
        $st = shell_exec("typeperf  \"\Processor(_Total)\% Processor Time\" -sc 5");

        $pattern = "/\d+\.[0-9][0-9][0-9][0-9]\d+/i";
        $patern1 = "/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/";

        if (preg_match_all($pattern, $st, $matches)) {

            // CPU Utilization Values  

            $CpuUtilVal1 = $matches[0][0];
            $CpuUtilVal2 = $matches[0][1];
            $CpuUtilVal3 =  $matches[0][2];
            $CpuUtilVal4 =  $matches[0][3];
            $CpuUtilVal5 =  $matches[0][4];
        }

        if (preg_match_all($patern1, $st, $matches)) {

            // Time Intervals 

            $t1 = $matches[0][0];
            $t2 = $matches[0][1];
            $t3 = $matches[0][2];
            $t4 = $matches[0][3];
            $t5 = $matches[0][4];
        }
header("refresh:3")
?>