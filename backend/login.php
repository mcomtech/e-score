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

    <link rel="stylesheet" href="css/login.css">
</head>
<body>
        
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>
            <!--alert when login error-->
            <?php if(!empty($msg)){
            ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $msg;?>
            </div>
            <?php } ?>
            <!--End error Login-->
		    <form method="post" action="" class="login-form" >
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-uppercase">Username</label>
                <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้งาน" autofocus>
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
            </div>
            
            
                <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                <small>Remember Me</small>
                </label>
                <button type="submit" name="login" class="btn btn-login float-right">เข้าสู่ระบบ</button>
            </div>
            
            </form>
            <div class="copy-text">พัฒนาโดย <i class="fa fa-heart"></i> <a href="http://www.app2day.in.th">อ.ศราวุธ  อินรีย์</a></div>
                    </div>
                    <div class="col-md-8 banner-sec">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            </ol>
                        <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                        <h2>ระบบจัดการผลการเรียน</h2>
                        <p>สำหรับบุคลากรวิทยาลัยเอ็น-เทคบริหารธุรกิจใช้ในการจัดการนักเรียน ชั้นเรียน กรอกคะแนนเก็บและตัดเกรด</p>
                    </div>	
            </div>
                </div>
                
                        </div>	   
                        
                    </div>
                </div>
            </div>
            </section>
        
</body>
</html>