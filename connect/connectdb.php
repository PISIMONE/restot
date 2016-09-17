<?php
$conuname="";
$conupass="";
$condbname="";
$mycon=mysql_connect("localhost", $conuname, $conupass) or die("Cannot connect to mysql.");
mysql_select_db($condbname, $mycon) or die ("Unable to select database.");
?>