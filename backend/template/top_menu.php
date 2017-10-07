<!--เมนูด้านบน-->
        <ul class="nav nav-pills justify-content-end">
            <li class="nav-item">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == "student.php"){ echo "active"; } ?>" href="student.php">รายชื่อนักเรียน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == "subject.php"){ echo  "active"; } ?>" href="subject.php">รายวิชาที่สอน</a>
            </li>
            <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
            <li class="nav-item">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == "teacher.php"){ echo  "active"; } ?>" href="teacher.php">รายชื่อครู</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == "class.php"){ echo  "active"; } ?>" href="class.php">ชั้นเรียน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">ภาคเรียน</a>
            </li>
            <? } ?>
            <li class="nav-item">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == "profile.php"){ echo  "active"; } ?>" href="profile.php">ข้อมูลส่วนตัว</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="index.php?logged_out=true">ออกจากระบบ</a>
            </li>
        </ul>
        <!--จบเมนูด้านบน-->