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
//mybillid mybid mybdt
if((!isset($_POST['mybillid']))||(!isset($_POST['mybid']))||(!isset($_POST['mybdt'])))
{
	header("Location: changepaymode.php");
	exit();
	}

$mybillsid=($_POST['mybillid']);
$mybillnum=($_POST['mybid']);
$mybilldate=($_POST['mybdt']);

//echo $mybillsid."<br/>";
//echo $mybillnum."<br/>";
//echo $mybilldate."<br/>";
//exit();

if(($mybillnum!=null)||($mybillsid!=null)||($mybilldate!=null))	
{	

$checkresult = null;
$checkrowb = null;

$checkresult = mysql_query("SELECT * FROM adirestbill WHERE id='$mybillsid' AND billnum='$mybillnum' AND billdate LIKE '%$mybilldate%'");
$checkrowb=mysql_fetch_array($checkresult);
	
	
///*///`id`  `fbid`   `billnum`  `billtype`  `txnum`   `cncmix`   `otype`   `disctype`   `discount`   `discamnt`   `foodbilltotal`   `parcelbilltotal`   `parcelcharge`  `ordpartotal`  `servcharge`  `stax`  `vat`  `gtotal`   `gpaid`  `gdues`   `billdate`  `status` 
//////*/

	$toupdid=$checkrowb['id'];
	$toupdfbid=$checkrowb['fbid'];
	$toupdbillnum=$checkrowb['billnum'];
	$toupdbilltype=$checkrowb['billtype'];
	$toupdtxnum=$checkrowb['txnum'];
	$toupdcncmix=$checkrowb['cncmix'];
	$toupdotype=$checkrowb['otype'];
	$toupddisctype=$checkrowb['disctype'];
	$toupddiscount=$checkrowb['discount'];
	$toupddiscamnt=$checkrowb['discamnt'];
	$toupdfoodbilltotal=$checkrowb['foodbilltotal'];
	$toupdparcelbilltotal=$checkrowb['parcelbilltotal'];
	$toupdparcelcharge=$checkrowb['parcelcharge'];
	$toupdordpartotal=$checkrowb['ordpartotal'];
	$toupdservcharge=$checkrowb['servcharge'];
	$toupdstax=$checkrowb['stax'];
	$toupdvat=$checkrowb['vat'];
	$toupdgtotal=$checkrowb['gtotal'];
	$toupdgpaid=$checkrowb['gpaid'];
	$toupdgdues=$checkrowb['gdues'];
	$toupdbilldate=$checkrowb['billdate'];
	$toupdstatus=$checkrowb['status'];
		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../combojs/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(function() {	
		/////////////////on change payment mode/////////////////////////
		 $("#paymodd").change(function(el){		
		  var todopaymode=document.forms["dirtyroom"]["paymodd"].value;  
		  if (todopaymode=="Card") 
				{
					// radio_check_val = document.getElementsByName('billmytype')[0].value;
					$("#urreason").show(); 
					$("#reasonofi").show();
					document.getElementById("reasonofi").value=null;					
				}
			else{
					document.getElementById("reasonofi").value=null;
					 $("#reasonofi").hide();
					 $("#urreason").hide(); 
					}
				
		});
});
</script>
<script type="text/javascript">
<!--
// Form validation code will come here.
function dirtyformvalidate()
{

 var x=document.getElementById("paymodd").value;
 	 if(x==null || x=="" || x=="DEFAULT")
{
	alert("Cannot procced if Payment Mode is : DEFAULT!");
	document.forms["dirtyroom"].elements["paymodd"].focus();
  	return false;
}
 if(x=="Card")
{
	var xcard=document.getElementById("reasonofi").value;
	if(xcard==null || xcard=="")
		{
	alert("Please enter the Transaction Number of card payment!");
	document.forms["dirtyroom"].elements["reasonofi"].focus();
  	return false;
		}
}
document.getElementById("formval").value="YES";
alert("Paymode Reset.");
}
//-->
</script>
</head>
<body>
<center>
<table border="0" cellspacing="0" cellpadding="0" width="580" style="font-family:'Times New Roman', Times, serif; font-size:16px; font-weight:bold;">
<tr>
      <td colspan="5" align="center"><div align="right"><a href="changepaymode.php"><input type="button" value="Go Back"/></a></div></td>
      </tr>
</table>
<form id="dirtyroom" onSubmit="return(dirtyformvalidate());" action="restbillreset.php" method="post">
<table border="0" cellspacing="0" cellpadding="0" width="580" style="font-family:'Times New Roman', Times, serif; font-size:16px; font-weight:bold;">
	<tr><td colspan="5">
    <input type="hidden" id="thebillid" name="thebillid" value="<?php echo $mybillsid; ?>" >
    <input type="hidden" id="billnumbb" name="billnumbb" value="<?php echo $mybillnum; ?>" >
     <input type="hidden" id="thebilldt" name="thebilldt" value="<?php echo $mybilldate; ?>" >
      <input type="hidden" id="thebilloldsts" name="thebilloldsts" value="<?php echo $toupdbilltype; ?>" >
    </td></tr>
      <tr>
      <td colspan="5" align="center"><strong>AAHAR Bill No. <?php echo $mybillnum;?> &nbsp;(<?php echo $toupdcncmix.")-".$toupdstatus ;?><hr /></strong></td>
      </tr>
       <tr>
      <td colspan="2"><strong>O_TYPE:</strong><?php echo $toupdotype;?></td>
      <td colspan="3"><strong>DATE:</strong><?php echo $toupdbilldate;?></td>
       </tr>
       <tr bgcolor="#00CCFF">
                <td align="right" colspan="5">Grand Total:&nbsp;<?php echo $toupdgtotal;?></td>
           	 </tr>
             <tr bgcolor="#00CCFF">
                <td align="right" colspan="5">Payment Received:&nbsp;<?php echo $toupdgpaid;?></td>
           	 </tr>
             <tr bgcolor="#00CCFF">
                <td align="right" colspan="5">DUES:&nbsp;<?php echo $toupdgdues;?></td>
           	 </tr>
      <tr><th colspan="5"><hr /></th></tr>
               <tr bgcolor="#00CCFF">
          	 <td colspan="5" align="right">
             P.Mode:&nbsp;<select name="paymodd" id="paymodd">
      <option value="DEFAULT">DEFAULT</option>
      <option value="Cash">CASH</option>
      <option value="Card">CARD</option>
       </select></td>
           	 </tr>
              <tr bgcolor="#00CCFF">
          	 <td colspan="5" align="right">
            <div id="urreason" style="display: none;">Transaction No:
            <input type="text" id="reasonofi" name="reasonofi" style="display: none;  width:100px;">
            </div>
            </td>
           	 </tr>
             <tr bgcolor="#99FF66">
                <td align="center" colspan="5"><input type="text" id="formval" name="formval" value="NO"><input type="Submit" value="RE-SETTEL"></input></td>
           	 </tr>
           <tr><th colspan="5"><hr /></th></tr>
        </table>
        </form>
 </center>   
</body>
</html>