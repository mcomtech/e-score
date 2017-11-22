<?php include("config.php"); 
include('check-session.php');
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
            <?php 
            $stdID = $_SESSION['sID'];
                            $objStr = "SELECT * FROM students AS std,class AS cls,major AS mj
                            WHERE std.class_id = cls.class_id 
                            AND std.major_id = mj.major_id
                            AND std.student_id = '$stdID'";
                            $objrs = mysqli_query($conn,$objStr)or die(mysqli_error($conn));
                            $student = mysqli_fetch_array($objrs);
                            ?>
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="https://placehold.it/200x200" class="img-responsive" alt="" width="50%" height="150">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php echo $student['student_title'];?><?php echo $student['student_fname'];?>  <?php echo $student['student_lname'];?>
                        </div>
                        <div class="profile-usertitle-job">
                            <?php echo $student['major_name'];?>
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
                                <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="material-icons">book</i> รายวิชาที่เรียน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><i class="material-icons">settings</i> แก้ไขข้อมูลส่วนตัว</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?logged_out=true" > <i class="material-icons">exit_to_app</i> ออกจากระบบ</a>
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
                            
                            <strong><h4>ข้อมูลส่วนตัว</h4></strong>
                            <hr>                            
                            <dl class="row">
                            <dt class="col-sm-3">รหัสนักเรียน</dt>
                            <dd class="col-sm-9"><?php echo $student['student_code'];?></dd>

                            <dt class="col-sm-3">ชื่อ</dt>
                            <dd class="col-sm-9"><?php echo $student['student_title'];?><?php echo $student['student_fname'];?>  <?php echo $student['student_lname'];?></dd>

                            <dt class="col-sm-3">ระดับชั้น</dt>
                            <dd class="col-sm-9"><?php echo $student['class_name'];?> <?php echo $student['class_lvl'];?>/<?php echo $student['class_room'];?></dd>

                            <dt class="col-sm-3">สาขา</dt>
                            <dd class="col-sm-9"><?php echo $student['major_name'];?></dd>

                            <dt class="col-sm-3 text-truncate">ประเภท</dt>
                            <dd class="col-sm-9"><?php echo $student['major_type'];?></dd>

                            <dt class="col-sm-3 text-truncate">ข้อมูลการติดต่อ</dt>
                            <dd class="col-sm-9"></dd>

                            <dt class="col-sm-3">เบอร์โทร</dt>
                            <dd class="col-sm-9"><?php echo $student['student_tel'];?></dd>

                            <dt class="col-sm-3">อีเมล์</dt>
                            <dd class="col-sm-9"><?php echo $student['student_email'];?></dd>
                            
                            <dt class="col-sm-3">ที่อยู่ปัจจุบัน</dt>
                            <dd class="col-sm-9"><?php echo $student['student_address'];?></dd>
                            </dl>

                        </div>
                        <div class="tab-pane" id="msg" role="tabpanel">ข้อความ</div>
                        
                        <div class="tab-pane" id="messages" role="tabpanel">
                            <?php 
                            $objTerm ="SELECT * FROM term";
                            $objrs = mysqli_query($conn,$objTerm)or die(mysqli_error($conn));
                            while($term = mysqli_fetch_array($objrs)){ ?>
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>ภาคเรียนที่ <?php echo $term['term_part'];?>/<?php echo $term['term_year'];?></th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr><td>
                                    <table class="table table-sm" id="myTable" style="font-size:12px;">
                                    <thead>
                                        <tr>
                                        <th>รหัสวิชา</th>
                                        <th>ชื่อวิชา</th>
                                        <th>ผู้สอน</th>
                                        <th>นก</th>
                                        <th>เกรด</th>
                                        <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $stdID = $_SESSION['sID'];
                                            $str = "SELECT * FROM subject AS sj, teachers AS t ,term AS term , course AS co
                                            WHERE sj.teacher_id = t.teacher_id 
                                            AND sj.term_id = term.term_id 
                                            AND co.subject_id = sj.subject_id
                                            AND co.student_id = '$stdID'
                                            AND sj.term_id = '$term[term_id]'";
                                        $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
                                        $total_unit = 0;
                                        $total_grade = 0;
                                        $grade_avg = 0;
                                        while($subj = mysqli_fetch_array($rs)){
                                            $total_unit = $total_unit + $subj['subject_unit'];
                                            $total_grade = $total_grade + ( $subj['subject_unit'] * $subj['course_grade']);
                                            $grade_avg = $total_grade / $total_unit;
                                        ?>
                                        <tr>
                                            <td><?php echo $subj['subject_code'];?></td>
                                            <td><?php echo $subj['subject_name'];?></td>
                                            <td>อ.<?php echo $subj['teacher_fname'];?>  <?php echo $subj['teacher_lname'];?></td>
                                            <td><?php echo $subj['subject_unit'];?></td>
                                            <td><?php echo $subj['course_grade'];?></td>
                                            <td>
                                            <a href="score-detail.php?subject=<?php echo $subj['subject_id'];?>&student=<?php echo $stdID;?>" class="btn btn-sm btn-success">คะแนน</a>
                                            <!--ปุ่มลงคะแนน-->
                                            <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
                                            <a href="add_score.php?subject=<?php echo $subj['subject_id'];?>&student=<?php echo $stdID;?>" class="btn btn-warning btn-sm">ลงคะแนน</a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                    <tfoot >
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php if($total_unit==0){echo "";}else{echo $total_unit;}?></td>
                                            <td><strong><?php if($grade_avg==0){echo "";}else{echo substr($grade_avg,0,strpos($grade_avg,'.')+3);}?></strong></td>
                                            <td></td>
                                        
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                </td></tr>
                               </tbody>
                               
                            </table> 
                            
                            <?php } ?>
                            

                        
                        
                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <strong><h4>ข้อมูลส่วนตัว</h4></strong>
                            <hr>
                            <form action="index.php" method="post">                               
                            <dl class="row">
                            <dt class="col-sm-3">รหัสนักเรียน</dt>
                            <dd class="col-sm-9"><?php echo $student['student_code'];?></dd>

                            <dt class="col-sm-3">ชื่อ</dt>
                            <dd class="col-sm-9"><?php echo $student['student_title'];?><?php echo $student['student_fname'];?>  <?php echo $student['student_lname'];?></dd>

                            <dt class="col-sm-3">ระดับชั้น</dt>
                            <dd class="col-sm-9"><?php echo $student['class_name'];?> <?php echo $student['class_lvl'];?>/<?php echo $student['class_room'];?></dd>

                            <dt class="col-sm-3">สาขา</dt>
                            <dd class="col-sm-9"><?php echo $student['major_name'];?></dd>

                            <dt class="col-sm-3 text-truncate">ประเภท</dt>
                            <dd class="col-sm-9"><?php echo $student['major_type'];?></dd>
                                               
                            <dt class="col-sm-3 text-truncate">ข้อมูลการติดต่อ</dt>
                            <dd class="col-sm-9"></dd>

                                             
                            <dt class="col-sm-3">เบอร์โทร</dt>
                            <dd class="col-sm-9"><input type="text" name="tel" value="<?php echo $student['student_tel'];?>"></dd>

                            <dt class="col-sm-3">อีเมล์</dt>
                            <dd class="col-sm-9">
                            <input type="text" name="email" value="<?php echo $student['student_email'];?>"></dd>
                            
                            <dt class="col-sm-3">ที่อยู่ปัจจุบัน</dt>
                            <dd class="col-sm-9"><textarea name="address" cols="30" rows="10"><?php echo $student['student_address'];?></textarea></dd>
                            
                            <dt class="col-sm-3"></dt>
                            <dd class="col-sm-9"><input type="submit" name="update_profile" value="แก้ไขข้อมูล" class="btn btn-sm btn-primary"></dd>
                            </dl>
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