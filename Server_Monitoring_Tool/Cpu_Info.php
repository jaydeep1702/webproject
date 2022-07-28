<?php 

$cpuname=shell_exec("wmic cpu get name /value");
echo $cpuname."<br>";

$cpuvolt=shell_exec("wmic cpu get currentvoltage /value");
echo $cpuvolt."<br>";

$cpumaxclockspeed=shell_exec("wmic cpu get maxclockspeed /value ");
echo $cpumaxclockspeed."<br>";

$cpucurrentclckspeed=shell_exec("wmic cpu currentclockspeed /value");
echo $cpucurrentclckspeed."<br>";

$cpucores = shell_exec("wmic cpu numberofcores /value");
echo $cpucores."<br>";

?>