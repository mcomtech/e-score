<?php
$host = "localhost";
$user = "appdayin_reg";
$pass = "lik;6tvboiupn";
$database = "appdayin_reg";

$conn = mysqli_connect($host,$user,$pass,$database);
mysqli_query($conn,"set names utf8")
// if($conn){
// echo "Connected!";
// }else{
//     echo "Error".mysqli_connect_error();
// }
?>