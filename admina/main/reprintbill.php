<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$myroomnum=null;
$myroomtyp=null;
$myroomcapa=null;
$myroomrent=null;
$tab_block=null;
$tabyesno=null;
$myfrmnum=1;
$query = mysql_query("SELECT * FROM currmbill");
while($r=mysql_fetch_array($query)) 
		{
		
		$mybrmnum= $r['rmnum'];
		$mybillnum= $r['billnum'];
		$mybilldate= $r['billdate'];
		$mybilltype= trim($r['billtype']);
		$mycustnam= $r['custname'];
		$mycustadrs= $r['custadrs'];
		$mycustidp= $r['custidp'];
		$mygtotal= $r['grandt'];
		
		if(($mybilltype=="Credit"))
		{
			$mycolor="#FF66CC";
			}
		else{
			$mycolor="#9BEE99";	
			}
	$tabyesno='<form id="bilroom'.$myfrmnum.'" action="billreprint.php" target="_blank" method="post">
     <input type="hidden" id="rebillnum" name="rebillnum" value="'.$mybillnum.'">
     <input type="Submit" value="REPRINT"></input>
      </form>';
		////////////////////////////////////////////////
		$tab_block.='<tr bgcolor="'.$mycolor.'">
	<td>'.$mybrmnum.'</td>
    <td>'.$mybillnum.'</td>
    <td>'.$mybilldate.'</td>
    <td>'.$mybilltype.'</td>
    <td>'.$mycustnam.'</td>
	<td>'.$mycustadrs.'</td>
	<td>'.$mycustidp.'</td>
	<td>'.$mygtotal.'</td>
	<td>'.$tabyesno.'</td>
  </tr>'; 
  $myfrmnum++;
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE REPRINT BILL PAGE</title>
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
    <h2>REPRINT BILL PANEL<a href="billing.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
      <form id="addroom" onsubmit="return(addformvalidate());" action="" method="post"></form>
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
  <tr>
    <td colspan="9"> <?php
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
  <tr bgcolor="#FF9933">
  	<td><strong>ROOM No.</strong></td>
    <td><strong>BILL NUMBER</strong></td>
    <td><strong>BILL DATE</strong></td>
    <td><strong>BILL TYPE</strong></td>
    <td><strong>CUST.NAME</strong></td>
    <td><strong>C.ADDRESS</strong></td>
    <td><strong>C.ID-PROOF</strong></td>
    <td><strong>GRAND_TOTAL</strong></td>
    <td><strong>ACTION</strong></td>
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