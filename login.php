<?php

include("connect/connectdb.php");

session_start();
$msg=null;
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
	$msg=null;
	$uname=addslashes($_POST['nname']);
	$upass=addslashes($_POST['npass']);
	if($uname==""&&$upass==""&&$uname==null&&$upass==null)
	{
	$msg="Fill-in username / password.";
	}
	else
	{			//echo $myuname.$mypass;
		$result=mysql_query("select * from adiusers where adiname='$uname' and adipass='$upass'");
		$count=mysql_num_rows($result);
		if($count==1)
		{
			$_SESSION['login_user']=stripslashes($uname);
            $_SESSION['user']=stripslashes($uname);
			header("Location: main/mainpage.php");
			
			}
		else{
			$msg="Invalid username or password.";
			}
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
</head>
<body>
<!-- START PAGE SOURCE -->
<div id="header">
  <div class="shell">
    <h1 id="logo" style="margin-top:0px;"><a href="#">RESTAURANT-FREE</a></h1>
  </div>
</div>
<div id="main">
  <div class="shell">
    
    <div align="center">
      <p align="center"><h2>LOGIN PANEL</h2>
       <form id="login" onClick=""  action="" method="post">
<table width="300px" border="0" align="center" bgcolor="#CCCCCC">
    <tr>
   <td colspan="2"><div align="center"><font color="#FF0000"><?php if(isset($msg))
{
	echo $msg;
}
?></font></div>
   </td>
   </tr>
  <tr>
    <td>Login-Id :</td>
    <td><input type="text" id="nname" name="nname"></td>
   
  </tr>
  <tr>
    <td>Password :</td>
    <td><input type="password" id="npass" name="npass"></td>
   
  </tr>
  <tr>
    <td><input type="reset" value="Reset"></input></td>
    <td><input type="Submit" value="LOGIN"></input></td>
  </tr>
</table>
</form>
      </p>
      <br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
        <br /><br /><br /><br /><br /><br />
    </div>
    
    <div class="cl">&nbsp;</div>
  </div>
</div>
<div class="footer">
  <div class="shell">
    <p class="lf">Copyright &copy; 2010 <a href="#">RESTAURANT-FREE</a> - All Rights Reserved</p>
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_ME_FREE</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>