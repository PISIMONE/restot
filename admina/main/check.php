<?php
session_start();
$user_check=$_SESSION['login_user'];
if($user_check=="")
	{
	header("Location: ../index.php");
	}	
	$ses_sql=mysql_query("select adiname from adiusers where adiname='$user_check'");	
	$row=mysql_fetch_array($ses_sql);	
	$login_session=$row['adiname'];	
	if(!isset($login_session))
	{
	header("Location: ../index.php");
	}
?>