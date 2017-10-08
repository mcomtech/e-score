<?php 
session_start();
  if(@$_SESSION['logged_in']!=true){
      echo "<script>window.location='/login';</script>";
  }

?>