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
$query = mysql_query("SELECT * FROM adicrmstatus WHERE rmsts='Booked'");
while($r=mysql_fetch_array($query)) 
		{
		
		$tabnum=$r['rmnum'];
		$tabtype=$r['rmtype'];
		$tabcapa=$r['rmcapa'];
		$tabrent=$r['rmrent'];
		$tabsts=$r['rmsts'];
		$myacolor="WHITE";
		$queryy="SELECT bokinum FROM curbookedrm WHERE rmnum='".$tabnum."' and status='Booked'";
			$queryy = mysql_query($queryy);
			while($rr=mysql_fetch_array($queryy)) 
					{
						
						$bukknum=$rr['bokinum'];						
						$tabyesno='<form id="bilroom'.$myfrmnum.'" action="orderplaceme.php" method="post">
						 <input type="hidden" id="roomnum" name="roomnum" value="'.$tabnum.'">
						 <input type="hidden" id="booknum" name="booknum" value="'.$bukknum.'">
						 <input type="Submit" value="SELECT ROOM"></input>
						  </form>';
								$myacolor="#FF0000";
							////////////////////////////////////////////////
					}
						$tab_block.='<tr bgcolor="'.$myacolor.'">
						<td width="15%">'.$tabnum.'</td>
						<td width="15%">'.$tabtype.'</td>
						<td width="15%">'.$tabcapa.'</td>
						<td width="15%">'.$tabrent.'</td>
						<td width="15%" bgcolor="'.$myacolor.'">'.$tabsts.'</td>
						<td width="15%">'.$tabyesno.'</td>
					  </tr>';
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE PLACE AN ORDER PAGE</title>
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
    <h2>PLACE AN ORDER PANEL<a href="orderlist.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
      <form id="addroom" onsubmit="return(addformvalidate());" action="" method="post"></form>
  <table border="0" cellpadding="8" cellspacing="5" width="800">
  <tr>
    <td colspan="4"> <?php
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
  <tr>
    <td width="22%"><strong>ROOM NUMBER</strong></td>
    <td width="22%"><strong>ROOM TYPE</strong></td>
    <td width="22%"><strong>ROOM CAPACITY</strong></td>
    <td width="22%"><strong>ROOM RENT</strong></td>
    <td width="22%"><strong>STATUS</strong></td>
    <td width="22%"><strong>ACTION</strong></td>
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