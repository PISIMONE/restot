<?php
include("../connect/connectdb.php");
include("check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE SALES REPORTS PAGE</title>
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
      <p align="center"><h2>SALES REPORTS DASHBOARD</h2>
     <table border="0" cellpadding="5" cellspacing="1" width="90%">
  <tr align="center">
    <td><a href="billwisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/billwisenew.png"><br />BILL-WISE REPORT</font></a></td>    
    <td><a href="itemwisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/itemwise.png"><br />ITEM-WISE REPORT</font></a></td>    <td><a href="tablewisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/tablewise.png"><br />TABLE/ORDER-WISE REPORT</font></a></td>
  </tr>
  <tr align="center">
    <td><a href="paymentwisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/paymentwise.png"><br />PAYMENT-WISE REPORT</font></a></td>    
     <td><a href="menutypewisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/menuwise.png"><br />MENUTYPE-WISE REPORT</font></a></td>    
    <td><a href="vegnvegwisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/vegnvegwise.png"><br />VEG/NONVEG-WISE REPORT</font></a></td>    
  </tr>
   <tr align="center">
       <td><a href="groupwisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/groupwise.png"><br />GROUPWISE-WISE REPORT</font></a></td>    
       <td><a href="nvegtypewisesales.php"><font color="#00CC33" size="+1"><img class="" src="images/nvegtypewise.png"><br />NONVEG_TYPE-WISE REPORT</font></a></td>   
       <td>&nbsp;</td>
  </tr>
  </table>
  <div><br/></div>
 <div id="alljournals">  &nbsp;
 </div>

  
      </p>
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      
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