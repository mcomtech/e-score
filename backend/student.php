<?php include("config.php"); 
include('check-session.php');
if(isset($_POST['add_std'])){
    
    //โค้ดเพิมข้อมูลนักศึกษาตรงนี้นะ
    $code = $_POST['code'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $title = $_POST['title'];
    $class = $_POST['class'];

    $str = "INSERT INTO students(student_id,student_code,student_title,student_fname,student_lname,class_id) 
            VALUES ('','$code','$title','$fname','$lname','$class')";
            mysqli_query($conn,$str);

}

if(isset($_POST['edit_student'])){
    
    //โค้ดแก้ไขข้อมูลนักศึกษา
    $std_id = $_POST['student_id'];
    $code = $_POST['code'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $title = $_POST['title'];
    $class = $_POST['class'];

    $str = "UPDATE students SET
            student_code = '$code',
            student_title ='$title',
            student_fname ='$fname',
            student_lname = '$lname',
            class_id = '$class'
            WHERE student_id = '$std_id'";
            mysqli_query($conn,$str);

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
        <?php include('template/top_menu.php');?>
    <p>
    <div class="row">   
    
    <!-- add student btn -->
    <div class="col-md-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    เพิ่มนักเรียนใหม่
    </button>
    </div>
    
    <div class="col-md-4">
        <form action="" method="get">
        <div class="input-group">
            <select name="class" id="class" class="wp" placeholder="เลือกชั้นเรียน" aria-label="เลือกชั้นเรียน">
                <?php 
                $teacher = $_SESSION['aID'];
                if($_SESSION['aStatus']=='ADMIN'){ 
                    $str2 = "";
                }else{
                    $str2 = " WHERE teacher_id = '$teacher'";
                }
                
                $strClass = "SELECT * FROM class".$str2;
                $rsClass = mysqli_query($conn,$strClass)or die(mysqli_error($conn));
                while($objClass = mysqli_fetch_array($rsClass)){ 
                if(!empty($_GET['class']) && $_GET['class'] == $objClass['class_id']){
                $sta = "selected";
                }else{
                $sta = "";
                }
                 ?>
                <option value="<?php echo $objClass['class_id'];?>" <?php echo $sta;?>>
                <?php echo $objClass['class_name'];?> <?php echo $objClass['class_lvl'];?>/<?php echo $objClass['class_room'];?>
                </option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">ค้นหา!</button>
            </span>
        </div>
        </form>
    </div>
    </div>
    </p>

    <table class="table" id="myTable" data-page-length='25'>
        <thead>
            <tr>
                <th>รหัสประจำตัว</th><th>ชื่อ</th><th>นามสกุล</th><th>ห้อง</th><th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $tid = $_SESSION['aID'];
            if($_SESSION['aStatus']=='ADMIN'){
                if(!empty($_GET['class'])){
                    $gclass = $_GET['class'];
                    $ss2 = " AND class.class_id ='$gclass'";
                }else{
                    $ss2 ="";
                }
                $str = "SELECT * FROM students , class 
                WHERE students.class_id = class.class_id ".$ss2;
            }else{
                if(!empty($_GET['class'])){
                    $gclass = $_GET['class'];
                    $ss2 = " AND class.class_id ='$gclass'";
                }else{
                    $ss2 ="";
                }
                $str = "SELECT * FROM students , class 
                WHERE students.class_id = class.class_id 
                AND class.teacher_id='$tid'".$ss2;
            }
            
            
            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
            while($std = mysqli_fetch_array($rs)){
            ?>
            <tr>
                <td><?php echo $std['student_code'];?></td>
                <td><?php echo $std['student_title'];?><?php echo $std['student_fname'];?></td>
                <td><?php echo $std['student_lname'];?></td>
                <td><?php echo $std['class_name'];?> <?php echo $std['class_lvl'];?>/<?php echo $std['class_room'];?></td>
                <td><a href="std-info.php?student=<?php echo $std['student_id'];?>" class="btn btn-sm btn-primary">ดูข้อมูล</a>
                 <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSTD<?php echo $std['student_id'];?>">แก้ไข</a>
                    <a href="#" onclick="delStd(<?php echo $std['student_id'];?>)" class="btn btn-danger btn-sm">ลบ</a>
                 <?php } ?>

                    <!-- แก้ไขรายชื่อนักเรียน -->
                <div class="modal fade" id="editSTD<?php echo $std['student_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลนักเรียน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="post" class="form">
                        <input type="hidden" name="student_id" value="<?php echo $std['student_id'];?>">
                        <div class="form-group">
                            <label for="code" class="col-md-4">รหัสประจำตัว</label>
                            <input type="text" placeholder="รหัสนักเรียน" name="code" value="<?php echo $std['student_code'];?>">
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-md-4">คำนำหน้า</label>
                            <select name="title">
                                <option value="นาย" <?php if($std['student_title']=="นาย"){echo "selected"; }?>>นาย</option>
                                <option value="นางสาว" <?php if($std['student_title']=="นางสาว"){echo "selected"; }?>>นางสาว</option>
                                <option value="นาง" <?php if($std['student_title']=="นาง"){echo "selected"; }?>>นาง</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fname" class="col-md-4">ชื่อ</label>
                            <input type="text" placeholder="ชื่อ" name="fname"  value="<?php echo $std['student_fname'];?>">
                        </div>
                        <div class="form-group">
                            <label for="lname" class="col-md-4">นามสกุล</label>
                            <input type="text" placeholder="นามสกุล" name="lname"  value="<?php echo $std['student_lname'];?>">
                        </div>
                        <div class="form-group">
                            <label for="class" class="col-md-4">ห้อง</label>
                            <select name="class">
                            <?php 
                            $strs = "SELECT * FROM class";
                            $rss = mysqli_query($conn,$strs)or die(mysqli_error($conn));
                            while($clss = mysqli_fetch_array($rss)){
                            ?>
                                <option value="<?php echo $clss['class_id'];?>"<?php if($std['class_id']==$clss['class_id']){echo "selected"; }?>>
                                    <?php echo $clss['class_name'];?> <?php echo $clss['class_lvl'];?>/<?php echo $clss['class_room'];?>
                                </option>
                            <?php } ?>
                            </select>
                        </div>
                    
                    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_student" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                    </div>
                    </form>
                </div>
                </div>

            <!-- สิ้นสุด Modal แก้ไข -->

                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal add students -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มนักเรียนใหม่</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
            <div class="col-md-12 c-box ">

            
            <div class="form-group">
                <label for="code">รหัสประจำตัว</label>
                <input type="text" placeholder="รหัสนักเรียน" name="code" class="form-control" autofocus>
                <label for="title">คำนำหน้า</label>
                <select name="title" class="form-control">
                    <option value="นาย">นาย</option>
                    <option value="นางสาว">นางสาว</option>
                    <option value="นาง">นาง</option>
                </select>
                <label for="fname">ชื่อ</label>
                <input type="text" placeholder="ชื่อ" name="fname" class="form-control">
                <label for="lname">นามสกุล</label>
                <input type="text" placeholder="นามสกุล" name="lname" class="form-control">
                <label for="class">ห้อง</label>
                <select name="class" class="form-control">
                <?php 
                $str = "SELECT * FROM class";
                $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
                while($cls = mysqli_fetch_array($rs)){
                ?>
                    <option value="<?php echo $cls['class_id'];?>" <?php if(@$_GET['class']==$cls['class_id']){echo "selected"; }?>><?php echo $cls['class_name'];?> <?php echo $cls['class_lvl'];?>/<?php echo $cls['class_room'];?></option>
                <?php } ?>
                </select>
                
            </div>
            <div class="form-group">
                
            </div>

            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add_std" class="btn btn-primary">บันทึกข้อมูล</button>
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
    function delStd(student){
        var r = confirm("คุณต้องการที่จะลบนักเรียนรายนี้หรือไม่ !");
        if (r == true) {
            window.location='delete.php?act=del_student&student='+student;
        } 
    }

    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
<?php mysqli_close($conn);?>
</body>
</html>