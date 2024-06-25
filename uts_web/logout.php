<?php
session_start();
session_unset();
session_destroy(); 

setcookie('id', '' , time()-3600); // murdukan satu jam
setcookie('key', '' , time()-3600);

header("location: login.php");
exit;
?>