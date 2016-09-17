<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydatem = (string)date("Y-m-d H:i:s");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE POS REPORT PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<style type="text/css">

    @media print
    {
    	#non-printable { display: none; }
    	#printable { display: block; }
    }
    </style>
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
	 $(function() {
    $( "#tod" ).datepicker({
		dateFormat: 'yy-mm-dd',
      });
    });	
    </script>
    <script type="text/javascript">
$(function() {
	 //////////////////searcht fromd tod
	 $('#depart, #fromd, #tod').bind('change', function() {	 
	 var adepart=$("#depart").val();
	 var afromd=$("#fromd").val();
	 var atod=$("#tod").val();
	 //alert(lilname);
	  if(adepart=="DEFAULT")
	  {
		   $("#myledgers").html('<div>&nbsp;</div>');
		  }
	else
	 {//////////else not default starts/////////////
		if(adepart=="RESTAURANT")
		 {
	 /////////////RESTAURANT STARTS////////////////////
     $.ajax({
         type: "GET", 
         url: "findposwise.php",
         data: { 
				 mafromd:afromd,
				 matod:atod
				 },		 		
         success: function(html) {
			//alert("Hello");
             $("#myledgers").html(html);
			                     }
           });
		 /////////////RESTAURANT ENDS//////////////////// 
		 }
        
	 }//////////else not default ends/////////////
	 }); 
	
 });
 
</script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="fullwidthmenu">
<div id="non-printable">
<?php
include("restmainmenu.php");
?>
</div>
</div>   
<div id="header">
  <div class="shell">
    <h1 id="logo"><a href="#">RESTAURANT-FREE</a></h1>
  </div>
</div>
<div id="main">
  <div class="shell">
    
    
    
    <div align="center">
    
    
    <div id="non-printable">
    
      <p align="center"><h2>POS REPORT DASHBOARD</h2>
     <table border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="100%">
      <tr align="center">
    <td colspan="6"><font color="#CC3333" size="+1">Today's Date:&nbsp;<?php echo $mytodaydatem ?></font></td>    
    </tr>
      <tr align="center">
        <td colspan="6"><font color="#00CC33" size="+1">SEARCH REPORT BETWEEN DATES</font></td>    
      </tr>
      <tr>
      <td>DEPARTMENT:</td>
        <td><select name="depart" id="depart">
            <option value="DEFAULT">DEFAULT</option>
            <option value="RESTAURANT">RESTAURANT</option>
            </select></td>
      <td>&nbsp;FROM DATE:</td>
      <td><input type="text" id="fromd" name="fromd"></td>
      <td>&nbsp;TO DATE:</td>
      <td><input type="text" id="tod" name="tod"></td>
      </tr>
  </table>
  <div><br/></div>
  
  </div>
  
  <div id="printable">
  
 <div id="myledgers" style="font-size:14px;">  &nbsp;
 </div>

	</div>
 
      </p>
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      
    </div>
    
    <div class="cl">&nbsp;</div>
  </div>
</div>
<div class="footer">
	<div id="non-printable">
  <div class="shell">
    <p class="lf">Copyright &copy; 2010 <a href="#">RESTAURANT-FREE</a> - All Rights Reserved</p>
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_ME_FREE</a></p>
    <div style="clear:both;"></div>
  </div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>