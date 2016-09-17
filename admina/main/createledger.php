<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$tab_ledgers=null;
$msg=null;
$qqstring="SELECT * FROM ledgers_name GROUP BY adidepart ORDER BY adidepart ASC";
//echo $qstring."<br/>";
$stmtt = mysql_query($qqstring);
while($rr=mysql_fetch_array($stmtt)) 
		{
		
		$tab_ledgers.='<tr align="center" bgcolor="#33CCFF">
						<td>'.$rr['adidepart'].'</td>    
						<td>'.$rr['accounts_type'].'</td>    
						<td>'.$rr['ledgername'].'</td>    
						<td>'.$rr['createdon'].'</td>    
					  </tr>'; 
		}
?>
<?php

if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$msg=null;
$sql=null;
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$mydepart=strtoupper(addslashes(trim($_POST['depart'])));
$myacctype=strtoupper(addslashes(trim($_POST['acctype'])));
$mylname=strtoupper(addslashes(trim($_POST['lname'])));
$mylname=$mydepart."_".$myacctype."_".$mylname;
$sql = "INSERT INTO ledgers_name(adidepart, accounts_type, ledgername, createdon) VALUE('$mydepart', '$myacctype', '$mylname', '$mytodaydate')";
$result = mysql_query($sql);																		
$count=null;																		
$count=mysql_affected_rows();																		
$count=(int)$count;
	if ($count==1)																								    
	{					
	$msg="$mylname ledger Sucessfully Created.<br />"; //.$sql;
	}
	else
	{
	$msg="$mylname ledger creation failed!.";
	}	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE LEDGER MAINPAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
$(function() {
	$('input[type="submit"]').attr('disabled','disabled'); 
	 $('#depart, #acctype, #lname').bind('change', function() {	 
	 var lilname=$("#lname").val();
	 var depname=$("#depart").val();
	 var actype=$("#acctype").val();
	 lilname=depname+'_'+actype+'_'+lilname;
	 lilname=lilname.toUpperCase();
	 //alert(lilname);
     $.ajax({
         type: "GET", 
         url: "findlname.php",
         data: { 
		 		 mappno : lilname
     			},		 		
         success: function(html) {
             $("#tababv").html(html);
			  var butname=$("#yourbut").val();
		 if(butname=="YES")
		 {
			 $('input[type="submit"]').removeAttr('disabled');
			 }
			else if(butname=="NO")
		 {
			 $('input[type="submit"]').attr('disabled','disabled'); 
			 
			 }
			 
                              }
           });
		   
		  
	 }); 
	 //////////////////
	
	 
	 //////////////////////
 }); 
</script>


<script type="text/javascript">
<!--
// Form validation code will come here.
function addformvalidate()
{
 var x=document.forms["addroom"]["depart"].value;
 var y=document.forms["addroom"]["acctype"].value;
  var z=document.forms["addroom"]["lname"].value;
       	 if(x==null || x=="" || x=="DEFAULT")
{
	alert("Please Select a Department!");
	document.forms["addroom"].elements["depart"].focus();
  	return false;
}
 if(y==null || y=="" || y=="DEFAULT")
{
	alert("Please Select an Account Type!");
	document.forms["addroom"].elements["acctype"].focus();
  	return false;
}
 	 if(z==null || z=="")
{
	alert("Please enter the Ledger Name!");
	document.forms["addroom"].elements["lname"].focus();
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
      <p align="center"><h2>LEDGER DASHBOARD</h2>
        <form id="additems" onsubmit="return(addformvalidate());" action="" method="post">
       <table border="0" cellpadding="5" cellspacing="15">
  <tr align="center">
    <td colspan="4"><font color="#00CC33" size="+1">CREATE NEW LEDGER</font></td>    
  </tr>
  <tr align="center">
    <td colspan="4"><?php
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
  <tr align="center">
    <td>DEPARTMENT:</td>
    <td align="right"><select name="depart" id="depart" class="mytext highlight" tabindex="1">
        <option value="DEFAULT">DEFAULT</option>
	   <option value="RESTAURANT">RESTAURANT</option>
        </select></td>
    <td>&nbsp;</td>
  </tr>
   <tr align="center">
    <td>ACCOUNT TYPE:</td>
    <td align="right"><select name="acctype" id="acctype" class="mytext highlight" tabindex="2">
        <option value="DEFAULT">DEFAULT</option>
		<option value="ASSETS">ASSETS</option>
        <option value="LIABILITIES">LIABILITIES</option>
        <option value="CAPITALS">CAPITALS</option>
        <option value="INCOMES">INCOMES</option>
        <option value="EXPENSES">EXPENSES</option>
        </select></td>
      <td>&nbsp;</td>
  </tr>
  <tr>
     <td>LEDGER NAME:</td>
     <td align="right"><input type="text" id="lname" name="lname" class="mytext highlight" tabindex="3"></td>
   	  <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><div id="tababv"><input type="hidden" id="yourbut" name="yourbut" value="NO"><font color="#00CC33" size="-1"><img src="images/searchrotate.gif" width="20">waiting...</font></div></td>
  </tr>
  <tr>
    <td><input type="hidden" id="formval" name="formval" value="NO"></td>
    <td><input type="submit" value="CREATE" class="mytext onlyhighlight" tabindex="4" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
      </p>
      <p align="center">
      <table border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="90%">
  <tr align="center">
    <td colspan="4"><font color="#00CC33" size="+1">AVAILABLE LEDGERS</font></td>    
  </tr>
   <tr align="center" bgcolor="#CCCCCC">
    <td>DEPARTMENT</td>    
    <td>ACCOUNT_TYPE</td>    
    <td>LEDGER_NAME</td>    
    <td>CREATED_ON</td>    
  </tr>
  <?php
  if(isset($tab_ledgers))
  {
	  echo $tab_ledgers;
	  }
  ?>
  </table>
      </p>
      <br /><br /><br /><br /><br /><br /><br /><br />
      
    </div>
    
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