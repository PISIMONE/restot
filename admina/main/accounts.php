<?php
include("../connect/connectdb.php");
include("check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE ACCOUNTS PAGE</title>
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
      <p align="center"><h2>ACCOUNTS DASHBOARD</h2>
       <table border="0" cellpadding="5" cellspacing="15">
     <tr align="center">
    <td><a href="salesreports.php"><img class="" src="images/salesrep.png"><br />SALES REPORTS</a></td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
     </tr>
  <tr align="center">
    <td><a href="createledger.php"><img class="" src="images/ledgerentry.png"><br />CREATE LEDGER</a></td>
    <td><a href="viewledgers.php"><img class="" src="images/ledgerview.png"><br />VIEW LEDGER</a></td>
    <td><a href="vouchers.php"><img class="" src="images/voucher_icon.png"><br />VOUCHERS</a></td>
    
  </tr>
  <tr align="center">
  <td><a href="receipts.php"><img class="" src="images/receipts.png"><br />RECEIPTS</a></td>
    <td><a href="journalentry.php"><img class="" src="images/journalentry.png"><br />JOURNAL ENTRY</a></td>
    <td><a href="daybook.php"><img class="" src="images/daybook.png"><br />DAY BOOK</a></td>
    
  </tr>
   <tr align="center">
   <td><a href="trialbalance.php"><img class="" src="images/trialbalance.png"><br />TRIAL BALANCE</a></td>
    <td><a href="balancesheet.php"><img class="" src="images/balancesheet.png"><br />BALANCE SHEET</a></td>
    <td><a href="placcounts.php"><img class="" src="images/profit_loss.png"><br />P/L ACCOUNT</a></td>
   
  </tr>
  <tr>
     <td>&nbsp;</td>
      <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

      </p>
      <br /><br /><br /><br /><br /><br /><br /><br />
      
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