<?php include("config.php"); 
include('check-session.php');

if(!empty($_GET['subject'])&& !empty($_GET['student'])){
    $subject = $_GET['subject'];
    $student = $_GET['student'];

    $str = "SELECT * FROM students AS std,subject AS subj, class AS cls
    WHERE subj.subject_id='$subject' AND std.student_id = '$student'
    AND cls.class_id = std.class_id";
    $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
    $data = mysqli_fetch_array($rs);
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
<header>
    <?php include('template/_header.php');?>
</header>
    <div class="container bgcolor">
        <?php include('template/top_menu.php')?>

        
    <!-- add student btn -->
    <P></p>
        <div class="row">
            <div class="col-md-12">
            <h4>รายวิชา <?php echo $data['subject_name']; ?></h4><br>
            </div>
            <div class="col-md-12">
            <h5><?php echo $data['student_title'].$data['student_fname']." ".$data['student_lname']."ห้อง ".$data['class_name']." ".$data['class_lvl']."/".$data['class_room']; ?></h5>
            </div>
        </div>
    
    <table class="table table-responsive">
    <thead>
        <tr>
        <th>#</th><th>รายการ</th><th>คะแนน</th>
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
        </tr>
          <?php $i++;} ?>
        <form action="" method="post" class="form">
        <tr>
        <td></td> 
        <td>คะแนนรวม</td>
        <td><strong><?php echo $total;?> คะแนน</strong></td>
        </tr>
    </tbody>
    
    </table>

 
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<?php mysqli_close($conn);?>
</body>
</html>