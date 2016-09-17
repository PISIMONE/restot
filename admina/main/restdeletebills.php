<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$user_check=$_SESSION['login_user'];
if($user_check!="admin")
	{
	header("Location: mainpage.php");
	}	
if(isset($_GET['mymsg']))
{
	$msg=($_GET['mymsg']);
	}
	else{
		$msg=null;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE DELETE BILL PAGE</title>
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
	 //alert(afromd);
	 /////////////ALL STARTS////////////////////
     $.ajax({
         type: "GET", 
         url: "restbillselect.php",
         data: { 
		  		 mafromd:afromd
				 },		 		
         success: function(html) {
			//alert(html);
             $("#mytrialbal").html(html);
			                     }
           });
		 /////////////ALL ENDS//////////////////// 
	 }); 
	
 });
 
</script>
<script type="text/javascript">
	function delbill(oForm) {	
	var xatno = oForm.elements["mybnum"].value;
	//alert("HELLO2");
	//alert(oForm);
	var r = confirm("Are you sure to DELETE Bill No. "+xatno+" !");
		if (r)
		 {
			 return true;
		}
		 else{
			 return false;
			 }	
			
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
    <h2>BILLING PURGE PANEL<a href="mainpage.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
  <table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#FFFFFF">
  <tr>
    <td colspan="7"> <?php
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
  <tr bgcolor="#CCCCCC">
    <td align="center"><strong>SELECT BILL DATE:</strong></td>
    <td align="center"><input type="text" id="fromd" name="fromd" class="mytext highlight" tabindex="2"></td>
 </tr>
  </table>
  </p>
  <p align="center">
  <div id="mytrialbal">  &nbsp;
   </div>
  </p>
<br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
        <br /><br />
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