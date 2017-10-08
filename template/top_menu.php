<!--เมนูด้านบน-->
        
        <!--จบเมนูด้านบน-->
    <div class="box-top">
        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="https://an-tech.ac.th/main/wp-content/uploads/2017/05/logo-300x300.png" width="30" height="30" class="d-inline-block align-top" alt="">
                E-SCORE
            </a>
            <ul class="nav nav-pills justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" >เปลี่ยนรหัสผ่าน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == "profile.php"){ echo  "active"; } ?>" href="profile.php">ข้อมูลส่วนตัว</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="index.php?logged_out=true">ออกจากระบบ</a>
            </li>
        </ul>
    </nav>
    </div>
    <!-- เปลี่ยนรหัสผ่าน -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post">
          <div class="form-group">
            <label for="password1" class="form-control-label col-md-4">รหัสผ่านเดิม:</label>
            <input type="password" name="old-pass" id="password1" required>
          </div>
          <hr>
          <div class="form-group">
            <label for="password1" class="form-control-label col-md-4">รหัสผ่านใหม่:</label>
            <input type="password" name="password1" id="password1" required>
          </div>
          <div class="form-group">
            <label for="password1" class="form-control-label col-md-4">รหัสผ่านใหม่(อีกครั้ง):</label>
            <input type="password" name="password2" id="password1" required>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" name="changepass" class="btn btn-primary">ยืนยันการเปลี่ยนรหัส</button>
      </div>
      </form>
    </div>
  </div>
</div>