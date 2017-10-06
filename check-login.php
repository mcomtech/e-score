<?php 
include('config.php');
if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $str = "SELECT teacher_id,username,password,status FROM teachers WHERE username='$user' 
            AND password = '$pass'";
    $resultset = mysqli_query($conn,$str)or die(mysqli_error($conn));
    $nums = mysqli_num_rows($resultset);        
            if(!empty($nums)){
                $data = mysqli_fetch_array($resultset);
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['aID'] = $data['teacher_id'];
                $_SESSION['aUser'] = $data['username'];
                $_SESSION['aStatus'] = $data['status'];
                echo "<script>window.location='index.php';</script>";
            }else{
                $msg = "Username or password not found";
            }
}

?>