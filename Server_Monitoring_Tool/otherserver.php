


<?php
$name="google.com";
$st=shell_exec("ping  -n 10 ".$name);
//echo $st;
$pattern = "/time=\d+|Sent = \d+| Received = \d+|Lost = \d+|Minimum = \d+|Maximum = \d+|Average = \d+/i";
if(preg_match_all($pattern, $st, $matches)) {
 // print_r($matches);
}

 
    $timestr=$matches[0][0].$matches[0][1].$matches[0][2].$matches[0][3].$matches[0][4].$matches[0][5].$matches[0][6].$matches[0][7].$matches[0][8].$matches[0][9].$matches[0][10].$matches[0][11].$matches[0][12].$matches[0][13].$matches[0][14].$matches[0][15];    //array string pass to next sorting no pattern
    //echo $timestr;
$patern1= '!\d+!';
if(preg_match_all($patern1, $timestr, $match1)) {
  //print_r($match1);
    $val=$match1[0][0];    //latency value 
$val1=$match1[0][1];        
    $val2=$match1[0][2];
    $val3=$match1[0][3];
    $val4=$match1[0][4];
    $val5=$match1[0][5];
    $val6=$match1[0][4];
    $val7=$match1[0][7];
    $val8=$match1[0][8];
    $val9=$match1[0][9];     //latency value 
    $sent=$match1[0][10];     //sent packet
    $received=$match1[0][11];      //rec packet
    $lost=$match1[0][12];         //lost packet
    $minimum=$match1[0][13];        //minimum latency
        $maximum=$match1[0][14];        //maximum
        $average=$match1[0][15];       //average
}

?>



 

<html>
    <style>
        button{
          width:100px;
            height: 50px;
            align-content: center;
        }
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<body>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
<canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
    <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["Minimum","Maximum","Average"];
var yValues = [<?=$minimum?>,<?=$maximum?>,<?=$average?>];
var barColors = ["red", "green","blue"];
var zvalues=["1","2","3","4","5","6","7","8","9","10"];
new Chart("myChart", {
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
      
    
    legend: {display: false},
    title: {
      display: true,
      text: "Server latency"
    }
  }
});
    new Chart("myChart1", {
  type: "line",
  data: {
    labels: zvalues,
    datasets: [{ 
      data: [<?=$val?>,<?=$val1?>,<?=$val2?>,<?=$val3?>,<?=$val4?>,<?=$val5?>,<?=$val6?>,<?=$val7?>,<?=$val8?>,<?=$val9?>],
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: false},
      title: {
      display: true,
      text: "Server latency"
    }
  }
});
    
var aValues = ["Sent Packets","Received Packets","Loss Packets"];
var bValues = [<?=$sent?>,<?=$received?>,<?=$lost?>]; 
var barColors = [
  "#0e1bab",
  "#04bf04",
  "#bf1704"
  
];

new Chart("myChart2", {
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
      display: true,
      text: "Packets Details"
    }
  }
});
</script>
    

<button onclick="window.location.reload();" value="Recheck">Recheck</button>
</body>
</html>