<?php
include("../connect/connectdb.php");
include("check.php");
include("companyvars.php");
if(isset($_GET['mymsg'])){
	$msg=$_GET['mymsg'];
	}
	else{
		$msg=null;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
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
      <p align="center"><h2>COMPANY INFO DASHBOARD</h2>
       <table width="90%" border="0" cellspacing="10" cellpadding="2" style="background-color:#0CF;">
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
    <td>Company Name:</td>
    <td><?php if(isset($compvarscname)){ echo $compvarscname; } ?></td>
  </tr>
  <tr>
    <td>Company Address:</td>
    <td><?php if(isset($compvarscaddrs)){ echo $compvarscaddrs; } ?></td>
  </tr>
  <tr>
    <td>Contact No.:</td>
    <td><?php if(isset($compvarscphno)){ echo $compvarscphno; } ?></td>
  </tr>
  <tr>
    <td>Company email-id:</td>
    <td><?php if(isset($compvarscemail)){ echo $compvarscemail; } ?></td>
  </tr>
  <tr>
    <td>Website:</td>
    <td><?php if(isset($compvarscweb)){ echo $compvarscweb; } ?></td>
  </tr>
  <tr>
    <td>Page Title:</td>
    <td><?php if(isset($compvarscptitle)){ echo $compvarscptitle; } ?></td>
  </tr>
  <tr>
    <td>Company Slogan:</td>
    <td><?php if(isset($compvarscslog)){ echo $compvarscslog; } ?></td>
  </tr>
  <tr>
    <td>Registration No.:</td>
    <td><?php if(isset($compvarscregno)){ echo $compvarscregno; } ?></td>
  </tr>
  <tr>
    <td>TIN No.:</td>
    <td><?php if(isset($compvarsctinno)){ echo $compvarsctinno; } ?></td>
  </tr>
  <tr>
    <td>CST No.:</td>
    <td><?php if(isset($compvarscstno)){ echo $compvarscstno; } ?></td>
  </tr>
   <tr>
    <td>VAT No.:</td>
    <td><?php if(isset($compvarscvatno)){ echo $compvarscvatno; } ?></td>
  </tr>
   <tr>
    <td>Swachh Bharat Cess No.:</td>
    <td><?php if(isset($compvarssbtno)){ echo $compvarssbtno; } ?></td>
  </tr>
  <tr>
    <td>Service Tax (%):</td>
    <td><?php if(isset($compvarscstaxper)){ echo $compvarscstaxper; } ?></td>
  </tr>
  <tr>
    <td>VAT (%):</td>
    <td><?php if(isset($compvarscvatper)){ echo $compvarscvatper; } ?></td>
  </tr>
   <tr>
    <td>SWACHH B Cess (%):</td>
    <td><?php if(isset($compvarscsbtaxper)){ echo $compvarscsbtaxper; } ?></td>
  </tr>
  <tr>
    <td>Service Charge (%):</td>
    <td><?php if(isset($compvarssercharge)){ echo $compvarssercharge; } ?></td>
  </tr>
  <tr>
    <td>Parcel Charge:</td>
    <td><?php if(isset($compvarscparcel)){ echo $compvarscparcel; } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><a href="updatecompinfo.php" style="font-size:18px;"><font color="#0000FF">UPDATE COMPANY INFO's</font></a></td>
  </tr>
</table>


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