<?php include("config.php"); 
include('check-session.php');
if(isset($_POST['add_cls'])){
    
    //โค้ดเพิมข้อมูลชั้นเรียนตรงนี้นะ
    $name = $_POST['name'];
    $lvl =  $_POST['lvl'];
    $room = $_POST['room'];
    $teacher = $_POST['teacher'];

    $str = "INSERT INTO class(class_id,class_name,class_lvl,class_room,teacher_id)
            VALUES('','$name','$lvl','$room','$teacher')";
            mysqli_query($conn,$str);

}

if(isset($_POST['confirmEdit'])){
    
    //โค้ดเพิมข้อมูลชั้นเรียนตรงนี้นะ
    $class = $_POST['class'];
    $name = $_POST['name'];
    $lvl =  $_POST['lvl'];
    $room = $_POST['room'];
    $teacher = $_POST['teacher'];

    $str = "UPDATE class SET
            class_name = '$name',
            class_lvl = '$lvl',
            class_room = '$room',
            teacher_id = '$teacher'
            WHERE class_id = '$class'";
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
    <?php include('template/top_menu.php')?>
    <p>
    <div class="row">
    <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
    <!-- add student btn -->
    <div class="col-md-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    เพิ่มห้องเรียนใหม่
    </button>
    </div>
    <?php } ?>
    </div>
    </p>

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th><th>ระดับชั้น</th><th>จำนวนนักเรียน</th><th>ครูที่ปรึกษา</th><th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $str = "SELECT * FROM teachers , class 
            WHERE teachers.teacher_id = class.teacher_id";
            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
            $i =1;
            while($cls = mysqli_fetch_array($rs)){
            ?>
            <tr>
                <td>
                    <?php echo $i;?>
                </td>
                <td>
                    <?php echo $cls['class_name'];?> <?php echo $cls['class_lvl'];?>/<?php echo $cls['class_room'];?>
                </td>
                <td>
                <?php 
                //จำนวนนักเรียน
                $str2 = "SELECT * FROM students AS std WHERE std.class_id ='$cls[class_id]'";
                $rs2 = mysqli_query($conn,$str2)or die(mysqli_error($conn));
                $nums = mysqli_num_rows($rs2);
                echo $nums;
                ?>
                </td>
                <td>
                    อ.<?php echo $cls['teacher_fname'];?>  <?php echo $cls['teacher_lname'];?>  
                </td>
                <td>
                    <a href="student.php?class=<?php echo $cls['class_id'];?>" class="btn btn-warning btn-sm">รายชื่อนักเรียน</a>
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editClass<?php echo $cls['class_id'];?>">แก้ไข</a>
                    <!--Modalสำหรับแก้ไขชั้นเรียน-->
                <div class="modal fade" id="editClass<?php echo $cls['class_id'];?>" tabindex="-1" role="dialog" aria-labelledby="editClass" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขห้องเรียน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" >
                            <div class="col-md-12 c-box ">
                                <div class="form-group">
                                    <input type="hidden" name="class" value="<?php echo $cls['class_id'];?>">
                                    <label for="name" class="col-md-2">ระดับชั้น</label>
                                    <select name="name" id="name">
                                        <option value="ปวช." <?php if($cls['class_name'] == 'ปวช.'){ echo "selected";}?>>ปวช</option>
                                        <option value="ปวส." <?php if($cls['class_name'] == 'ปวส.'){ echo "selected";}?>>ปวส</option>
                                    </select>
                                    <label for="year" >ชั้นปี</label>
                                    <input type="number" name="lvl" id="year" min="1" max="999"  value="<?php echo $cls['class_lvl'];?>" >
                                    <label for="room" >/</label>
                                    <input type="number" name="room" id="room" min="1" max="999" value="<?php echo $cls['class_room'];?>">
                                </div><div class="form-group">
                                    <label for="class" class="col-md-2">ครูประจำชั้น</label>
                                    <select name="teacher">
                                            <?php 
                                            $str3 = "SELECT * FROM teachers";
                                            $rs3 = mysqli_query($conn,$str3)or die(mysqli_error($conn));
                                            while($tea3 = mysqli_fetch_array($rs3)){
                                            ?>
                                                <option value="<?php echo $tea3['teacher_id'];?>" <?php if($tea3['teacher_id'] == $cls['teacher_id']){ echo "selected";}?> >อ.<?php echo $tea3['teacher_fname'];?> <?php echo $tea3['teacher_lname'];?></option>
                                            <?php } ?>
                                            </select>
                                </div>
                        </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                        <button type="submit" name="confirmEdit" class="btn btn-primary">บันทึก</button>
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
            <form action="" method="post" class="form">
            <div class="col-md-12 c-box ">
                <div class="form-group">
                    <label for="name" class="col-md-2">ระดับชั้น</label>
                    <select name="name" id="name">
                        <option value="ปวช.">ปวช</option>
                        <option value="ปวส.">ปวส</option>
                    </select>
                    <label for="year" >ชั้นปี</label>
                    <input type="number" name="lvl" id="year" min="1" max="999" value="1">
                    <label for="room">/</label>
                    <input type="number" name="room" id="room" min="1" max="999" value="1">
                    </div><div class="form-group">
                    <label for="class" class="col-md-2">ครูประจำชั้น</label>
                    <select name="teacher" >
                            <?php 
                            $str = "SELECT * FROM teachers";
                            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
                            while($tea = mysqli_fetch_array($rs)){
                            ?>
                                <option value="<?php echo $tea['teacher_id'];?>">อ.<?php echo $tea['teacher_fname'];?> <?php echo $tea['teacher_lname'];?></option>
                            <?php } ?>
                            </select>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="add_cls" class="btn btn-primary">บันทึกข้อมูล</button>
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