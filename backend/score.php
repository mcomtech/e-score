<?php include("config.php"); 
include('check-session.php');

if(!empty($_GET['subject'])){
    $subject = $_GET['subject'];

    $str = "SELECT * FROM subject AS subj
    WHERE subj.subject_id='$subject'";
    $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
    $show = mysqli_fetch_array($rs);
}


if(isset($_POST['confirm'])){
    foreach($_POST['student'] as $stds){

    $std_id = $stds;
    $subj_id = $_POST['subj_id'];
    $str = "INSERT INTO course(course_id,subject_id,student_id) 
            VALUES('','$subj_id','$std_id')";
    mysqli_query($conn,$str)or die(mysqli_error($conn));

}
}

            if(!empty($_GET['subject'])){
                $sub_id = $_GET['subject'];
            }else{
                $sub_id = '-';
            }


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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="jumbotron">
        <div class="container">
            <h1>ระบบจัดการผลการเรียนออนไลน์</h1>
            <h4>รายวิชา <?php echo $show['subject_name'];?></h4>
        </div>
    </div>

    </div>
    <div class="container">
        <?php include('template/top_menu.php')?>

        <!--เมนูรอง-->
        <!-- add student btn -->
        <div class="form-group">
        <ol class="breadcrumb">    
        <li class="breadcrumb-item"><a href="subject.php">รายวิชา</a></li>
        <li class="breadcrumb-item active">รายชื่อนักเรียนในรายวิชา</li>
        </ol>
        
        </div>
        <div>

        <div class="form-group">
            <ul class="nav nav-pills">
                 <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-toggle="modal" data-target="#exampleModal">
                    เพิ่มนักเรียนในรายวิชานี้
                </a>
                </li>
                 <?php } ?>
                
            </ul>
        </div>
        <!--สิ้นสุดเมนูรอง-->


        <!--ฟอร์มเพิ่มนักเรียนในรายวิชา-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มนักเรียนในรายวิชา</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="select_student.php" method="get" class="form">

                            <label for="subject">เลือกรายวิชา</label>
                            <select name="subject" id="subject" class="form-control">
                            <?php 
                            $tid = $_SESSION['aID'];
                            $str = "SELECT * FROM subject AS sj, teachers  AS t 
                            WHERE sj.teacher_id = t.teacher_id 
                            AND sj.teacher_id = '$tid'";
                            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
                            while($subj = mysqli_fetch_array($rs)){
                            ?>
                            <option value="<?php echo $subj['subject_id'];?>" <?php if($sub_id == $subj['subject_id']){echo "selected";}?> >
                                <?php echo $subj['subject_code'];?> <?php echo $subj['subject_name'];?>
                            </option>
                            <?php } ?>
                            </select>
                            <br>
                            <label for="class" for="class">เลือกชั้นเรียน</label>
                            <select name="class" id="class" class="form-control">
                            <?php 
                            $str = "SELECT * FROM class AS cls";
                            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
                            while($class = mysqli_fetch_array($rs)){
                            ?>
                            <option value="<?php echo $class['class_id'];?>">
                                <?php echo $class['class_name'];?> <?php echo $class['class_lvl'];?>/<?php echo $class['class_room'];?>
                            </option>
                            <?php } ?>
                            </select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <input type="submit" name="addstd" value="เพิ่มนักเรียน" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--สิ้นสุดฟอร์ม-->

        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ห้อง</th>
                    <th>เกรด</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $str = "SELECT * FROM students AS std,course AS cs,class AS cls 
            WHERE std.student_id = cs.student_id 
            AND cls.class_id = std.class_id
            AND cs.subject_id = '$sub_id'";
            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
            while($std = mysqli_fetch_array($rs)){
            ?>                   
                    <tr>
                        <td><?php echo $std['student_code'];?></td>
                        <td><?php echo $std['student_title'];?><?php echo $std['student_fname'];?></td>
                        <td><?php echo $std['student_lname'];?></td>
                        <td><?php echo $std['class_name'];?> <?php echo $std['class_lvl'];?>/<?php echo $std['class_room'];?></td>
                        <td><?php echo $std['course_grade'];;?></td>
                        <td>
                            <a href="add_score.php?subject=<?php echo $std['subject_id'];?>&student=<?php echo $std['student_id'];?>"><i class="material-icons">visibility</i></a>
                        </td>
                    </tr>
            <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ห้อง</th>
                    <th>เกรด</th>
                    <th>จัดการ</th>
                </tr>
            </tfoot>
        </table>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#myTable').DataTable();
    });
    </script>
    <?php mysqli_close($conn);?>
</body>

</html>