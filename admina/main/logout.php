<?php
session_start();
session_destroy();
$_SESSION = array();
$_SESSION['login_user']=null;
$msg="You have successfully logout. Thankyou! ";
header("Location: ../index.php");
?>