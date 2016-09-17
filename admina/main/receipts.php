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
?>
<?php
$tab_vouchers=null;
$qqstring="SELECT * FROM receipt_records ORDER BY createdon DESC";
//echo $qstring."<br/>";
$stmtt = mysql_query($qqstring);
while($rr=mysql_fetch_array($stmtt)) 
		{
		
		$tokvoucher_number=$rr['receipt_number'];
		$tokvoucher_date=$rr['receipt_date'];
		$tokledger_dept=$rr['ledger_dept'];
		$tokledger_account_type=$rr['ledger_account_type'];
		$tokledger_name=$rr['ledger_name'];
		$tokpaid_to=$rr['paid_to'];
		$tokpaid_for_particulars=$rr['paid_for_particulars'];
		$tokpayment_mode=$rr['payment_mode'];
		$tokcheque_number=$rr['cheque_number'];
		$tokcheque_dated=$rr['cheque_dated'];
		$tokcheque_amount=$rr['cheque_amount'];
		$toktotal_amount=$rr['total_amount'];
		$tokremarks=$rr['remarks'];
		$tokcreatedon=$rr['createdon'];
		$tokstatus=$rr['status'];
		if($tokstatus=="ACTIVE")
		{
			$myacolor="#33CCFF";
			}
		else{
			$myacolor="#FF0000";
			}
		$tab_vouchers.='<tr align="center" bgcolor="'.$myacolor.'">
						<td>'.$tokvoucher_number.'</td>    
						<td>'.$tokvoucher_date.'</td>    
						<td>'.$tokledger_name.'</td>    
						<td>'.$tokpaid_to.'</td>    
						<td>'.$tokpaid_for_particulars.'</td>    
						<td>'.$tokpayment_mode.'</td> 
						<td>'.$tokcheque_number.'</td>    
						<td>'.$tokcheque_dated.'</td>    
						<td>'.$tokcheque_amount.'</td>    
						<td>'.$toktotal_amount.'</td>  
						<td>'.$tokremarks.'</td>    
						<td>'.$tokcreatedon.'</td>
						<td>'.$tokstatus.'</td>      
					  </tr>'; 
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE RECEIPTS MAINPAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<link rel="stylesheet" href="../datejs/jquery-ui.css">
  <script src="../datejs/jquery-1.10.2.js"></script>
  <script src="../datejs/jquery-ui.js"></script>
  <link rel="stylesheet" href="../datejs/style.css">
<script type="text/javascript">
$(function() {
	 $('#depart, #acctype').bind('change', function() {	 
	 var depname=$("#depart").val();
	 var actype=$("#acctype").val();
	 var lilname=depname+'_'+actype+'_';
	 lilname=lilname.toUpperCase();
	 //alert(lilname);
     $.ajax({
         type: "GET", 
         url: "findledgers.php",
         data: { 
		 		 mappno : lilname
     			},		 		
         success: function(html) {
             $("#tab_acctpe").html(html);
			                     }
           });
		   
		  
	 }); 
	 //////////////////searcht fromd tod
	 $('#searcht, #fromd, #tod').bind('change', function() {	 
	 var asearcht=$("#searcht").val();
	 var afromd=$("#fromd").val();
	 var atod=$("#tod").val();
	 
	 //alert(lilname);
     $.ajax({
         type: "GET", 
         url: "findreceipts.php",
         data: { 
		 		 mappno:asearcht,
				 mafromd:afromd,
				 matod:atod
				 },		 		
         success: function(html) {
			//alert("Hello");
             $("#voucherres").html(html);
			                     }
           });
		   
		  
	 }); 	 
	 //////////////////////
	  $('#paymodd').bind('change', function() {	 
	 var apaymodd=$("#paymodd").val();
	 ///chequeno chequedate chequeamnt tamount
	 if(apaymodd=="CHEQUE")
	 {
		 $("#chequeno").val(null);
		 $("#chequedate").val(null);
		 $("#chequeamnt").val(null);
		 $("#tamount").val(null);
		 $("#chequeno").attr("readonly", false); 
		 $("#chequedate").attr("readonly", false)
		 		.datepicker({
								minDate: 0,
								dateFormat: 'yy-mm-dd',
							  }); 
		 $("#chequeamnt").attr("readonly", false); 
		 $("#tamount").attr("readonly", true); 
		 }
		 else{
			 $("#chequeno").val(null);
			 $("#chequedate").val(null);
			 $("#chequeamnt").val(null);
			 $("#tamount").val(null);
			 $("#chequeno").attr("readonly", true); 
			 $("#chequedate").attr("readonly", true)
			                .datepicker("destroy");
			
			 $("#chequeamnt").attr("readonly", true); 
			 $("#tamount").attr("readonly", false);  
			 }
		   
		  
	 }); 	 
	 ///////////////////////
 }); 
</script>
<script>
 $(function() {
    $( "#voucherdate" ).datepicker({
		dateFormat: 'yy-mm-dd',
      });
    });
   /* $(function() {
    $( "#chequedate" ).datepicker({
		minDate: 0,
		dateFormat: 'yy-mm-dd',
      });
    });	*/
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
<!--
// Form validation code will come here.
function canformvalidate()
{
 var r = confirm("Are you sure to CANCEL this receipt!");
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
function actformvalidate()
{
 var r = confirm("Are you sure to Activate this receipt!");
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
<!--
// Form validation code will come here.//voucherdate depart acctype lname paidto particul paymodd chequeno chequedate chequeamnt tamount remarkss
function addformvalidate()
{
	 var xm=document.forms["addroom"]["voucherdate"].value;
 var x=document.forms["addroom"]["depart"].value;
 var y=document.forms["addroom"]["acctype"].value;
  var z=document.forms["addroom"]["lname"].value;
  var xa=document.forms["addroom"]["paidto"].value;
  //alert("Hello");
 var ya=document.forms["addroom"]["particul"].value;
  var za=document.forms["addroom"]["paymodd"].value;
  var xb=document.forms["addroom"]["chequeno"].value;
 var yb=document.forms["addroom"]["chequedate"].value;
  var zb=document.forms["addroom"]["chequeamnt"].value;
  var xc=document.forms["addroom"]["tamount"].value;
  if(xm==null || xm=="")
{
	alert("Please Select a RECEIPT DATE!");
	document.forms["addroom"].elements["voucherdate"].focus();
	return false;
} 
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
 	 if(z==null || z=="" || z=="DEFAULT")
{
	alert("Please Select a Ledger Name!");
	document.forms["addroom"].elements["lname"].focus();
  	return false;
}
 if(xa==null || xa=="")
{
	alert("Please provide a RECEIVED FROM Name!");
	document.forms["addroom"].elements["paidto"].focus();
  	return false;
}
 if(ya==null || ya=="")
{
	alert("Please provide the RECEIVED FOR PARTICULARS Description!");
	document.forms["addroom"].elements["particul"].focus();
  	return false;
}
 	 if(za==null || za=="" || za=="DEFAULT")
{
	alert("Please Select a Payment Mode!");
	document.forms["addroom"].elements["paymodd"].focus();
  	return false;
}
if(za=="CHEQUE")
{
			 if(xb==null || xb=="")
		{
			alert("Please provide a CHEQUE Number!");
			document.forms["addroom"].elements["chequeno"].focus();
			return false;
		}
		 if(yb==null || yb=="")
		{
			alert("Please Select an CHEQUE DATE!");
			document.forms["addroom"].elements["chequedate"].focus();
			return false;
		}
			 if(zb==null || zb=="")
		{
			alert("Please provide a CHEQUE Amount!");
			document.forms["addroom"].elements["chequeamnt"].focus();
			return false;
		}

	}
if((za=="CASH")||(za=="CARD")||(za=="MANAGEMENT"))
{
			 if(xc==null || xc=="")
			{
				alert("Please provide the Amount!");
				document.forms["addroom"].elements["tamount"].focus();
				return false;
			}
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
      <p align="center"><h2>RECEIPTS DASHBOARD</h2>
        <form id="addroom" onsubmit="return(addformvalidate());" action="generatereceipt.php" method="post">
       <table border="0" cellpadding="5" cellspacing="5" width="100%" bgcolor="#CCCCCC">
  <tr align="center">
    <td colspan="6"><font color="#00CC33" size="+1">CREATE NEW RECEIPT</font></td>    
  </tr>
  <tr align="center">
    <td colspan="6"><?php
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
    <td>RECEIPT DATE:</td>
     <td><input type="text" id="voucherdate" name="voucherdate" class="mytext highlight" tabindex="1"></td>    
      <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DEPARTMENT:</td>
    <td><select name="depart" id="depart" class="mytext highlight" tabindex="2">
        <option value="DEFAULT">DEFAULT</option>
		 <option value="RESTAURANT">RESTAURANT</option>
        </select></td>
    <td>ACCOUNT TYPE:</td>
    <td><select name="acctype" id="acctype" class="mytext highlight" tabindex="3">
        <option value="DEFAULT">DEFAULT</option>
		<option value="ASSETS">ASSETS</option>
        <option value="LIABILITIES">LIABILITIES</option>
        <option value="CAPITALS">CAPITALS</option>
        <option value="INCOMES">INCOMES</option>
        <option value="EXPENSES">EXPENSES</option>
        </select></td>
        <td>LEDGER NAME:</td>
     <td><div id="tab_acctpe"><select name="lname" id="lname" class="mytext highlight" tabindex="4">
        <option value="DEFAULT">DEFAULT</option>
        </select></div></td>
  </tr>
  <tr>
  <td>RECEIVED_FROM:</td>
  <td><input type="text" id="paidto" name="paidto" class="mytext highlight" tabindex="5"></td>
  <td>RECEIVED FOR PARTICULARS:</td>
  <td colspan="3"><textarea id="particul" name="particul" cols="50" rows="3" class="mytext highlight" tabindex="6"></textarea></td>
  </tr>
  <tr>
  <td>PAYMENT MODE:</td>
  <td><select name="paymodd" id="paymodd" class="mytext highlight" tabindex="7">
        <option value="DEFAULT">DEFAULT</option>
		<option value="CASH">CASH</option>
        <option value="CHEQUE">CHEQUE</option>
        <option value="CARD">CARD</option>
        <option value="MANAGEMENT">MANAGEMENT</option>
        </select></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
  <tr>
  	 <td>CHEQUE No.</td>
	 <td><input readonly="readonly" type="text" id="chequeno" name="chequeno" class="mytext highlight" tabindex="8"></td>
     <td>CHEQUE DATE:</td>
     <td><input readonly="readonly" type="text" id="chequedate" name="chequedate" class="mytext highlight" tabindex="9"></td>
     <td>CHEQUE AMOUNT:</td>
     <td><input readonly="readonly" type="text" id="chequeamnt" name="chequeamnt" class="mytext highlight" tabindex="10"></td>
  </tr>
   <tr>
  	 <td>AMOUNT</td>
	 <td><input readonly="readonly" type="text" id="tamount" name="tamount" class="mytext highlight" tabindex="11"></td>
     <td>REMARKS:</td>
     <td colspan="3"><textarea id="remarkss" name="remarkss" cols="50" rows="3" class="mytext highlight" tabindex="12"></textarea></td>
  </tr>
  <tr>
    <td><input type="hidden" id="formval" name="formval" value="NO"></td>
    <td colspan="4" align="center"><input type="submit" value="GENERATE RECEIPT" class="mytext onlyhighlight" tabindex="13"/></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
      </p>
      
      <p align="center">
      
       <table border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="90%">
  <tr align="center">
    <td colspan="15"><font color="#00CC33" size="+1">SEARCH IN RECEIPT</font></td>    
  </tr>
  <tr>
  <td>SEARCH TERM:</td>
  <td><input type="text" id="searcht" name="searcht" class="mytext highlight" tabindex="14"></td>
  <td>FROM DATE:</td>
  <td><input type="text" id="fromd" name="fromd" class="mytext highlight" tabindex="15"></td>
  <td>TO DATE:</td>
  <td><input type="text" id="tod" name="tod" class="mytext highlight" tabindex="16"></td>
  </tr>
  </table>
  <br/><br/>
    <div id="voucherres">  
      <table border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="100%">
  <tr align="center">
    <td colspan="13"><font color="#00CC33" size="+1">RECEIPT ISSUED</font></td>    
  </tr>
   <tr align="center" bgcolor="#CCCCCC">
    <td>RECEIPT_No.</td>    
    <td>RECEIPT_DATE</td>    
    <td>LEDGER_NAME</td>   
    <td>RECEIVED_FROM</td>    
    <td>RECEIVED_FOR</td>    
    <td>PAYMENT_TYPE</td>  
    <td>CHEQUE_No.</td>    
    <td>CHEQUE_DATE</td>    
    <td>CHEQUE_AMOUNT</td>    
    <td>TOTAL_AMOUNT</td>  
    <td>REMARKS</td>    
    <td>CREATED_ON</td> 
    <td>STATUS</td> 
  </tr>
   <?php
  if(isset($tab_vouchers))
  {
	  echo $tab_vouchers;
	  }
  ?>
  </table>
   </div>
  
      </p>
      <br /><br /><br /><br /><br /><br /><br /><br />
      
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