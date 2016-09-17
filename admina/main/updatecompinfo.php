<?php
include("../connect/connectdb.php");
include("check.php");
include("companyvars.php");
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
<script type="text/javascript">
//compname compaddrs phone compemail webadd ptitle compslog regnum tinnum cstnum vatnum staxper vatper scharge parcel
function upformvalidate()      
{
	var r = confirm("Are you sure to UPDATE company info!");
		if (r)
		 {
			 return true;
			 }
			 else{
				 return false;
				 }
}

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
    <h1 id="logo"><a href="#">RESTAURANT-FREE Company Info</a></h1>
  </div>
</div>
<div id="main">
  <div class="shell">
    
    <div align="center">
      <p align="center"><h2>COMPANY INFO UPDATE</h2>
      <form id="infoform" onsubmit="return(upformvalidate());" action="updatethisinfo.php" method="post">
       <table width="90%" border="1" cellspacing="15" cellpadding="5" style="background-color:#0CF;">
  <tr>
    <td>Company Name:</td>
    <td><input type="text" id="compname" name="compname" style="width: 300px" value="<?php if(isset($compvarscname)){ echo $compvarscname; } ?>"></td>
  </tr>
  <tr>
    <td>Company Address:</td>
    <td><textarea id="compaddrs" name="compaddrs" cols="45" rows="9"><?php if(isset($compvarscaddrs)){ echo $compvarscaddrs; } ?></textarea></td>
  </tr>
  <tr>
    <td>Contact No.:</td>
    <td><input type="text" id="phone" name="phone" style="width: 300px" value="<?php if(isset($compvarscphno)){ echo $compvarscphno; } ?>"></td>
  </tr>
  <tr>
    <td>Company email-id:</td>
    <td><input type="text" id="compemail" name="compemail" style="width: 300px" value="<?php if(isset($compvarscemail)){ echo $compvarscemail; } ?>"></td>
  </tr>
  <tr>
    <td>Website:</td>
    <td><input type="text" id="webadd" name="webadd" style="width: 300px" value="<?php if(isset($compvarscweb)){ echo $compvarscweb; } ?>"></td>
  </tr>
  <tr>
    <td>Page Title:</td>
    <td><input type="text" id="ptitle" name="ptitle" style="width: 300px" value="<?php if(isset($compvarscptitle)){ echo $compvarscptitle; } ?>"></td>
  </tr>
  <tr>
    <td>Company Slogan:</td>
    <td><input type="text" id="compslog" name="compslog" style="width: 300px" value="<?php if(isset($compvarscslog)){ echo $compvarscslog; } ?>"></td>
  </tr>
  <tr>
    <td>Registration No.:</td>
    <td><input type="text" id="regnum" name="regnum" style="width: 300px" value="<?php if(isset($compvarscregno)){ echo $compvarscregno; } ?>"></td>
  </tr>
  <tr>
    <td>TIN No.:</td>
    <td><input type="text" id="tinnum" name="tinnum" style="width: 300px" value="<?php if(isset($compvarsctinno)){ echo $compvarsctinno; } ?>"></td>
  </tr>
  <tr>
    <td>CST No.:</td>
    <td><input type="text" id="cstnum" name="cstnum" style="width: 300px" value="<?php if(isset($compvarscstno)){ echo $compvarscstno; } ?>"></td>
  </tr>
   <tr>
    <td>VAT No.:</td>
    <td><input type="text" id="vatnum" name="vatnum" style="width: 300px" value="<?php if(isset($compvarscvatno)){ echo $compvarscvatno; } ?>"></td>
  </tr>
   <tr>
    <td>Swachh Bharat Cess No.:</td>
    <td><input type="text" id="sbtnum" name="sbtnum" style="width: 300px" value="<?php if(isset($compvarssbtno)){ echo $compvarssbtno; } ?>"></td>
  </tr>
  <tr>
    <td>Service Tax (%):</td>
    <td><input type="text" id="staxper" name="staxper" style="width: 300px" placeholder="for example: 5.6" value="<?php if(isset($compvarscstaxper)){ echo $compvarscstaxper; } ?>"></td>
  </tr>
  <tr>
    <td>VAT (%):</td>
    <td><input type="text" id="vatper" name="vatper" style="width: 300px" placeholder="for example: 5.6" value="<?php if(isset($compvarscvatper)){ echo $compvarscvatper; } ?>"></td>
  </tr>
   <tr>
    <td>SWACHH B Cess (%):</td>
    <td><input type="text" id="sbtper" name="sbtper" style="width: 300px" placeholder="for example: 0.5" value="<?php if(isset($compvarscsbtaxper)){ echo $compvarscsbtaxper; } ?>"></td>
  </tr>
  <tr>
    <td>Service Charge (%):</td>
    <td><input type="text" id="scharge" name="scharge" style="width: 300px" placeholder="for example: 5.6" value="<?php if(isset($compvarssercharge)){ echo $compvarssercharge; } ?>"></td>
  </tr>
  <tr>
    <td>Parcel Charge:</td>
    <td><input type="text" id="parcel" name="parcel" style="width: 300px" placeholder="for example: 25" value="<?php if(isset($compvarscparcel)){ echo $compvarscparcel; } ?>"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2"><input type="Submit" value="UPDATE CONFIRM"></input></td>
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
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_ME_FREE</a><br/>
    <a href="restdeletebills.php"><img src="images/hbar.jpg" style="display:block;"></a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>