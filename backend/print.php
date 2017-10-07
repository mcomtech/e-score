<?php
include('config.php');
include('mpdf/mpdf.php');
 // ทำการเก็บค่า html นะครับ
$objstr = "SELECT * FROM class where class_id = '".$_POST['class']."'";
$objrs = mysqli_query($conn,$objstr)or die(mysqli_error($conn));
$class = mysqli_fetch_array($objrs);

$sjStr = "SELECT * FROM subject ,term WHERE subject.term_id = term.term_id AND subject.subject_id = '".$_POST['subject']."'";
$sjrs = mysqli_query($conn,$sjStr)or die(mysqli_error($conn));
$subject = mysqli_fetch_array($sjrs);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Trirong" rel="stylesheet">
    <link rel="stylesheet" href="css/print.css">
</head>
<?php ob_start();?>
<body>
<h4>รายวิชา <?php echo $subject['subject_name'];?> ภาคเรียนที่ <?php echo $subject['term_part'];?> / <?php echo $subject['term_year'];?> <br>
รายชื่อนักศึกษา <?php echo $class['class_name'];?> <?php echo $class['class_lvl'];?>/<?php echo $class['class_room'];?> </h4>

    <table border="1" >
        <thead>
            <tr>
                <th>รหัสประจำตัว</th><th>ชื่อ</th><th>นามสกุล</th><th>ห้อง</th><th>เกรด</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $str = "SELECT * FROM students , class ,course WHERE students.class_id = class.class_id AND course.student_id = students.student_id AND students.class_id='".$_POST['class']."' AND course.subject_id = '".$_POST['subject']."'";     
            $rs = mysqli_query($conn,$str)or die(mysqli_error($conn));
            while($std = mysqli_fetch_array($rs)){
            ?>
            <tr>
                <td><?php echo $std['student_code'];?></td>
                <td><?php echo $std['student_title'];?><?php echo $std['student_fname'];?></td>
                <td><?php echo $std['student_lname'];?></td>
                <td><?php echo $std['class_name'];?> <?php echo $std['class_lvl'];?>/<?php echo $std['class_room'];?></td>
                <td><?php echo $std['course_grade'];?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<?php
$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html 
ob_end_clean();
$style =  file_get_contents('css/print.css');
$pdf = new mPDF('th', 'A4', '0', '');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($style, 1);
$pdf->WriteHTML($html, 2);
$pdf->Output();         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
?>
<?php mysqli_close($conn);?>
</body>
</html>