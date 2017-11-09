<?php include("config.php"); 
include('check-session.php');

if(isset($_POST['add_teacher'])){
    $username = $_POST['username'];
    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $public_id = $_POST['public_id'];
    $password = md5($_POST['public_id']);
    $string = "INSERT INTO teachers(teacher_id,username,password,teacher_title,teacher_fname,teacher_lname,major_id,position_id,section_id,status,teacher_public_id)
                VALUES('','$username','$password','$title','$fname','$lname','2','4','1','USER','$public_id')";
    mysqli_query($conn,$string)or die($mysqli_error($conn));
    
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_teacher">
        เพิ่มครูใหม่
        </button>
    </div>
    <?php } ?>
    </div>
    </p>

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th><th>ชื่อ - นามสกุล</th><th>ตำแหน่ง</th><th>สาขา</th><th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $str = "SELECT * FROM teachers AS tc,position AS ps,major AS mj WHERE tc.position_id = ps.position_id AND tc.major_id = mj.major_id";
            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
            $i =1;
            while($tss = mysqli_fetch_array($rs)){
            ?>
            <tr>
                <td>
                    <?php echo $i;?>
                </td>
                <td>
                   อ.<?php echo $tss['teacher_fname'];?>  <?php echo $tss['teacher_lname'];?>  
                </td>
                <td>
                   <?php echo $tss['position_name'];?>
                </td>
                <td>
                     <?php echo $tss['major_name'];?>
                </td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_teacher<?php echo $i;?>">แก้ไข</a>
                    <!-- Modal Edit TEACHER -->
                    <div class="modal fade" id="edit_teacher<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" class="form">
                                <div class="form-group">
                                    <label for="code" class="col-md-4">ชื่อผู้ใช้งาน</label>
                                    <input type="text" placeholder="username" name="username" autofocus value="<?php echo $tss['username'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-md-4">คำนำหน้า</label>
                                    <select name="title">
                                        <option value="นาย" <?php if($tss['teacher_title']=="นาย"){echo "selected"; }?>>นาย</option>
                                        <option value="นางสาว" <?php if($tss['teacher_title']=="นางสาว"){echo "selected"; }?>>นางสาว</option>
                                        <option value="นาง" <?php if($tss['teacher_title']=="นาง"){echo "selected"; }?>>นาง</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fname" class="col-md-4">ชื่อ</label>
                                    <input type="text" placeholder="ชื่อ" name="fname" value="<?php echo $tss['teacher_fname'];?>">    
                                </div>
                                <div class="form-group">
                                    <label for="lname"  class="col-md-4">นามสกุล</label>
                                    <input type="text" placeholder="นามสกุล" name="lname" value="<?php echo $tss['teacher_lname'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="id" class="col-md-4">เลขบัตรประชาชน</label>
                                    <input type="text" name="public_id" placeholder="หมายเลขบัตรประชาชน" value="<?php echo $tss['teacher_public_id'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="position" class="col-md-4">ตำแหน่ง</label>
                                    <select name="position" id="position">
                                    <?php $pStr = "SELECT * FROM position";
                                        $pra = mysqli_query($conn,$pStr) or die(mysqli_error($conn));
                                        while ($position = mysqli_fetch_array($pra)) {
                                    ?>
                                        <option value="<?php echo $position['position_id'];?>" <?php if($position['position_id'] == $tss['position_id']){ echo "selected"; }?>><?php echo $position['position_name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="major" class="col-md-4">สาขา</label>
                                    <select name="major" id="major">
                                    <?php $mStr = "SELECT * FROM major";
                                    $mrs = mysqli_query($conn,$mStr)or die(mysqli_error($conn));
                                    while ($major = mysqli_fetch_array($mrs)) {
                                    ?>
                                        <option value="<?php echo $major['major_id'];?>" <?php if($major['major_id']== $tss['major_id']){ echo "selected";}?>><?php echo $major['major_name'];?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="section" class="col-md-4">ฝ่ายงาน</label>
                                    <select name="section" id="section">
                                        <?php $seStr = "SELECT * FROM section";
                                        $sers = mysqli_query($conn,$seStr)or die(mysqli_error($conn));
                                        while($section = mysqli_fetch_array($sers)){
                                        ?>
                                        <option value="<?php echo $section['section_id'];?>" <?php if($section['section_id']== $tss['section_id']){ echo "selected";}?>><?php echo $section['section_name'];?></option>
                                        <?php }?>
                                    </select>   
                                </div>            


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="edit_teacher" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                        </div>
                        </form>
                    </div>
                    </div>


                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>

    <!-- Modal add students -->
    <div class="modal fade" id="add_teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มครูใหม่</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post" class="form">
                <div class="form-group">
                    <label for="code" class="col-md-4">ชื่อผู้ใช้งาน</label>
                    <input type="text" placeholder="username" name="username" autofocus>
                </div>
                <div class="form-group">
                    <label for="title" class="col-md-4">คำนำหน้า</label>
                    <select name="title">
                    <option value="นาย">นาย</option>
                    <option value="นางสาว">นางสาว</option>
                    <option value="นาง">นาง</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fname" class="col-md-4">ชื่อ</label>
                    <input type="text" placeholder="ชื่อ" name="fname">    
                </div>
                <div class="form-group">
                    <label for="lname"  class="col-md-4">นามสกุล</label>
                    <input type="text" placeholder="นามสกุล" name="lname" >
                </div>
                <div class="form-group">
                    <label for="id" class="col-md-4">เลขบัตรประชาชน</label>
                    <input type="text" name="public_id" placeholder="หมายเลขบัตรประชาชน">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="add_teacher" class="btn btn-primary">บันทึกข้อมูล</button>
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