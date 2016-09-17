<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
if(isset($_GET['mymsg']))
{
	$msg=($_GET['mymsg']);
	}
	else{
		$msg=null;
		}
$query=null;
$tab_block=null;
$tabview=null;
$myfrmnum=1;
$query = mysql_query("SELECT * FROM adirestbill WHERE billtype='Credit'");
while($r=mysql_fetch_array($query)) 
		{
		$myid=$r['id'];
		$mybillnum =$r['billnum'];
		$mybilltype=$r['billtype'];
		$myotype=$r['otype']; 
		$mygtotal=$r['gtotal']; 
		$mybilldate=$r['billdate'];
		$mystatus=$r['status'];
		
		if($mystatus=="Confirm")
			{
				$myacolor="#00FF00";
				}
			elseif($mystatus=="Credit")
			{
										
				$myacolor="PINK";	
				$newformatdate = null;	
				$newformatdate = date_create($mybilldate);
				$newformatdate = (string)(date_format($newformatdate, 'Y-m-d'));		
					}
			else
			{
				$myacolor="WHITE";			
					}
		//mybillid mybid mybilldt
		
		$tabview='<form id="viewbill'.$myfrmnum.'" action="restpaymybill.php" method="post" target="_blank">
						<input type="hidden" id="mybillid" name="mybillid" value="'.$myid.'">
						<input type="hidden" id="mybid" name="mybid" value="'.$mybillnum.'">
						<input type="hidden" id="mybilldt" name="mybilldt" value="'.$newformatdate.'">
						<input type="submit" value="PAY BILL"></form>';
		
		$newformatdate = null;					
						
	     $tab_block.='<tr bgcolor="'.$myacolor.'">
    <td align="center">'.$mybillnum.'</td>
	<td align="center">'.$mybilldate.'</td>
    <td align="center">'.$mybilltype.'</td>
    <td align="center">'.$myotype.'</td>
    <td align="center">'.$mygtotal.'</td>
    <td align="center">'.$mystatus.'</td>
    <td align="center">'.$tabview.'</td>
 </tr>';
 $myfrmnum++;
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE PAY BILL PAGE</title>
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
    <h2>BILLING PAY PANEL<a href="restbillingmain.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
  <table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#FFFFFF">
  <tr>
    <td colspan="6"> <?php
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
    <td align="center"><strong>BILL-No.</strong></td>
    <td align="center"><strong>DATE</strong></td>
    <td align="center"><strong>B.TYPE</strong></td>
    <td align="center"><strong>O.TYPE</strong></td>
    <td align="center"><strong>GRAND</strong></td>
    <td align="center"><strong>STATUS</strong></td>
    <td align="center"><strong>ACTION</strong></td>
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