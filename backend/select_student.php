<?php include("config.php"); 
include('check-session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการผลการเรียนออนไลน์ </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
        crossorigin="anonymous">


    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="jumbotron">
        <div class="container">
            <h1>ระบบจัดการผลการเรียนออนไลน์</h1>
            <h4>จัดการนักเรียน</h4>
        </div>
    </div>
    <div class="container">
        <?php include('template/top_menu.php')?>

    
    <!--เพิ่มนักเรียนสู่รายวิชา-->
    <form action="score.php?subject=<?php echo @$_GET['subject'];?>&search=ค้นหา" method="POST" class="form">
    <input type="hidden" name="subj_id" value="<?php echo $_GET['subject'];?>">
    <!-- add student btn -->
    <div class="form-group">
    <button type="submit" class="btn btn-primary" name="confirm">
    เพิ่มที่เลือก
    </button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>เลือก</th><th>รหัสประจำตัว</th><th>ชื่อ</th><th>นามสกุล</th><th>ห้อง</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($_GET['addstd'])){
            $class = $_GET['class'];
            $sid = $_GET['subject'];
            $str = "SELECT * FROM students,class WHERE students.class_id = class.class_id 
             AND class.class_id = '$class' ";
            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
            while($std = mysqli_fetch_array($rs)){
                

            ?>
            <tr>
                <td>
                <input type="checkbox" name="student[]" checked value="<?php echo $std['student_id'];?>" id="std<?php echo $std['student_id'];?>">
                </td>
                <td>
                <label for="std<?php echo $std['student_id'];?>"><?php echo $std['student_code'];?></label>
                </td>
                <td><label for="std<?php echo $std['student_id'];?>"><?php echo $std['student_title'];?><?php echo $std['student_fname'];?></label>
                </td>
                <td><label for="std<?php echo $std['student_id'];?>"><?php echo $std['student_lname'];?></label>
                </td>
                <td><label for="std<?php echo $std['student_id'];?>"><?php echo $std['class_name'];?> <?php echo $std['class_room'];?></label>
                </td>
            </tr>
            <?php } }?>
        </tbody>
    </table>
    <!-- add student btn -->
    <div class="form-group">
    <button type="submit" class="btn btn-primary" name="confirm">
    เพิ่มที่เลือก
    </button>
    </div>
    </form>
    <!--สิ้นสุดเพิ่มนักเรียน-->

    <!--end container-->    
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<?php mysqli_close($conn);?>
</body>
</html>