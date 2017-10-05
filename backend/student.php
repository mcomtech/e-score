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

    <div class="jumbotron">
        <div class="container">
            <h1>ระบบจัดการผลการเรียนออนไลน์</h1>
            <h4>จัดการนักเรียน</h4>
        </div>
    </div>
    <div class="container">
        <?php include('template/top_menu.php')?>

    <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
    <!-- add student btn -->
    <div class="form-group">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    เพิ่มนักเรียนใหม่
    </button>
    </div>
    <?php } ?>

    <table class="table" id="myTable">
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
                <td><a href="#"><i class="material-icons">visibility</i></a>
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
                <input type="text" placeholder="รหัสนักเรียน" name="code" class="form-control">
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
                    <option value="<?php echo $cls['class_id'];?>"><?php echo $cls['class_name'];?> <?php echo $cls['class_lvl'];?>/<?php echo $cls['class_room'];?></option>
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
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
<?php mysqli_close($conn);?>
</body>
</html>