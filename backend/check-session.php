<?php 
session_start();
  if(@$_SESSION['logged_in']!=true){
      echo "<script>alert('สำหรับผู้ดูแลระบบเท่านั้น');window.location='login.php';</script>";
  }

?>