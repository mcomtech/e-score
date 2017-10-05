<?php
session_start();
echo $_SESSION['aUser']."<br>";
echo $_SESSION['logged_in']."<br>";
echo $_SESSION['aStatus'];
?>