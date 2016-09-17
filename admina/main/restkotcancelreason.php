<?php
include("../connect/connectdb.php");
include("check.php");

?>
<?php
$Vy3xp1y0eiui=null;
$Vcyjepzb2cs1=null;
$Vdzjah2iayln=null;
$Vpphze2cc2qi=null;
$V1qf25cd4hwt=$_GET['id'];



$thisquery=null;
$thisresult=null;
$thisnumrow=null;
$thisquery = "SELECT * FROM adikotnum WHERE id='".$V1qf25cd4hwt."' AND status='Processing'";
$thisresult = mysql_query($thisquery) or die(mysql_error());
$thisnumrow=mysql_num_rows($thisresult);
// echo $thisnumrow."<br/>";
 
$thisnumrow=(int)$thisnumrow;
		
		
if($thisnumrow==1)
{
	
	
	

$Vcyjepzb2cs1 = mysql_query("SELECT * FROM adikotnum WHERE id='".$V1qf25cd4hwt."'");
while($Vby4kaxa14ar=mysql_fetch_array($Vcyjepzb2cs1)) 
		{
		
		$Vgrm14tq1ssx = $Vby4kaxa14ar['id'];
		$Vevcmtrjz50h = $Vby4kaxa14ar['kotdate'];
		$Vfcucyz0uord = $Vby4kaxa14ar['bokinum'];
		$Vl3ujbebzchx = $Vby4kaxa14ar['otype'];
		$V0gshhrrglih = $Vby4kaxa14ar['waitrname'];
		$Vdutlucrpjf2 = $Vby4kaxa14ar['status'];
		
		
		$Vcmcdprua4gz=1;
			$Vcyjepzb2cs1 = mysql_query("SELECT * FROM adikotdet WHERE kid='".$V1qf25cd4hwt."'");
			while($Vby4kaxa14ar=mysql_fetch_array($Vcyjepzb2cs1)) 
					{
					 
					$Vaprzmi0hcb1 = $Vby4kaxa14ar['id'];
					$Vgy2rwujjqoj = $Vby4kaxa14ar['icode'];
					$Vnhmfni2p4sq = $Vby4kaxa14ar['itemname'];
					$Vv21a5z12oex = $Vby4kaxa14ar['uiprice'];
					$V1pcfphezj1y = $Vby4kaxa14ar['uiquan'];
					$Vewomk1nwjfc = $Vby4kaxa14ar['ktotal'];
					$Vo52sw2jkb2d = $Vewomk1nwjfc;
					
					
					$Vpphze2cc2qi=(($Vpphze2cc2qi+(int)$Vo52sw2jkb2d));
					$Vdzjah2iayln.='<tr>
									<td align="center">'.$Vcmcdprua4gz.'</td>
									<td align="center">'.$Vgy2rwujjqoj.'</td>
									<td align="left">'.$Vnhmfni2p4sq.'</td>
									 <td align="right">'.$Vv21a5z12oex.'</td>
									 <td align="center">'.$V1pcfphezj1y.'</td>
									  <td align="right">'.$Vewomk1nwjfc.'</td>
								</tr>';
					$Vcmcdprua4gz++;
					}
		}
		
		
		
}//if condition ($thisnumrow==1) ENDS
else{
	header("Location: restorderdelivery.php");	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE CANCEL A KOT ORDER PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script src="../combojs/jquery-1.10.2.js"></script>
<script type="text/javascript">
function formcancelvalidate(el){
			var r = confirm("Are you sure to cancel the KOT !");
		if (r)
		 {
			 var x=document.forms["cancelkotmy"]["canres"].value;
			  if(x==null || x=="")
				{
					alert("Please provide a reason for cancellation!");
					document.forms["cancelkotmy"].elements["canres"].focus();
					return false;
				}	
				var mykotcannumm= document.getElementById("myoid").value;
				var mykotcangtotal= document.getElementById("cangtotal").value;
				var googly;
				
				
				
				
				
				
				$.ajax({
				 type: "GET", 
				 url: "restordercancel.php",
				 data: "mappno="+mykotcannumm+"&mapcangtotal="+mykotcangtotal+"&mapcanres="+x,
				 success: function(msg){
					 
					 googly=msg;
					 }
				});	
				  
				
				window.opener.setmyValue(googly);
				window.close();
			 }
		else{
			 return false;
			 }		
}

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
    <h2>CANCEL KOT No.<?php echo " ".$V1qf25cd4hwt;?><a href="restorderdelivery.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
      <div><p><br /></p></div>
       <div id="mydata">
     <table id="myTableData" border="1" cellspacing="1" cellpadding="2" width="100%" bgcolor="#FFFFFF">
      <tr>
      <td colspan="6" height="40" align="center" bgcolor="#CCCCCC"><strong>KOT No.<?php echo " ".$V1qf25cd4hwt;?></strong></td>
       </tr>
      
       <tr>
      <td bgcolor="#CCCCCC"><strong>ORDER TYPE:</strong></td>
      <td bgcolor="#CCCCCC"><input readonly="readonly" id="roomnumm" name="roomnumm" value="<?php echo $Vl3ujbebzchx;?>"></td>
      <td bgcolor="#CCCCCC"><strong>Waiter Name:</strong></td>
      <td bgcolor="#CCCCCC"><input readonly="readonly" id="waitname" name="waitname" value="<?php echo $V0gshhrrglih;?>"></td>
      <td bgcolor="#CCCCCC"><strong>KOT DATE:</strong></td>
      <td bgcolor="#CCCCCC"><input readonly="readonly" id="kotdatee" name="kotdatee" value="<?php echo $Vevcmtrjz50h;?>"></td>
      </tr>
          <tr bgcolor="#CCCCCC">
          	<td align="center">S.No.</td>
            <td align="center"><strong>Item Code</strong></td>
           	 <td align="left"><strong>Item Name</strong></td>
       		 <td align="right"><strong>Unit Price</strong></td>
      		  <td align="center"><strong>Quantity</strong></td>
       		 <td align="right"><strong>Charge</strong></td>
          </tr>
					  <?php
              if(isset($Vdzjah2iayln))
              {
                  echo $Vdzjah2iayln;
                  }
              ?>
          <tr bgcolor="#CCCCCC">
            <td align="right" colspan="5"><strong>GRAND TOTAL:</strong></td>
            <td align="right"><strong><?php echo number_format($Vpphze2cc2qi,2);?></strong></td>
          </tr>
    </table>
     <form id="cancelkotmy" action="" method="post">
     <table id="myTableData" border="1" cellspacing="1" cellpadding="2" width="100%" bgcolor="#FFFFFF">
         <tr bgcolor="#FF0000">
            <td align="right"><strong>CANCELLATION REASON:</strong></td>
            <td align="left"><textarea id="canres" name="canres" cols="40" rows="5"></textarea></td>
          </tr>
          <tr bgcolor="#CCCCCC">
            <td align="right">
                <input type="text" id="myoid" name="myoid" value="<?php echo $V1qf25cd4hwt;?>">
                <input type="text" id="cangtotal" name="cangtotal" value="<?php echo $Vpphze2cc2qi;?>">
              </td>
            <td align="left"><input type="Submit" onclick="formcancelvalidate();" value="CANCEL KOT"></input></td>
          </tr>
     </table>
     </form>
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