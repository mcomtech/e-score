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
      <div class="col-md-5">
          <div class="form-area">
              <form role="form" action="result.php" method="post">
              <br style="clear:both">
                          <h3 style="margin-bottom: 25px; text-align: center;">ระบบเช็คคะแนน</h3>
          				<div class="form-group">
      						<input type="text" class="form-control" id="name" name="name" placeholder="ชื่อ - นามสกุล" required>
      					</div>
      					<div class="form-group">
                  <select class="form-control" name="subject">
                    <option value="11">คอมพิวเตอร์และการบำรุงรักษา</option>
                    <option value="10">ระบบเครือข่ายคอมพิวเตอร์</option>
                    <option value="12">ระบบปฏิบัติการคอมพิเตอร์เบื้องต้น</option>
                    <option value="23">พื้นฐานการเขียนโปรแกรมคอมพิวเตอร์</option>
                  </select>
      					</div>
                <div class="form-group">
                  <input type="text" name="work" value="" placeholder="จำนวนงานที่ส่ง" class="form-control" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control" type="textarea" name="message" id="message" placeholder="ข้อความถึงผู้สอน" maxlength="140" rows="7"></textarea>
                </div>

                <a href="index.php" class="btn btn-success">กลับ</a>
              <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">เช็คคะแนน</button>
              </form>
          </div>
      </div>
      </div>
  </body>
</html>
