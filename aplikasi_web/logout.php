<?php 
session_start();
//session_destroy();
unset($_SESSION['username']);
unset($_SESSION['nama_lengkap']);
//update
//kolom status_login itu menjadi 0
header("location:index.php");

?>