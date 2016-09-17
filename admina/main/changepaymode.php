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
$tabcreupd=null;
$newformatdate = null;	
$myfrmnum=1;
$query = mysql_query("SELECT * FROM adirestbill");
while($r=mysql_fetch_array($query)) 
		{
		$newformatdate = null;	
		$myid=$r['id'];
		$mybillnum=$r['billnum'];
		$mybilltype=$r['billtype'];
		$myotype=$r['otype']; 
		$mygtotal=$r['gtotal']; 
		$mybilldate=$r['billdate'];
		$newformatdate = date_create($mybilldate);
		$newformatdate = (string)(date_format($newformatdate, 'Y-m-d'));
		$mystatus=$r['status'];
		
		if($mystatus=="Confirm")
			{
				$myacolor="#00FF00";
				$tabcreupd="&nbsp;";
				}
			elseif($mystatus=="Credit")
			{
				if($login_session=="admin")
				{
				
				$tabcreupd='<form id="billcreupdt'.$myfrmnum.'" action="restbillcrupdt.php" method="post">
						<input type="hidden" id="mybillid" name="mybillid" value="'.$myid.'">
						<input type="hidden" id="mybid" name="mybid" value="'.$mybillnum.'">
						<input type="hidden" id="mybstatus" name="mybstatus" value="'.$mystatus.'">
						<input type="hidden" id="mybdt" name="mybdt" value="'.$newformatdate.'">
						<input type="submit" onclick="return(updatediscount(this.form));" value="UPDATE DISCOUNT"></form>';
						
				}
				else{
					$tabcreupd="&nbsp;";			
					}
				$myacolor="PINK";		
				
					}
		elseif($mystatus=="Cancelled")
			{
				$myacolor="RED";
				$tabcreupd="&nbsp;";			
					}
		elseif($mystatus=="Card")
			{
				$myacolor="#00FF00";
				$tabcreupd="&nbsp;";			
					}
		elseif($mystatus=="Management")
			{
				$myacolor="#00FF00";
				$tabcreupd="&nbsp;";			
					}
			else
			{
				$myacolor="WHITE";
				$tabcreupd="&nbsp;";			
					}
		
		
		
		
		$tabview='<form id="viewbill'.$myfrmnum.'" action="restbillprintable.php?billid='.$myid.'&billno='.$mybillnum.'&billdt='.$newformatdate.'" method="post" target="_blank">
						<input type="hidden" id="mybillid" name="mybillid" value="'.$myid.'">
						<input type="hidden" id="mybid" name="mybid" value="'.$mybillnum.'">
						<input type="hidden" id="mybdt" name="mybdt" value="'.$newformatdate.'">
						<input type="submit" value="VIEW BILL"></form>';
	     $tab_block.='<tr bgcolor="'.$myacolor.'">
    <td align="center">'.$mybillnum.'</td>
	<td align="center">'.$mybilldate.'</td>
    <td align="center">'.$mybilltype.'</td>
    <td align="center">'.$myotype.'</td>
    <td align="center">'.$mygtotal.'</td>
    <td align="center">'.$mystatus.'</td>
    <td align="center">'.$tabview.'</td>
	<td align="center">'.$tabcreupd.'</td>
 </tr>';
 $myfrmnum++;
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE CHANGE PAY MODE OF BILL PAGE</title>
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
         url: "listpaymodebills.php",
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
<script type="text/javascript">
	function updatediscount(oForm) {	
	var xatno = oForm.elements["mybid"].value;
	//alert("HELLO2");
	//alert(oForm);
	var r = confirm("Are you sure to Change Payment Mode Cash <-> Card of Bill No. "+xatno+" !");
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
    <h2>BILLING PMODE PANEL<a href="restviewbill.php"><img src="images/back.png" style="float:right"></a></h2>
    <div align="center">
      <p align="center">
     <table border="1" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="90%">
  <tr align="center">
    <td colspan="7"><font color="#00CC33" size="+1">SEARCH DATE OF BILL</font></td>    
  </tr>
  <tr>
  <td align="right" colspan="4"><strong>SELECT DATE:</strong></td>
  <td colspan="3"><input type="text" id="fromd" name="fromd" class="mytext highlight" tabindex="1"></td>
  </tr>
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
      </p>
    </div>
     </div>
      <p align="center">
          <div id="alldaybook">  &nbsp;
         </div>
      </p>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
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