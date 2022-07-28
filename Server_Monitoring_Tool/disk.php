<?php 
$name="w3schools.com";



$st=shell_exec("wmic diskdrive get size" );
echo $st;
$sk=shell_exec("wmic logicaldisk get freespace");
$pattern = '!\d+!';
if(preg_match_all($pattern, $st, $matches)){
  print_r($matches);
$v1=$matches[0][0]; //38 for sent reciev loss data pack multiple line
 
        echo $v1;   
    
   //40
}
if(preg_match_all($pattern, $sk, $matche)){
  print_r($matche);
    $v3=$matche[0][0]+$matche[0][1]; //38 for sent reciev loss data pack multiple line
  //39
   
   
    
 //38 for sent reciev loss data pack multiple line
 //$var1=$matches[0][2];  //39
   //40
}
$v2=$v1-$v3;
?>







<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["Used space","Available Space"];
var yValues = [<?=$v2?>,<?=$v3?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
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
      display: true,
      text: "Storage Statitics"
    }
  }
});
</script>

</body>
</html>
