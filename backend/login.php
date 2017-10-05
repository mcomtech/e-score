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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการผลการเรียนออนไลน์</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
        <style>
        .login{
            margin:auto;
        }
        </style>
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <h1 style="text-align:center;">ระบบจัดการผลการเรียนออนไลน์</h1>
        </div>
    </div>
    <div class="container">
    
    <form action="" method="post">
        <div class="col-md-4 login">
        <!--alert when login error-->
        <?php if(!empty($msg)){
        ?>
        <div class="alert alert-danger" role="alert">
        <?php echo $msg;?>
        </div>
        <?php } ?>
        <!--End error Login-->

        <div class="form-group">
            <div class="input-group input-group-lg">
            <span class="input-group-addon" id="sizing-addon1">
            <i class="material-icons">account_circle</i>
            </span>
            <input type="text" name="username" placeholder="Username" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-lg">
            <span class="input-group-addon" id="sizing-addon1">
            <i class="material-icons">lock</i>
            </span>
            <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
        </div>        
        <div class="form-group">
            <button type="reset" name="reset" class="btn btn-danger">ล้างข้อมูล</button>
            <button type="submit" name="login" class="btn btn-default"> เข้าสู่ระบบ</button>
            
        </div>
        </div>

        
    </form>
    </div>
</body>
</html>