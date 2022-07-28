<?php

// Connection to Database (Server Monitor)

$host = "localhost:3306";
$username = "root";
$pass = "";
$db = "server_monitor";

$conn = mysqli_connect($host, $username, $pass, $db);

if(!$conn){
    echo "Unable to Connect to Database";
}
else{
}

?>