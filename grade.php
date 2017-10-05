<?php if (isset($_POST['submit'])) {
  $subject = $_POST['subject'];
  $name = $_POST['name'];
  $work_score = $_POST['work_score'];
  $mid_score = $_POST['mid_score'];
  $final_score = $_POST['final_score'];
  if (!empty($_POST['present'])) {
    $absent_score = 0 ;
  }else {
    $absent_score = 10 ;
  }


  switch ($subject) {
    case '11':
      $Sjname = "คอมพิวเตอร์และการบำรุงรักษา";
      break;
    case '10':
        $Sjname = "ระบบเครือข่ายคอมพิวเตอร์";
    break;
    case '12':
          $Sjname = "ระบบปฏิบัติการคอมพิเตอร์เบื้องต้น";
    break;
    case '23':
      $Sjname = "พื้นฐานการเขียนโปรแกรมคอมพิวเตอร์";
      break;
    default:
      # code...
      break;
  }

  $score = $work_score+$mid_score+$final_score+$absent_score;

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


  if ($score < 50) {
    $warn = "<p style='color:red';>ไม่ผ่านเกณฑ์</p>";
    $msgx = "คะแนนนักศึกษาน้อยกว่าเกณฑ์ กรุณาติดต่อผู้สอนเพื่อขอส่งงานย้อนหลัง";
  }else {
    $warn = "<p style='color:lawngreen';>ผ่านจ้าา</p>";
    $msgx = "ขอให้โชคดีกับการสอบปลายภาคครับ";
  }

} ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ระบบตรวจเช็คนะแนนเก็บ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <h1>ระบบเช็คคะแนนเก็บ</h1>
        <h4>โดย อ.ศราวุธ  อินรีย์</h4>
        <dl class="row">
          <dt class="col-sm-3">รายวิชา</dt>
          <dd class="col-sm-9"><?php echo $Sjname; ?></dd>

          <dt class="col-sm-3">รายละเอียด</dt>
          <dd class="col-sm-9">คะแนนเต็ม : 100 คะแนน</dd>
          <dt class="col-sm-3">เกณฑ์</dt>
          <dd class="col-sm-9"><p>80 คะแนน > เกรด 4 <br>
            75 คะแนน > เกรด  3.5 <br>
            70 คะแนน > เกรด  3 <br>
            65 คะแนน > เกรด  2.5 <br>
            60 คะแนน > เกรด  2 <br>
            55 คะแนน > เกรด  1.5 <br>
            50 คะแนน > เกรด  1 <br>
            ต่ำกว่านี้ไม่ผ่าน</p>
          </dd>

          <dt class="col-sm-3">ชื่อ</dt>
          <dd class="col-sm-9"><strong><?php echo $name; ?></strong></dd>

          <dt class="col-sm-3">คะแนนเก็บ</dt>
          <dd class="col-sm-9"><strong><?php echo $work_score; ?></strong> คะแนน</dd>

          <dt class="col-sm-3 text-truncate">คะแนนกลางภาค</dt>
          <dd class="col-sm-9"> <strong><?php echo $mid_score; ?></strong> คะแนน</dd>

          <dt class="col-sm-3 text-truncate">คะแนนปลายภาค</dt>
          <dd class="col-sm-9"> <strong><?php echo $final_score; ?></strong> คะแนน</dd>

          <dt class="col-sm-3 text-truncate">คะแนนเข้าเรียน</dt>
          <dd class="col-sm-9"> <strong><?php echo $absent_score; ?></strong> คะแนน</dd>

          <dt class="col-sm-3 text-truncate">คะแนนรวม</dt>
          <dd class="col-sm-9"> <strong><?php echo $score; ?></strong> คะแนน</dd>

          <dt class="col-sm-3 text-truncate">เกรดที่ได้</dt>
          <dd class="col-sm-9"> <strong><h1><?php echo $grade; ?></h1></strong></dd>

          <dt class="col-sm-3">สรุป</dt>
          <dd class="col-sm-9">
            <dl class="row">
              <dt class="col-sm-2"><h2><?php echo $warn; ?></h2></dt>
            </dl>
          </dd>

          <dt class="col-sm-4 text-truncate">
            <?php echo $msgx; ?><br>
            <a href="index.php" class="btn btn-success">กลับ</a>
          </dt>

        </dl>

      </div>
  </body>
</html>
