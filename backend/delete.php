<?php 
include('config.php');
if(!empty($_GET['act'])&& $_GET['act']=='del_score'){
    
    $score_id = $_GET['score'];
    $str = "DELETE FROM scores WHERE score_id ='$score_id'";
    mysqli_query($conn,$str) or die(mysqli_error($conn));

    echo "<script>
    window.location='add_score.php?subject=$_GET[subj]&student=$_GET[std]';</script>";
}
if(!empty($_GET['act'])&& $_GET['act']=='del_subject'){
    
    $subject_id = $_GET['subject'];
    $str = "DELETE FROM subject WHERE subject_id ='$subject_id'";
    mysqli_query($conn,$str) or die(mysqli_error($conn));

    echo "<script>
    window.location='subject.php';</script>";
}

if(!empty($_GET['act'])&& $_GET['act']=='del_student'){
    
    $std_id = $_GET['student'];
    $str = "DELETE FROM students WHERE student_id ='$std_id'";
    mysqli_query($conn,$str) or die(mysqli_error($conn));

    echo "<script>
    window.location='student.php';</script>";
}
?>