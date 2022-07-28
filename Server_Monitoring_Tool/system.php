
<?php 
$name="w3schools.com";



$st=shell_exec("systeminfo | find \"Available Physical Memory\"");
echo $st;
$sk=shell_exec("systeminfo | findstr \"Total Physical Memory\"");
$pattern = '!\d+!';
if(preg_match_all($pattern, $st, $matches)){
  print_r($matches);
$v1=$matches[0][0]; //38 for sent reciev loss data pack multiple line
 $v2=$matches[0][1];  //39
    $t=$v1.$v2;
        echo $t;   
    
   //40
}
if(preg_match_all($pattern, $sk, $matche)){
  print_r($matche);
    $v3=$matche[0][0]; //38 for sent reciev loss data pack multiple line
 $v4=$matche[0][1];  //39
    $t1=$v3.$v4;
    $t2=$t1-$t;
 //38 for sent reciev loss data pack multiple line
 //$var1=$matches[0][2];  //39
   //40
}
?>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["Free Space(In MB)","Used Space(In MB)"];
var yValues = [<?=$t?>,<?=$t2?>];
var barColors = [
  "#48F706",
  "#F72D02"
  
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
      text: "RAM USAGE"
    }
  }
});
</script>

</body>
</html>
