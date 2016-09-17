<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
?>
<?php
$msg=null;
$sql=null;
$cappno = $_POST['custid'];
		////////stname stidp emailid staddrs stphno dob doa
	$sql="SELECT * FROM adicustomers WHERE id='$cappno'";
	$stmt = mysql_query($sql);
	while($r=mysql_fetch_array($stmt)) 
		{
		$myid=$r['id'];
		$mycustid=$r['custid'];
		$mycustname=$r['custname'];
		$mycustidproof=$r['custidproof'];
		$mycustaddrs=$r['custaddrs'];
		$mycustphno=$r['custphno'];
		$mycustemailid=$r['custemailid'];
		$mydob=$r['dob'];
		$mydob=preg_replace('~ 00:00:00~','',$mydob);
		$mydoanni=$r['doanni'];
		$mydoanni=preg_replace('~ 00:00:00~','',$mydoanni);
		}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE UPDATE CUSTOMERS PAGE</title>
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
      <p align="center"><h2>UPDATE CUSTOMERS PANEL</h2>
       <form id="addcutomer" onsubmit="return(addformvalidate());" action="updatemycustomer.php" method="post">
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
    <td><strong>CUSTOMER NAME:</strong><input type="hidden" id="custoid" name="custoid" value="<?php echo $myid;?>">
    <input type="hidden" id="custoidd" name="custoidd" value="<?php echo $mycustid;?>"></td>
    <td><input type="text" id="stname" name="stname" value="<?php echo $mycustname;?>"></td>
  </tr>
  <tr>
    <td><strong>CUSTOMER ID-PROOF:</strong></td>
    <td><input type="text" id="stidp" name="stidp" value="<?php echo $mycustidproof;?>"></td>
  </tr>
  <tr>
    <td><strong>Email-id:</strong></td>
    <td><input type="text" id="emailid" name="emailid" value="<?php echo $mycustemailid;?>"></td>
  </tr>
  <tr>
    <td><strong>ADDRESS:</strong></td>
    <td><textarea id="staddrs" name="staddrs" cols="25" rows="6"><?php echo $mycustaddrs;?></textarea></td>
  </tr>
  <tr>
    <td><strong>PHONE No.:</strong></td>
    <td><input type="text" id="stphno" name="stphno" value="<?php echo $mycustphno;?>"></td>
  </tr>
   <tr>
    <td><strong>DOB:</strong></td>
    <td><input type="text" id="dob" name="dob" value="<?php echo $mydob;?>"></td>
  </tr>
   <tr>
    <td><strong>Anniversary Date:</strong></td>
    <td><input type="text" id="doa" name="doa" value="<?php echo $mydoanni;?>"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="Submit" value="UPDATE CUSTOMER"></input></td>
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