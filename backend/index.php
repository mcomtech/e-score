<?php
include('check-session.php');
if(!empty($_GET['logged_out'])){
    if($_GET['logged_out']=='true'){
        session_destroy();
        echo "<script>window.location='login.php';</script>";   
    }
}
echo "<script>window.location='subject.php';</script>";
?>
<!DOCTYPE html>
<html lang="TH">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>