<header>
        <div class="col-ld-12 img-bg"></div>
        <div class="container">
            <div class="h-box">
            <h1>ระบบจัดการผลการเรียนออนไลน์</h1>
            <?php 
            if(basename($_SERVER['PHP_SELF']) == "student.php")
            { 
                echo "<h4>จัดการนักเรียน</h4>"; 
            } else if(basename($_SERVER['PHP_SELF']) == "add_score.php") {
                echo "<h4>จัดการคะแนน</h4>";
            } elseif(basename($_SERVER['PHP_SELF']) == "class.php") {
                 echo "<h4>จัดการชั้นเรียน</h4>"; 
            } elseif(basename($_SERVER['PHP_SELF']) == "subject.php") {
                 echo "<h4>จัดการรายวิชา</h4>"; 
            }elseif(basename($_SERVER['PHP_SELF']) == "teacher.php") {
                 echo "<h4>จัดการผู้สอน</h4>"; 
            }elseif(basename($_SERVER['PHP_SELF']) == "class.php") {
                 echo "<h4>จัดการชั้นเรียน</h4>"; 
            }elseif(basename($_SERVER['PHP_SELF']) == "profile.php") {
                 echo "<h4>จัดการบัญชี</h4>"; 
            }elseif(basename($_SERVER['PHP_SELF']) == "term.php") {
                 echo "<h4>จัดการภาคเรียน</h4>"; 
            }elseif(basename($_SERVER['PHP_SELF']) == "score.php") {
                 echo "<h4>จัดการคะแนนนักเรียน</h4>"; 
            }elseif(basename($_SERVER['PHP_SELF']) == "select_student.php") {
                 echo "<h4>เลือกนักเรียนเข้ารายวิชา</h4>"; 
            }elseif(basename($_SERVER['PHP_SELF']) == "std-info.php") {
                 echo "<h4>ข้อมูลนักเรียน</h4>"; 
            }
            ?>
            </div>
        </div>
    </div>
</header>