<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$msg=null;
$sql=null;
	$mystid=addslashes($_POST['stid']);
	$mystdept=addslashes($_POST['stdept']);
	$mystname=addslashes($_POST['stname']);
	$mystname=trim($mystname);
	$mystname=ucwords(strtolower($mystname));
	$mystidp=addslashes($_POST['stidp']);
	$mystdesg=addslashes($_POST['stdesg']);
	$mystdesg=(strtoupper($mystdesg));
	$mystaddrs=addslashes($_POST['staddrs']);
	$mystphno=addslashes($_POST['stphno']);	
	$sql = "INSERT INTO adistaffdet(sid, sdepart, sname, sidproof, sdesig, saddrs, sphno) VALUES('$mystid', '$mystdept', '$mystname', '$mystidp', '$mystdesg', '$mystaddrs', '$mystphno')";
	$result = mysql_query($sql) or die(mysql_error());
	$count=null;
	$count=mysql_affected_rows();
	$count=(int)$count;
		if ($count==1)
		{					
		$msg="Staff Added Sucessfully.<br />"; //.$sql;
		}
		else
		{
		$msg="Add Staff entry failed!.";
		}	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE ADD STAFFS PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script type="text/javascript">
<!--
// Form validation code will come here.
function addformvalidate()      
{
 var x=document.forms["addstaff"]["stid"].value;
  var y=document.forms["addstaff"]["stdept"].value;
   var z=document.forms["addstaff"]["stname"].value;
  var xa=document.forms["addstaff"]["stidp"].value;
  var ya=document.forms["addstaff"]["stdesg"].value;
  var za=document.forms["addstaff"]["staddrs"].value;
  var xab=document.forms["addstaff"]["stphno"].value;
      	 if(x==null || x=="")
{
	alert("Please provide Staff's ID Number!");
	document.forms["addstaff"].elements["stid"].focus();
  	return false;
}
	 if(y==null || y=="" || y=="DEFAULT")
{
	alert("Please select Staff's Department!");
	document.forms["addstaff"].elements["stdept"].focus();
  	return false;
}
 if(z==null || z=="")
{
	alert("Please provide Staff's Name!");
	document.forms["addstaff"].elements["stname"].focus();
  	return false;
}
	 if(xa==null || xa=="")
{
	alert("Please provide Staff's ID-PROFF number!");
	document.forms["addstaff"].elements["stidp"].focus();
  	return false;
}
 if(ya==null || ya=="")
{
	alert("Please provide Staff's Designation!");
	document.forms["addstaff"].elements["stdesg"].focus();
  	return false;
}
 if(za==null || za=="")
{
	alert("Please provide Staff's Address!");
	document.forms["addstaff"].elements["staddrs"].focus();
  	return false;
}
 if(xab==null || xab=="")
{
	alert("Please provide Staff's Phone Number!");
	document.forms["addstaff"].elements["stphno"].focus();
  	return false;
}
alert("all OK posting form.");
}
//-->
</script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="fullwidthmenu">
<?php
include("restmainmenu.php");
?>
</div> 
<div id="header">
  <div class="shell">
    <h1 id="logo"><a href="#">RESTAURANT-FREE</a></h1>
  </div>
</div>
<div id="main">
  <div class="shell">
    
    <div align="center">
      <p align="center"><h2>ADD STAFFS PANEL</h2>
       <form id="addstaff" onsubmit="return(addformvalidate());" action="" method="post">
      <table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td colspan="2"><?php
                            if(isset($msg))
                            {
                            echo "<center><font color='RED' size=+1 >";
                            echo $msg;
                            echo "</font></center>";
                            }
                            else{
                                echo "&nbsp;";
                                }
                            ?></td>
  </tr>
  <tr>
    <td><strong>STAFF ID:</strong></td>
    <td><input type="text" id="stid" name="stid"></td>
  </tr>
  <tr>
    <td><strong>STAFF DEPARTMENT:</strong></td>
    <td><select name="stdept" id="stdept">
      <option value="DEFAULT">DEFAULT</option><option value="HOTEL">HOTEL</option><option value="RESTAURANT">RESTAURANT</option><option value="STORE">STORE</option></select></td>
  </tr>
  <tr>
    <td><strong>STAFF NAME:</strong></td>
    <td><input type="text" id="stname" name="stname"></td>
  </tr>
  <tr>
    <td><strong>STAFF ID-PROOF:</strong></td>
    <td><input type="text" id="stidp" name="stidp"></td>
  </tr>
  <tr>
    <td><strong>DESIGNATION:</strong></td>
    <td><input type="text" id="stdesg" name="stdesg"></td>
  </tr>
  <tr>
    <td><strong>ADDRESS:</strong></td>
    <td><textarea id="staddrs" name="staddrs" cols="25" rows="6"></textarea></td>
  </tr>
  <tr>
    <td><strong>PHONE No.:</strong></td>
    <td><input type="text" id="stphno" name="stphno"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="Submit" value="ADD STAFF"></input></td>
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
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_M_FREE</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>