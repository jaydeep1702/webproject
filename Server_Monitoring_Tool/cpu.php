<?php 
$name="w3schools.com";



$st=shell_exec(" typeperf  \"\Processor(_Total)\% Processor Time\" -sc 5");
echo $st;
$pattern = '!\d+!';
$patern1="/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/";
if(preg_match_all($pattern, $st, $matches)){
  print_r($matches);
$var=$matches[0][10]; //38 for sent reciev loss data pack multiple line
 $var1=$matches[0][19];  //39
  $var2=  $matches[0][28]; //40
     $var3=  $matches[0][37];
     $var4=  $matches[0][46];
} 
if(preg_match_all($patern1, $st, $matches)){
   print_r($matches);
echo $t=$matches[0][0];
$t1=$matches[0][1];
    $t2=$matches[0][2];
    $t3=$matches[0][3];
    $t4=$matches[0][4];
    
}header("Refresh:1");
?>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<body>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["<?=$t?>","<?=$t1?>","<?=$t2?>","<?=$t3?>","<?=$t4?>"];
    
new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: [<?=$var?>,<?=$var1?>,<?=$var2?>,<?=$var3?>,<?=$var4?>],
      borderColor: "red",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>



