<?php
include('check-session.php');
if(!empty($_GET['logged_out'])){
    if($_GET['logged_out']=='true'){
        session_destroy();
        echo "<script>window.location='login.php';</script>";   
    }
}
echo "<script>window.location='subject.php';</script>";
?>
