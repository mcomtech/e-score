<?php if (isset($_POST['submit'])) {
  $subject = $_POST['subject'];
  $name = $_POST['name'];
  $sent = $_POST['work'];
  $msg = $_POST['message'];

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

  $percent = ($sent / $subject) * 100 ;
  $score = ($percent / 100) * 30;

  if ($percent < 50) {
    $warn = "D:";
    $msgx = "คะแนนนักศึกษาน้อยกว่าเกณฑ์ กรุณาติดต่อผู้สอนเพื่อขอส่งงานย้อนหลัง";
  }else {
    $warn = ":D";
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
          <dd class="col-sm-9">
            <p>คะแนนเต็ม : 30 คะแนน</p>
            <p>งานทั้งหมด <?php echo $subject; ?> ชิ้น</p>
          </dd>

          <dt class="col-sm-3">ชื่อ</dt>
          <dd class="col-sm-9"><?php echo $name; ?></dd>

          <dt class="col-sm-3">งานที่ส่ง</dt>
          <dd class="col-sm-9"><strong><?php echo $sent; ?></strong> ชิ้น คิดเป็น <strong><?php echo number_format($percent,2); ?></strong> %</dd>

          <dt class="col-sm-3 text-truncate">คะแนนที่ได้</dt>
          <dd class="col-sm-9"> <strong><?php echo number_format($score,2); ?></strong> คะแนน</dd>

          <dt class="col-sm-3">สรุป</dt>
          <dd class="col-sm-9">
            <dl class="row">
              <dt class="col-sm-1"><?php echo $warn; ?></dt>
              <dd class="col-sm-8"><?php echo $msgx; ?></dd>
            </dl>
          </dd>

          <dt class="col-sm-3 text-truncate">
            <a href="index.php" class="btn btn-success">กลับ</a>
          </dt>

        </dl>
      </div>
  </body>
</html>
