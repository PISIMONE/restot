<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
if(isset($_GET['mymsg']))
	{
	$msg=$_GET['mymsg'];
	}
	else{
		$msg=null;
		}
$query=null;
$tab_block=null;
$tabyesno=null;
$tabupdate=null;
$myfrmnum=1;
$query = mysql_query("SELECT * FROM adicustomers");
while($r=mysql_fetch_array($query)) 
		{

		$myid=$r['id'];
		$mycustid=$r['custid'];
		$mycustname=$r['custname'];
		$mycustidproof=$r['custidproof'];
		$mycustaddrs=$r['custaddrs'];
		$mycustphno=$r['custphno'];
		$mycustemailid=$r['custemailid'];
		$mydob=$r['dob'];
		$mydoanni=$r['doanni'];
		$mycreatedon=$r['createdon'];
		$tabyesno='<form id="custnumm'.$myfrmnum.'" onsubmit="return(viewformvalidate());" action="viewcustbilldetails.php" method="post">
		 <input type="hidden" id="custid" name="custid" value="'.$mycustname.' - '.$mycustid.'">
		 <input type="Submit" value="SHOW"></input>
		  </form>';
		  $tabyesno="&nbsp;";
		  $tabupdate='<form id="custnumupd'.$myfrmnum.'" onsubmit="return(updateformvalidate());" action="customerupdate.php" method="post">
		 <input type="hidden" id="custid" name="custid" value="'.$myid.'">
		 <input type="Submit" value="UPDATE"></input>
		  </form>';
		$myacolor="#FFFFFF";
		
			////////////////////////////////////////////////
			$tab_block.='<tr bgcolor="'.$myacolor.'">
			<td>'.$mycustid.'</td>
			<td>'.$mycustname.'</td>
			<td>'.$mycustidproof.'</td>
			<td>'.$mycustaddrs.'</td>
			<td>'.$mycustphno.'</td>
			<td>'.$mycustemailid.'</td>
			<td>'.$mydob.'</td>
			<td>'.$mydoanni.'</td>
			<td>'.$mycreatedon.'</td>
			<td align="center">'.$tabyesno.'</td>
			<td align="center">'.$tabupdate.'</td>
			</tr>'; 
			$myfrmnum++;	
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
 <script src="../datejs/jquery-1.10.2.js"></script>
 <script type="text/javascript">
		function viewformvalidate(){
			var r = confirm("Are you sure to view Bill Details of this cumtomer!");
		if (r == true)
		  {
		  return true;
		  }
		else
		  {
		  return false;
		  }
		  return false;		
}
function updateformvalidate(){
			var r = confirm("Are you sure to update this customer detail!");
		if (r == true)
		  {
		  return true;
		  }
		else
		  {
		  return false;
		  }
		  return false;		
}
//-->
</script>
<script type="text/javascript">
$(function() {
	 //////////////////searcht fromd tod
	 $('#searchterm').bind('change', function() {	 
	 var adepart=$("#searchterm").val();
	//////////else not default starts/////////////
     $.ajax({
         type: "GET", 
         url: "findcustomers.php",
         data: { 
		 		 maadepart:adepart,
				},		 		
         success: function(html) {
			//alert("Hello");
             $("#mycutomer").html(html);
			                     }
           });
	 
	 }); 
	
 });
 
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
     <?php
			if(isset($msg))
			{
			echo "<center><font color='RED' size=+1 >";
			echo $msg;
			echo "</font></center>";
			}
			else{
				echo "&nbsp;";
				}
			?>
      <p align="center"><h2>VIEW CUSTOMERS PANEL</h2>
      <table border="0" cellspacing="1" cellpadding="1" width="100%" bgcolor="#CCCCCC">
          <tr bgcolor="#00CCFF" align="center">
            <td>Search:<input id="searchterm" name="searchterm"></td>            
          </tr>
          <tr bgcolor="#CCFF00" align="center"><td>Search terms: Customer Name, Phone Number, Customer Id</td></tr>
          <tr bgcolor="#CCFF00" align="center"><td>&nbsp;</td></tr>
       </table>
      <div id="mycutomer">
  <table border="0" cellspacing="1" cellpadding="1" width="100%" bgcolor="#CCCCCC" style="font-size:10px;">
  <tr bgcolor="#33CCFF" style="font-size:12px;" align="center">
    <td><strong>CUST.ID</strong></td>
    <td><strong>CUST.NAME</strong></td>
    <td><strong>ID-PROOF</strong></td>
    <td><strong>ADDRESS</strong></td>
    <td><strong>PHONE No.</strong></td>
    <td><strong>Email-Id</strong></td>
    <td><strong>DOB</strong></td>
     <td><strong>Anniversary</strong></td>
    <td><strong>CREATED-ON</strong></td>
    <td><strong>BLDTL</strong></td>
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