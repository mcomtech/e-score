<?php include('config.php');
function cals($subj,$std){
  global $conn;
    $str = "SELECT * FROM scores WHERE subject_id = '$subj'
                  AND student_id = '$std'";
          $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
          $total = 0;
          while($score = mysqli_fetch_array($rs)){    
    return $total = $total + $score['score_point'];
}
}
function grade($score){
    if ($score >= 80) {
    $grade = '4';
  }elseif ($score >= 75) {
    $grade = '3.5';
  }elseif ($score >= 70) {
    $grade = '3';
  }elseif ($score >= 65) {
    $grade = '2.5';
  }elseif ($score >= 60) {
    $grade = '2';
  }elseif ($score >= 55) {
    $grade = '1.5';
  }elseif ($score >= 50) {
    $grade = '1';
  }else {
    $grade = '0';
  }

  return $grade;
}


?>