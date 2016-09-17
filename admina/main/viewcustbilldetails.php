<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$cappno = $_POST['custid'];
//$cappno=(string)$cappno;
$qstring="SELECT * FROM adikotnum WHERE custto='$cappno'";
//echo $qstring;
//exit();
$tab_block=null;
$bill_block[]=array();
$tabyesno=null;
$myfrmnum=1;
$result=mysql_query($qstring);
while($r=mysql_fetch_array($result)) 
		{
		$myid=$r['id'];
			$qstringo="SELECT * FROM adirestbill";
			$resultt=mysql_query($qstringo);
			while($roy=mysql_fetch_array($resultt)) 
				{
				$myoid=$roy['id'];
				$myofbid=$roy['fbid'];
				$myobillnum=$roy['billnum'];
				$mykotidsexp=explode(',',$myofbid);
				$mykotidsexp=array_filter($mykotidsexp);
				
				$mykotidlen=(int)count($mykotidsexp);
				$todokotid=null;
				$startlen=0;				
					for($startlen;$startlen<$mykotidlen;$startlen++)
					{
					  $todokotid=$mykotidsexp[$startlen];
					  //echo "<br/>".$todokotid;
					     if($todokotid==$myid){
							$bill_block[]=$myobillnum;
							}
					  }
				
				}
				
			
		}
		$bill_block=array_unique($bill_block);
		//echo "<br/>".$bill_block;
				foreach ($bill_block as $valuev) 
				{ 
				//echo $valuev; 
				$valuevy=(string)$valuev;
				$qstringtot="SELECT * FROM adirestbill WHERE billnum='".$valuevy."'";
				$resulttt=mysql_query($qstringtot);
				while($rott=mysql_fetch_array($resulttt))
					{

					$myofbid=$rott['fbid'];
					$myobillnum=$rott['billnum'];
					$myobilltype=$rott['billtype'];
					$myobilldate=$rott['billdate'];
					$myostatus=$rott['status'];
						$myacolor="#FFFFFF";
						$tab_block.='<tr bgcolor="'.$myacolor.'">
										<td>'.$myobillnum.'</td>
										<td>'.$myofbid.'</td>
										<td>'.$myobilltype.'</td>
										<td>'.$myobilldate.'</td>
										<td>'.$myostatus.'</td>
										<td><form id="viewbill'.$myfrmnum.'" action="restbillprintable.php?billno='.$myobillnum.'" method="post" target="_blank">
						<input type="hidden" id="mybid" name="mybid" value="'.$myobillnum.'">
						<input type="submit" value="VIEW BILL"></form></td>
									</tr>'; 
										$myfrmnum++;
					}
					
					
				}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE VIEW CUSTOMERS PAGE</title>
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
      <p align="center"><h2>VIEW CUSTOMERS BILL's PANEL</h2>
         <div id="mycutomer">
  <table border="0" cellspacing="1" cellpadding="1" width="100%" bgcolor="#CCCCCC" style="font-size:10px;">
  <tr bgcolor="#33CCFF" style="font-size:12px;" align="center">
    <td><strong>BILL No.</strong></td>
    <td><strong>KOT-ID</strong></td>
    <td><strong>BILL TYPE</strong></td>
    <td><strong>DATE</strong></td>
    <td><strong>STATUS</strong></td>
    <td><strong>ACTION</strong></td>
  </tr>
  <?php
			if(isset($tab_block))
			{
			echo "<center><font color='RED' size=+1 >";
			echo $tab_block;
			echo "</font></center>";
			}
			else{
				echo "&nbsp;";
				}
			?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
</table>
		</div>
      </p>
      <br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
        <br /><br /><br /><br /><br /><br /><br /><br />
        <br /><br /><br /><br /><br /><br />
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