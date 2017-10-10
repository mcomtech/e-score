<?php
include('config.php');
include('check-session.php');
if(!empty($_GET['logged_out'])){
    if($_GET['logged_out']=='true'){
        session_destroy();
        echo "<script>window.location='login.php';</script>";   
    }
}

if(isset($_POST['changepass'])){
    $old = md5($_POST['old-pass']);
    $pass1 = md5($_POST['password1']);
    $pass2 = md5($_POST['password2']);
    $stdid = $_SESSION['sID'];
    $str1 = "SELECT student_password FROM students WHERE student_id = '$stdid'";
    $rs1 = mysqli_query($conn,$str1);
    $data = mysqli_fetch_array($rs1);
    if($old == $data['student_password']){
    if($pass1 == $pass2){
        $str = "UPDATE students SET student_password = '$pass1' WHERE student_id = '$stdid'";
        mysqli_query($conn,$str)or die(mysqli_error($conn));
        echo "<script>alert('เปลี่ยนรหัสแล้ว');</script>";
    }else{
        echo "<script>alert('รหัสผ่านไม่ตรงกัน');</script>";
    }
    }else{
        echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง!');</script>";
    }

    
}

if(isset($_POST['update_profile'])){
    $tel =$_POST['tel'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $stdid = $_SESSION['sID'];
    $str = "UPDATE students SET
             student_tel = '$tel',
             student_email = '$email' ,
             student_address = '$address'
             WHERE student_id = '$stdid'";
        mysqli_query($conn,$str)or die(mysqli_error($conn));
        echo "<script>alert('แก้ไขข้อมูลแล้ว');</script>";

}
echo "<script>window.location='profile.php';</script>";
?>
<!DOCTYPE html>
<html lang="TH">
<head>
    <meta property="og:url"                content="https://reg.an-tech-ac.th" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="ระบบสารสนเทศ วิทยาลัยเทคโนโลยีเอ็น-เทคบริหารธุรกิจ" />
    <meta property="og:description"        content="พัฒนาเพื่อใช้ในงานทะเบียนและประมวลผลการเรียน สำหรับนักเรียน และบุคลากร" />
    <meta property="og:image"              content="https://reg.an-tech.ac.th/img/cover.jpg" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบสารสนเทศ วิทยาลัยเทคโนโลยีเอ็น-เทคบริหารธุรกิจ</title>
</head>
<body>
    
</body>
</html>