<!--เมนูด้านบน-->
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="student.php">รายชื่อนักเรียน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="subject.php">รายวิชาที่สอน</a>
            </li>
            <?php if($_SESSION['aStatus']=='ADMIN'){ ?>
            <li class="nav-item">
                <a class="nav-link" href="#">รายชื่อครู</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="class.php">ชั้นเรียน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">ภาคเรียน</a>
            </li>
            <? } ?>
            <li class="nav-item">
                <a class="nav-link" href="#">ข้อมูลส่วนตัว</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="index.php?logged_out=true">ออกจากระบบ</a>
            </li>
        </ul>
        <!--จบเมนูด้านบน-->