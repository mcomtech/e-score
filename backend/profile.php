<?php include("config.php"); 
include('check-session.php');
$teacherID = $_SESSION['aID'];
$objStr = "SELECT * FROM teachers AS tc,position AS ps, major AS mj ,section AS sc
WHERE tc.position_id = ps.position_id 
AND tc.major_id = mj.major_id
AND tc.section_id = sc.section_id
AND tc.teacher_id = '$teacherID'";
$objrs = mysqli_query($conn,$objStr)or die(mysqli_error($conn));
$teacher = mysqli_fetch_array($objrs);
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

<?php include('template/_header.php');?>
    <div class="container bgcolor">
        <?php include('template/top_menu.php')?>
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="<?php echo $teacher['teacher_pic'];?>" class="img-responsive" alt="" width="50%">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php echo $teacher['teacher_title'];?><?php echo $teacher['teacher_fname'];?>  <?php echo $teacher['teacher_lname'];?>
                        </div>
                        <div class="profile-usertitle-job">
                            <?php echo $teacher['position_name'];?>
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <!-- <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div> -->
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <!-- Nav tabs -->
                        <ul class="nav flex-column" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><i class="material-icons">account_box</i> ข้อมูลส่วนตัว</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#msg" role="tab"><i class="material-icons">inbox</i> ข้อความ</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><i class="material-icons">settings</i> แก้ไขข้อมูลส่วนตัว</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="material-icons">vpn_key</i> เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?logged_out=true" role="tab"> <i class="material-icons">exit_to_app</i> ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            
                            <strong><h4>ข้อมูลส่วนตัวบุคลากร</h4></strong>
                            <hr>                            
                            <dl class="row">
                            <dt class="col-sm-3">ชื่อผู้ใช้งาน</dt>
                            <dd class="col-sm-9"><?php echo $teacher['username'];?></dd>

                            <dt class="col-sm-3">ชื่อ</dt>
                            <dd class="col-sm-9"><?php echo $teacher['teacher_title'];?><?php echo $teacher['teacher_fname'];?>  <?php echo $teacher['teacher_lname'];?></dd>

                            <dt class="col-sm-3">ตำแหน่ง</dt>
                            <dd class="col-sm-9"><?php echo $teacher['position_name'];?></dd>

                            <dt class="col-sm-3">สาขา</dt>
                            <dd class="col-sm-9"><?php echo $teacher['major_name'];?></dd>

                            <dt class="col-sm-3 text-truncate">ฝ่ายงาน</dt>
                            <dd class="col-sm-9"><?php echo $teacher['section_name'];?></dd>

                            <dt class="col-sm-3 text-truncate">ข้อมูลการติดต่อ</dt>
                            <dd class="col-sm-9"></dd>

                            <dt class="col-sm-3">เบอร์โทร</dt>
                            <dd class="col-sm-9"><?php echo $teacher['teacher_tel'];?></dd>

                            <dt class="col-sm-3">อีเมล์</dt>
                            <dd class="col-sm-9"><?php echo $teacher['teacher_email'];?></dd>
                            
                            </dl>

                        </div>
                        <div class="tab-pane" id="msg" role="tabpanel">ข้อความ</div>
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <strong><h4>แก้ไขข้อมูลส่วนตัว</h4></strong>
                            <form action="index.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="teacher_id" value="<?php echo $teacher['teacher_id'];?>">
                            <strong><h4>ข้อมูลส่วนตัวบุคลากร</h4></strong>
                            <hr>                            
                            <dl class="row">
                            <dt class="col-sm-3">ชื่อผู้ใช้งาน</dt>
                            <dd class="col-sm-9"><input type="text" name="username" value="<?php echo $teacher['username'];?>"></dd>

                            <dt class="col-sm-3">ชื่อ</dt>
                            <dd class="col-sm-9">
                                <select name="title" id="name">
                                    <option value="นาย" <?php if($teacher['teacher_title']=='นาย'){ echo 'selected';}?>>นาย</option>
                                    <option value="นาง"  <?php if($teacher['teacher_title']=='นาง'){ echo 'selected';}?>>นาง</option>
                                    <option value="นางสาว"  <?php if($teacher['teacher_title']=='นางสาว'){ echo 'selected';};?>>นางสาว</option>
                                </select>
                                <input type="text" name="fname"  value="<?php echo $teacher['teacher_fname'];?>">
                                <input type="text" name="lname" value="<?php echo $teacher['teacher_lname'];?>">
                                
                            </dd>

                            <dt class="col-sm-3">ตำแหน่ง</dt>
                            <dd class="col-sm-9">
                                <select name="position" id="position">
                                <?php $pStr = "SELECT * FROM position";
                                    $pra = mysqli_query($conn,$pStr) or die(mysqli_error($conn));
                                    while ($position = mysqli_fetch_array($pra)) {
                                ?>
                                    <option value="<?php echo $position['position_id'];?>" <?php if($position['position_id'] == $teacher['position_id']){ echo "selected"; }?>><?php echo $position['position_name'];?></option>
                                    <?php } ?>
                                </select>
                            </dd>

                            <dt class="col-sm-3">สาขา</dt>
                            <dd class="col-sm-9">
                                <select name="major" id="major">
                                <?php $mStr = "SELECT * FROM major";
                                $mrs = mysqli_query($conn,$mStr)or die(mysqli_error($conn));
                                while ($major = mysqli_fetch_array($mrs)) {
                                ?>
                                    <option value="<?php echo $major['major_id'];?>" <?php if($major['major_id']== $teacher['major_id']){ echo "selected";}?>><?php echo $major['major_name'];?></option>
                                <?php } ?>
                                </select>
                            </dd>

                            <dt class="col-sm-3 text-truncate">ฝ่ายงาน</dt>
                            <dd class="col-sm-9">
                                <select name="section" id="section">
                                    <?php $seStr = "SELECT * FROM section";
                                    $sers = mysqli_query($conn,$seStr)or die(mysqli_error($conn));
                                    while($section = mysqli_fetch_array($sers)){
                                    ?>
                                    <option value="<?php echo $section['section_id'];?>" <?php if($section['section_id']== $teacher['section_id']){ echo "selected";}?>><?php echo $section['section_name'];?></option>
                                    <?php }?>
                                </select>
                            </dd>

                            <dt class="col-sm-3 text-truncate">ข้อมูลการติดต่อ</dt>
                            <dd class="col-sm-9"></dd>

                            <dt class="col-sm-3">เบอร์โทร</dt>
                                <dd class="col-sm-9"><input type="text" name="tel" value="<?php echo $teacher['teacher_tel'];?>" >
                            </dd>

                            <dt class="col-sm-3">อีเมล์</dt>
                            <dd class="col-sm-9">
                                <input type="email" name="email" value="<?php echo $teacher['teacher_email'];?>">
                            </dd>

                            <dt class="col-sm-3">รูปประจำตัว</dt>
                            <dd class="col-sm-9">
                                    <input type="file" name="profile_pic"  accept="image/*">
                                    <input type="hidden" name="old_pic" value="<?php echo $teacher['teacher_pic'];?>">
                            
                            </dd>
                            
                            <dt class="col-sm-3"></dt>
                            <dd class="col-sm-9">
                                <button type="submit" name="edit_profile" class="btn btn-primary">อัพเดทข้อมูล</button>
                            </dd>
                            </dl>

                            </form>


                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel">
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
                                <div class="form-group">
                                    <button type="submit" name="changepass" class="btn btn-primary">ยืนยันการเปลี่ยนรหัส</button>
                                </div>    
                            </form>

                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">ออกจากระบบ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<?php mysqli_close($conn);?>
</body>
</html>