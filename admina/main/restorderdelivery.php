<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
date_default_timezone_set('Asia/Calcutta');
$mytodaydatem = (string)date("Y-m-d H:i:s");
$mytodaydatum = (string)date("Y-m-d");
$mytodaydatumstart = $mytodaydatum." 00:00:00";
$mytodaydatumend = $mytodaydatum." 23:59:59";

if(isset($_GET['msg']))
{
	$msg=$_GET['msg'];
}
else{
	$msg=null;
}

$query=null;
$tab_block=null;
$tabdelete=null;
$myfrmnum=1;
$query = mysql_query("SELECT * FROM adikotnum WHERE (OTYPE LIKE '%PARCEL%' OR OTYPE LIKE '%TABLE%' OR OTYPE LIKE '%ROOM%') AND ((kotdate>='$mytodaydatumstart') AND (kotdate<='$mytodaydatumend')) ORDER BY id DESC");
while($r=mysql_fetch_array($query)) 
		{
		$mykid=$r['id'];
		$mykotdate=$r['kotdate'];
		$mybokinum=$r['bokinum'];
		$myotype=$r['otype'];
		$mywaitrname=$r['waitrname'];
		$mystatus=$r['status'];
			if($mystatus=="Delivered")
			{
				$tabconfirm="&nbsp;";
				$tabdelete="&nbsp;";
				$myacolor="#00FF00";
				}
			elseif($mystatus=="Cancelled")
			{
				$tabconfirm="&nbsp;";
				$tabdelete="&nbsp;";								
				$myacolor="#FF0000";			
					}
			elseif($mystatus=="Confirm")
			{
				$tabconfirm="&nbsp;";
				$tabdelete="&nbsp;";								
				$myacolor="WHITE";			
					}
			else
			{	
					if($mystatus=="Processing"){$myacolor="#FFFF00";}
					else{$myacolor="WHITE";}				
				$tabconfirm='<form id="updto'.$myfrmnum.'" onclick="return formconfirmvalidate();" action="restorderconfirm.php" method="post">
						 <input type="hidden" id="myootype" name="myootype" value="'.$myotype.'">
						 <input type="hidden" id="mybookinum" name="mybookinum" value="'.$mybokinum.'">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="Delivery Confirmed"></input>
						  </form>';
				$tabdelete='<form id="cankotdto'.$myfrmnum.'">
							<input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="button" onclick="formcancelvalidate('.$mykid.');" value="CANCEL KOT"></input></form>';
				}
						
							////////////////////////////////////////////////
		 $tab_block.='<tr bgcolor="'.$myacolor.'">
						<td width="10%">'.$mykid.'</td>
						<td width="10%">'.$mykotdate.'</td>
						<td width="10%">'.$myotype.'</td>
						<td width="10%">'.$mywaitrname.'</td>
						<td width="10%">'.$mystatus.'</td>
						<td width="10%" align="center">'.$tabconfirm.'</td>
						<td width="10%" align="center">'.$tabdelete.'</td>
					   </tr>'; 
				
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE DELIVERY OF AN ORDER PAGE</title>
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
	 $(function() {
    $( "#tod" ).datepicker({
		dateFormat: 'yy-mm-dd',
      });
    });	
</script>
 <script type="text/javascript">
$(function() {
	 //////////////////searcht fromd tod
	 $('#fromd, #tod').bind('change', function() {	 
	 var afromd=$("#fromd").val();
	 var atod=$("#tod").val();
	 //alert(afromd);
	// alert(atod);
	  
	
	 /////////////RESTAURANT STARTS////////////////////
     $.ajax({
         type: "POST", 
         url: "findrestorderdelivery.php",
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
		
	 }); 
	
 });
 
</script>
<script type="text/javascript">
		function formconfirmvalidate(el){
			var r = confirm("Are you sure to CONFIRM the Delivery of KOT !");
		if (r)
		 {
			 return true;
			 }
			 else{
				 return false;
				 }		
}
function formcancelvalidate(el){
			var r = confirm("Are you sure to cancel the KOT !");
		if (r)
		 {
			 var childid=el;
			 var childWin =window.open('restkotcancelreason.php?id='+childid,'popup');
			 
			 }
			 else{
				 return false;
				 }		
}
function setmyValue(val1) {
   //alert(val1);
   alert("ALL OK");
   location.reload();		
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
    <h2>DELIVERY OF AN ORDER PANEL<a href="restorderlist.php"><img src="images/back.png" style="float:right"></a></h2>
    <div align="center">
      <p align="center">
     <table border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="100%">
      <tr align="center">
    <td colspan="10"><font color="#CC3333" size="+1">Today's Date:&nbsp;<?php echo $mytodaydatem ?></font></td>    
    </tr>
  <tr align="center">
    <td colspan="10"><font color="#00CC33" size="+1">SEARCH ORDER BETWEEN DATES</font></td>    
  </tr>
  <tr>    
  <td>&nbsp;FROM DATE:</td>
  <td><input type="text" id="fromd" name="fromd"></td>
  <td>&nbsp;TO DATE:</td>
  <td><input type="text" id="tod" name="tod"></td>
  </tr>
  </table>
  </p>
  </div>
      <p align="center">
      <form id="editkot" onsubmit="return(addformvalidate());" action="" method="post"></form>
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
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
  </table>
   <div id="myledgers">   
          <table border="0" cellpadding="1" cellspacing="1" width="100%">  
          <tr bgcolor="#CCCCCC">
            <td width="13%"><strong>KOT NUMBER</strong></td>
            <td width="13%"><strong>KOT DATE</strong></td>
            <td width="13%"><strong>ORDER TYPE</strong></td>
            <td width="13%"><strong>WAITER NAME</strong></td>
            <td width="13%"><strong>STATUS</strong></td>
            <td width="13%" align="center"><strong>CONFIRM</strong></td>
            <td width="13%" align="center"><strong>CANCEL</strong></td>
          </tr>
          <?php
          if(isset($tab_block))
          {
              echo $tab_block;
              }
          ?>
        </table>
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