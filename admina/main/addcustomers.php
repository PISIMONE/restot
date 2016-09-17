<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$msg=null;
$sql=null;
////////stname stidp emailid staddrs stphno dob doa
	$mystname=addslashes($_POST['stname']);
	$mystname=trim($mystname);
	$mystname=ucwords(strtolower($mystname));
	
	$mystidp=addslashes($_POST['stidp']);
	$mystaddrs=addslashes($_POST['staddrs']);
	$mystaddrs=strtoupper($mystaddrs);
	
	$mystphno=addslashes($_POST['stphno']);
	$mystemailid=addslashes($_POST['emailid']);
	$mystdob=addslashes($_POST['dob']);
	$mystdob=$mystdob." 00:00:00";
	$mystdoa=addslashes($_POST['doa']);	
	$mystdoa=$mystdoa." 00:00:00";
	
	$tempbokinum=substr(str_shuffle(MD5(microtime())), 0, 10);		
	$sql = "INSERT INTO adicustomers(custid, custname, custidproof, custaddrs, custphno, custemailid, dob, doanni, createdon, updatedon) VALUES('$tempbokinum', '$mystname', '$mystidp', '$mystaddrs', '$mystphno', '$mystemailid', '$mystdob', '$mystdoa', '$mytodaydate', '$mytodaydate')";
	$result = mysql_query($sql) or die(mysql_error());
	$count=null;
	$count=mysql_affected_rows();
	$count=(int)$count;
		if ($count==1)
		{		
		    $queryt=mysql_query("SELECT id FROM adicustomers where custid='$tempbokinum'");
			$rowt=mysql_fetch_row($queryt);
			$mymaxidt=$rowt[0];
			$mymaxidt=(int)$mymaxidt;	
			$mymaxidto="AAHAR".$mymaxidt;
			$queryt="UPDATE adicustomers SET custid='$mymaxidto' WHERE id='$mymaxidt'";
			$resultt = mysql_query($queryt) or die(mysql_error());		
				
		    $msg="Customer Added Sucessfully.<br />"; //.$sql;
		}
		else
		{
		$msg="Add Customer entry failed!.";
		}	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE ADD CUSTOMERS PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<link rel="stylesheet" href="../datejs/jquery-ui.css">
  <script src="../datejs/jquery-1.10.2.js"></script>
  <script src="../datejs/jquery-ui.js"></script>
  <link rel="stylesheet" href="../datejs/style.css">
  <script>
   $(function() {
    $( "#dob" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeYear: true,
		changeMonth: true,
		yearRange: '-100:+0'
      });
    });	
	 $(function() {
    $( "#doa" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeYear: true,
		changeMonth: true,
		yearRange: '-100:+0'
      });
    });	
    </script>
<script type="text/javascript">
<!--
// Form validation code will come here.
function addformvalidate()      
{
	///stname stidp emailid staddrs stphno dob doa
 var x=document.forms["addcutomer"]["stname"].value;
 var xa=document.forms["addcutomer"]["staddrs"].value;
 var ya=document.forms["addcutomer"]["stphno"].value;
        	 if(x==null || x=="")
{
	alert("Please provide Customer's Name!");
	document.forms["addcutomer"].elements["stname"].focus();
  	return false;
}
	 if(xa==null || xa=="")
{
	alert("Please provide Customer's Address!");
	document.forms["addcutomer"].elements["staddrs"].focus();
  	return false;
}
 	 if(ya==null || ya=="")
{
	alert("Please provide Customer's Phone number!");
	document.forms["addcutomer"].elements["stphno"].focus();
  	return false;
}

alert("all OK...Posting form.");
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
      <p align="center"><h2>ADD CUSTOMERS PANEL</h2>
       <form id="addcutomer" onsubmit="return(addformvalidate());" action="" method="post">
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
    <td><strong>CUSTOMER NAME:</strong></td>
    <td><input type="text" id="stname" name="stname"></td>
  </tr>
  <tr>
    <td><strong>CUSTOMER ID-PROOF:</strong></td>
    <td><input type="text" id="stidp" name="stidp"></td>
  </tr>
  <tr>
    <td><strong>Email-id:</strong></td>
    <td><input type="text" id="emailid" name="emailid"></td>
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
    <td><strong>DOB:</strong></td>
    <td><input type="text" id="dob" name="dob"></td>
  </tr>
   <tr>
    <td><strong>Anniversary Date:</strong></td>
    <td><input type="text" id="doa" name="doa"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="Submit" value="ADD CUSTOMER"></input></td>
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