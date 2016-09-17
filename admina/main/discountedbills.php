<?php
include("../connect/connectdb.php");
include("check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE DISCOUNTED BILLS PAGE</title>
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
    $( "#fromd" ).datepicker({
		dateFormat: 'yy-mm-dd',
      });
    });	
	</script>
    <script type="text/javascript">
$(function() {
	 //////////////////searcht fromd tod
	 $('#fromd').bind('change', function() {	 
	 var afromd=$("#fromd").val();
	 //alert(lilname);
	 /////////////ALL JOURNALS STARTS////////////////////
     $.ajax({
         type: "GET", 
         url: "finddiscbills.php",
         data: { 
		 		 mafromd:afromd,
				},		 		
         success: function(html) {
			//alert("Hello");
             $("#alldaybook").html(html);
			                     }
           });
		 /////////////ALL JOURNALS ENDS//////////////////// 
	 }); 
	
 });
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
      <p align="center"><h2>DISCOUNTED BILL DASHBOARD</h2>
     <table border="1" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="90%">
  <tr align="center">
    <td colspan="2"><font color="#00CC33" size="+1">SEARCH DATE OF DISCOUNTED BILL</font></td>    
  </tr>
  <tr>
  <td align="right"><strong>SELECT DATE:</strong></td>
  <td><input type="text" id="fromd" name="fromd" class="mytext highlight" tabindex="1"></td>
  </tr>
  </table>
  <div><br/></div>
 <div id="alldaybook">  &nbsp;
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
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_M_FREE</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>