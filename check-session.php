<?php 
session_start();
  if(@$_SESSION['logged_in']!=true){
      echo "<script>alert('กรุณาเข้าสู่ระบบก่อน');window.location='login.php';</script>";
  }

?>