<?php
include('check-session.php');
include('config.php');
if(!empty($_GET['logged_out'])){
    if($_GET['logged_out']=='true'){
        session_destroy();
        echo "<script>window.location='../login';</script>";   
    }
}

if(isset($_POST['update_std'])){
    $stdid = $_POST['stdid'];
    $code = $_POST['code'];
    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $major = $_POST['major'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $str = "UPDATE students SET
    student_code = '$code',
    student_title = '$title',
    student_fname ='$fname',
    student_lname = '$lname',
    student_tel = '$tel',
    student_email = '$email',
    student_address = '$address',
    class_id = '$class',
    major_id ='$major'
    WHERE student_id = '$stdid'";
    mysqli_query($conn,$str)or die(mysqli_error($conn));

    echo "<script>alert('แก้ไขข้อมูลนักเรียนแล้ว!');</script>";
    echo "<script>window.location='student.php';</script>";

}

if(isset($_POST['edit_subject'])){
    $subID = $_POST['subject'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $term = $_POST['term'];
    $teacher = $_POST['teacher'];

    $str = "UPDATE subject SET
    subject_code = '$code',
    subject_name ='$name',
    subject_unit = '$unit',
    term_id = '$term',
    teacher_id = '$teacher'
    WHERE subject_id = '$subID'";
    mysqli_query($conn,$str)or die(mysqli_error($conn));

    echo "<script>alert('แก้ไขข้อมูลรายวิชาแล้ว!');</script>";
    echo "<script>window.location='subject.php';</script>";
}

if(isset($_POST['changepass'])){
    $old = md5($_POST['old-pass']);
    $pass1 = md5($_POST['password1']);
    $pass2 = md5($_POST['password2']);
    $tid = $_SESSION['aID'];
    $str1 = "SELECT password FROM teachers WHERE teacher_id = '$tid'";
    $rs1 = mysqli_query($conn,$str1);
    $data = mysqli_fetch_array($rs1);
    if($old == $data['password']){
    if($pass1 == $pass2){
        $str = "UPDATE teachers SET password = '$pass1' WHERE teacher_id = '$tid'";
        mysqli_query($conn,$str)or die(mysqli_error($conn));
        echo "<script>alert('เปลี่ยนรหัสแล้ว');</script>";
        echo "<script>window.location='profile.php';</script>";
    }else{
        echo "<script>alert('รหัสผ่านไม่ตรงกัน');</script>";
        echo "<script>window.location='profile.php';</script>";
    }
    }else{
        echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง!');</script>";
        echo "<script>window.location='profile.php';</script>";
    }

    
}
echo "<script>window.location='subject.php';</script>";
?>
<!DOCTYPE html>
<html lang="TH">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการผลการเรียนออนไลน์</title>
</head>
<body>
    
</body>
</html>