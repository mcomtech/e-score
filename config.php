<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "e-score";

$conn = mysqli_connect($host,$user,$pass,$database);
mysqli_query($conn,"set names utf8")
// if($conn){
// echo "Connected!";
// }else{
//     echo "Error".mysqli_connect_error();
// }
?>