<?php include("config.php");
include('check-session.php'); 

if(isset($_POST['add_subject'])){
    $code=$_POST['code'];
    $name=$_POST['name'];
    $unit=$_POST['unit'];
    $teach = $_POST['teacher'];
    $term = $_POST['term'];

    $str="INSERT INTO subject(subject_id,subject_code,subject_name,subject_unit,teacher_id,term_id)
          VALUES ('','$code','$name','$unit','$teach','$term')";
    mysqli_query($conn,$str)or die(mysqli_error($conn));
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include('template/_header.php');?>
    <div class="container bgcolor">
        <?php include('template/top_menu.php')?>
    <p>
        <div class="row">
            <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
            <!-- add student btn -->
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    เพิ่มรายวิชาใหม่ 
                </button>
            </div>
            <? } ?>
        </div>
    </p>
    
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th><th>รหัสวิชา</th><th>ชื่อวิชา</th><th>หน่วยกิต</th><th>ภาคเรียน</th><th>ผู้สอน</th><th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user = $_SESSION['aUser'];
            if($_SESSION['aStatus']=='ADMIN'){
                $str = "SELECT * FROM subject AS sj, teachers AS t ,term AS term
                WHERE sj.teacher_id = t.teacher_id 
                AND sj.term_id = term.term_id";
            
            } else{
                $str = "SELECT * FROM subject AS sj, teachers AS t ,term AS term
                WHERE sj.teacher_id = t.teacher_id 
                AND sj.term_id = term.term_id 
                AND t.username ='$user'";
            
            }

            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
            $i = 1;
            while($subj = mysqli_fetch_array($rs)){
                
            ?>
            <tr><td><?php echo $i;?></td>
                <td><?php echo $subj['subject_code'];?></td>
                <td><?php echo $subj['subject_name'];?></td>
                <td><?php echo $subj['subject_unit'];?></td>
                <td>ภาคเรียนที่ <?php echo $subj['term_part'];?> / <?php echo $subj['term_year'];?></td>
                <td>อ.<?php echo $subj['teacher_fname'];?>  <?php echo $subj['teacher_lname'];?></td>
                <td>
                <!--ปุ่มลงคะแนน-->
                <a href="score.php?subject=<?php echo $subj['subject_id'];?>&search=%E0%B8%84%E0%B9%89%E0%B8%99%E0%B8%AB%E0%B8%B2" class="btn btn-warning btn-sm">ลงคะแนน</a>
                <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
                <!-- ปุ่มแก้ไขรายวิชา-->
                <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editSub<?php echo $subj['subject_id'];?>" >แก้ไข</a>

                <!-- Modal Edit subject -->
                <div class="modal fade" id="editSub<?php echo $subj['subject_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายวิชา</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" method="post">
                            <input type="hidden" name="subject" value="<?php echo $subj['subject_id'];?>">
                            <div class="container">
                            <div class="form-group">
                                <label for="fname" class="col-sm-4">รหัสวิชา</label>
                                <input type="text" placeholder="รหัสวิชา" name="code" value="<?php echo $subj['subject_code'];?>" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="fname" class="col-sm-4">ชื่อรายวิชา</label>
                                <input type="text" placeholder="ชื่อวิชา" name="name" value="<?php echo $subj['subject_name'];?>">
                            </div>
                            <div class="form-group">
                                <label for="unit" class="col-sm-4">หน่วยกิต</label>
                                <input type="number" placeholder="หน่วยกิต" name="unit" min="1" max="10"  value="<?php echo $subj['subject_unit'];?>">
                            </div>
                            <div class="form-group">
                                <label for="term" class="col-sm-4">ภาคเรียน</label>
                                <select name="term" id="term" >
                                <?php 
                                $obstr = "SELECT * FROM term";
                                $obrs = mysqli_query($conn,$obstr)or die(mysqli_error($conn));
                                while($terms = mysqli_fetch_array($obrs)){
                                ?>
                                <option value="<?php echo $terms['term_id'];?>" <?php if($terms['term_id']==$subj['term_id']){ echo "selected"; }?>>
                                    ภาคเรียนที่ <?php echo $terms['term_part'];?> / <?php echo $terms['term_year'];?>
                                </option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="teacher" class="col-sm-4">ผู้สอน</label>
                                <select name="teacher" id="teacher">
                                <?php 
                                $ojstr = "SELECT * FROM teachers";
                                $ojrs = mysqli_query($conn,$ojstr)or die(mysqli_error($conn));
                                while($teachs = mysqli_fetch_array($ojrs)){
                                ?>
                                <option value="<?php echo $teachs['teacher_id'];?>" <?php if($teachs['teacher_id']==$subj['teacher_id']){ echo "selected"; }?>>
                                    อ.<?php echo $teachs['teacher_fname'];?>  <?php echo $teachs['teacher_lname'];?>
                                </option>
                                <?php } ?>
                                </select>
                            </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">เลิก</button>
                        <button type="submit" name="edit_subject" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                    </div>
                    </form>
                </div>
                </div>   

                <!--ปุ่มลบ-->
                <a href="javascript:void" onclick='delConfirm(<?php echo $subj['subject_id'];?>)' class="btn btn-danger btn-sm">ลบวิชา</a>
                <?php } ?>
                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>





    <!-- Modal add subject -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มรายวิชาใหม่</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
            <div class="container">
            <div class="form-group">
                <label for="fname" class="col-sm-4">รหัสวิชา</label>
                <input type="text" placeholder="รหัสวิชา" name="code"  autofocus>
            </div>
            <div class="form-group">
                <label for="fname" class="col-sm-4">ชื่อรายวิชา</label>
                <input type="text" placeholder="ชื่อวิชา" name="name">
            </div>
            <div class="form-group">
                <label for="unit" class="col-sm-4">หน่วยกิต</label>
                <input type="number" placeholder="หน่วยกิต" name="unit" min="1" max="10"  value="3">
            </div>
            <div class="form-group">
                <label for="term" class="col-sm-4">ภาคเรียน</label>
                <select name="term" id="term" >
                <?php 
                $str = "SELECT * FROM term";
                $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
                while($term = mysqli_fetch_array($rs)){
                ?>
                <option value="<?php echo $term['term_id'];?>">
                    ภาคเรียนที่ <?php echo $term['term_part'];?> / <?php echo $term['term_year'];?>
                </option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="teacher" class="col-sm-4">ผู้สอน</label>
                <select name="teacher" id="teacher">
                <?php 
                $str = "SELECT * FROM teachers";
                $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
                while($teach = mysqli_fetch_array($rs)){
                ?>
                <option value="<?php echo $teach['teacher_id'];?>">
                    อ.<?php echo $teach['teacher_fname'];?>  <?php echo $teach['teacher_lname'];?>
                </option>
                <?php } ?>
                </select>
            </div>

            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">เลิก</button>
            <button type="submit" name="add_subject" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
        </div>
        </form>
    </div>
    </div>







        
    </div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    function delConfirm(subject){
        var r = confirm("คุณต้องการที่จะลบรายวิชานี้หรือไม่ !");
        if (r == true) {
            window.location='delete.php?act=del_subject&subject='+subject;
        } 
    }

    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
<?php mysqli_close($conn);?>
    
</body>
</html>