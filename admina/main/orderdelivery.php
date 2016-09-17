<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$tab_block=null;
$tabdelete=null;
$myfrmnum=1;
$query = mysql_query("SELECT * FROM adikotnum");
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
				$tabconfirm='<form id="updto'.$myfrmnum.'" onclick="return formconfirmvalidate();" action="orderconfirm.php" method="post">
						 <input type="hidden" id="myootype" name="myootype" value="'.$myotype.'">
						 <input type="hidden" id="mybookinum" name="mybookinum" value="'.$mybokinum.'">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="Delivery Confirmed"></input>
						  </form>';
				$tabdelete='<form id="deleo'.$myfrmnum.'" onclick="return formcancelvalidate();" action="ordercancel.php" method="post">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="CANCEL KOT"></input>
						  </form>';
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
    <h2>DELIVERY OF AN ORDER PANEL<a href="orderlist.php"><img src="images/back.png" style="float:right"></a></h2>
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