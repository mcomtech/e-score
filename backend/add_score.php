<?php include("config.php"); 
include('check-session.php');
if(isset($_POST['add_point'])){
    $point = $_POST['point'];
    $title = $_POST['title'];
    $subject = $_POST['subj'];
    $student = $_POST['std'];

    $str = "INSERT INTO scores(score_id,subject_id,student_id,score_title,score_point)
            VALUES('','$subject','$student','$title','$point')";
    mysqli_query($conn,$str)or die(mysqli_error($conn));
}

if(!empty($_GET['subject']&&$_GET['student'])){
    $subject = $_GET['subject'];
    $student = $_GET['student'];

    $str = "SELECT * FROM students AS std,subject AS subj, class AS cls
    WHERE subj.subject_id='$subject' AND std.student_id = '$student'
    AND cls.class_id = std.class_id";
    $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
    $data = mysqli_fetch_array($rs);
}

if(isset($_POST['update'])){
    $subject = $_GET['subject'];
    $student = $_GET['student'];
    $str = "SELECT * FROM scores WHERE subject_id = '".$data['subject_id']."'
                  AND student_id = '".$data['student_id']."'";
          $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
          $i = 1;
          $total = 0;
          while($x = mysqli_fetch_array($rs)){    
          $total = $total + $x['score_point'];
        }

        if ($total >= 80) {
            $grade = '4';
        }elseif ($total >= 75) {
            $grade = '3.5';
        }elseif ($total >= 70) {
            $grade = '3';
        }elseif ($total >= 65) {
            $grade = '2.5';
        }elseif ($total >= 60) {
            $grade = '2';
        }elseif ($total >= 55) {
            $grade = '1.5';
        }elseif ($total >= 50) {
            $grade = '1';
        }else {
            $grade = '0';
        }
        
        $str = "UPDATE course SET
        course_grade = '$grade'
        WHERE subject_id ='$subject' AND student_id='$student'";
        mysqli_query($conn,$str) or die(mysqli_error($conn));
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="jumbotron">
        <div class="container">
            <h1>ระบบจัดการผลการเรียนออนไลน์</h1>
            <h5>รายวิชา <?php echo $data['subject_name'];?></h5>
            <h5><?php echo $data['student_title'];?> <?php echo $data['student_fname'];?>  <?php echo $data['student_lname'];?> ห้อง <?php echo $data['class_name'];?> <?php echo $data['class_lvl'];?>/<?php echo $data['class_room'];?> </h6> 
        
        </div>
    </div>
    <div class="container">
        <?php include('template/top_menu.php')?>

        
    <!-- add student btn -->
    <div class="form-group">
    <ol class="breadcrumb">    
    <li class="breadcrumb-item"><a href="subject.php">รายวิชา</a></li>
        <li class="breadcrumb-item active">คำนวนเกรด</li>
        </ol>
    
    </div>
    <div>
    
    
    </div>
    
    <table class="table table-responsive">
    <thead>
        <tr>
        <th>#</th><th>รายการ</th><th>คะแนน</th><th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
    <?php $str = "SELECT * FROM scores WHERE subject_id = '".$data['subject_id']."'
                  AND student_id = '".$data['student_id']."'";
          $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
          $i = 1;
          $total = 0;
          while($score = mysqli_fetch_array($rs)){    
          $total = $total + $score['score_point'];
    ?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $score['score_title'];?></td>
        <td><?php echo $score['score_point'];?></td>
        <td>
            <a href="delete.php?act=del_score&score=<?php echo $score['score_id'];?>&std=<?php echo $data['student_id'];?>&subj=<?php echo $data['subject_id'];?>" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></a>
        </td>
        </tr>
          <?php $i++;} ?>
        <form action="" method="post" class="form">
        <tr>
        <td></td> 
        <td>คะแนนรวม</td>
        <td><?php echo $total;?> คะแนน</td>
        <td><button type="submit" name="update" class="btn btn-primary btn-sm">อัพเดท</button></td>
        </tr>
    </tbody>
    <tfoot>
    
    <input type="hidden" name="std" value="<?php echo $data['student_id'];?>">
    <input type="hidden" name="subj" value="<?php echo $data['subject_id'];?>">
        <tr>
        <td></td>
        <td><input type="text" name="title" placeholder="กรอกชื่อรายการ" autofocus class="form-control"></td>
        <td><input type="text" name="point" placeholder="กรอกคะแนน" class="form-control" min="1" max="100"></td>
        <td><button type="submit" name="add_point" class="btn btn-success btn-sm"> <i class="material-icons">control_point</i></button></td>
        </tr>
    </form>
    </tfoot>
    </table>

 
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<?php mysqli_close($conn);?>
</body>
</html>