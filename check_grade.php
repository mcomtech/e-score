<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ระบบคำนวนเกรด โดย อ.ศราวุธ  อินรีย์</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="col-md-5">
          <div class="form-area">
              <form role="form" action="grade.php" method="post">
              <br style="clear:both">
                          <h3 style="margin-bottom: 25px; text-align: center;">ระบบคำนวนเกรด</h3>
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
                  <label for="present"><input type="checkbox" name="present" id="present" value="1"> ได้รับหนังสือเชิญผู้ปกครองให้มาเรียนภาคฤดูร้อน </label>
                </div>
                <div class="form-group">
                  <input type="text" name="work_score" value="" placeholder="คะแนนเก็บ" class="form-control" required>
                  <a href="check_score.php">ระบบคำนวนคะแนนเก็บ</a>
                </div>
                <div class="form-group">
                  <input type="text" name="mid_score" value="" placeholder="คะแนนสอบกลางภาค" class="form-control" required>
                </div>
                <div class="form-group">
                  <input type="text" name="final_score" value="" placeholder="คะแนนสอบกลางภาค" class="form-control" required>
                </div>
                <div class="form-group">
                  <span>ปล.คะแนนจิตพิสัยได้รวมไว้ในคะแนนเก็บแล้ว</span>
                </div>

                <a href="index.php" class="btn btn-success">กลับ</a>
              <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">เช็คเกรด</button>
              </form>
          </div>
      </div>
      </div>

  </body>
</html>
