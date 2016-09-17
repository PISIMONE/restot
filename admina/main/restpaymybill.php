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
//mybillid mybid mybilldt
if((!isset($_POST['mybillid']))||(!isset($_POST['mybid']))||(!isset($_POST['mybilldt'])))
{
	header("Location: restviewbill.php");
	exit();
	}

$mybillsid=($_POST['mybillid']);
$mybillnum=($_POST['mybid']);
$mybilldate=($_POST['mybilldt']);


if(($mybillnum!=null)||($mybillsid!=null)||($mybilldate!=null))	
{	

////checking if billing status is Credit ONLY
$isbilled=null;
$checkresult =null;
$checkrowb=null;
$checkstatus=null;
$checkresult = mysql_query("SELECT * FROM adirestbill WHERE id='$mybillsid' AND billnum='$mybillnum' AND billdate LIKE '%$mybilldate%'");
$checkrowb=mysql_fetch_array($checkresult);
	$checkstatus=$checkrowb['status'];
	//echo $checkstatus;
	//exit;
	if($checkstatus=="Credit")
	{
	$isbilled="NO";
	}
	else{
		$isbilled="YES";
		header("Location: restviewbill.php");
		exit();
		}
  if($isbilled=="NO"){


	$bquery=mysql_query("SELECT * FROM adirestbill WHERE id='$mybillsid' AND billnum='$mybillnum' AND billdate LIKE '%$mybilldate%'");
	while($roy=mysql_fetch_array($bquery)) 
	{

	$mykid=$roy['id'];
	$myfidb=$roy['fbid'];
	$myobillnum=$roy['billnum'];
	$myobilltype=$roy['billtype'];
	$myocncmix=$roy['cncmix'];
	$myootype=$roy['otype'];
	$myodiscount=$roy['discount'];
	
	
	$myofoodbilltotal=$roy['foodbilltotal'];
	$myoparcelbilltotal=$roy['parcelbilltotal'];
	$myoparcelcharge=$roy['parcelcharge'];
	$myofoodbilltotal=(float)($myofoodbilltotal+$myoparcelbilltotal);
	
	$myodiscountamount=(($myofoodbilltotal*$myodiscount)/100);
	
	$myofoodblafterdis=(float)($myofoodbilltotal-$myodiscountamount);
	//$myodiscount $myodiscountamount
	
	//parcelbilltotal, parcelcharge, servcharge,
	
	$myoservcharge=$roy['servcharge'];
	$schargeamount=(($myofoodblafterdis*$myoservcharge)/100);
	
	//$myoparcelbilltotal $myoparcelcharge $myoservcharge $schargeamount
	
	$myostax=$roy['stax'];
	$staxamount=(($myofoodblafterdis*$myostax)/100);
	$myovat=$roy['vat'];
	$vatamount=(($myofoodblafterdis*$myovat)/100);
	
	///swachh bharat tax 
	$myosbtax=$roy['sbtax'];
	$sbtaxamount=(($myofoodblafterdis*$myosbtax)/100);
	
	$myogtotal=$roy['gtotal'];
	$myogpaid=$roy['gpaid'];
	$myogdues=$roy['gdues'];
	$myobilldate=$roy['billdate'];
	$myostatus=$roy['status'];		
	}
	
	$mykotidsexp=explode(',',$myfidb);
	//echo $mykotidsexp[0];
	//exit();
	$mykotidsexp=array_filter($mykotidsexp);
	$mykotidlen=(int)count($mykotidsexp);
	$todokotid=null;
	$startlen=0;
	$tab_block=null;
	for($startlen;$startlen<$mykotidlen;$startlen++)
	{
	  $todokotid=$mykotidsexp[$startlen];
	  $query=null;
	//$kotval = stripcslashes($_GET['tkval']);
	//echo $tableData;
	
	$mygtotal=null;
	$query = mysql_query("SELECT * FROM adikotnum WHERE id='$todokotid'");
	while($r=mysql_fetch_array($query)) 
			{
			$mykid=$r['id'];
			$mykotdate=$r['kotdate'];
			$mybilltype=$r['billtype'];
			$myotype=$r['otype'];
			$mywaitrname=$r['waitrname'];
			$myloguser=$r['loguser'];
			$mycustto=$r['custto'];
			$mycustphno=$r['custphno'];
			$mytotalitems=$r['totalitems'];
			$mytotaldisper=$r['totaldisper'];
			$mytotaldiscount=$r['totaldiscount'];
			$mytotalgrand=$r['totalgrand'];
			$mystatus=$r['status'];
			$mysno=1;
			$tab_block.='<tr><td align="left">KOT No:&nbsp;'.$mykid.'</td></tr>
						';
				$query = mysql_query("SELECT * FROM adikotdet WHERE kid='$mykid'");
				while($r=mysql_fetch_array($query)) 
						{
						$mykdetid=$r['id'];
						$myicode=$r['icode'];
						$myitemname=$r['itemname'];
						$myuiquan=$r['uiquan'];
						$myhiquan=$r['hiquan'];
						$myicharge=$r['icharge'];
						$myidisper=$r['idisper'];
						$myktotal=$r['ktotal'];
						$mykktotal=$myktotal;
						$mygtotal=(($mygtotal+(int)$mykktotal));
						$tab_block.='<tr>
										<td align="left">'.$myicode."-".$myitemname.'</td>
										<td align="center">'.$myuiquan.'</td>
										<td align="center">'.$myhiquan.'</td>
										<td align="center" style="font-size:8px; font-weight:normal;">'.$myicharge."-".$myidisper."%".'</td>
										<td align="right">'.$myktotal.'</td>
									</tr>';
						$mysno++;
						}
			}
				if($mytotaldiscount>0)
				{	
				$tab_block.='<tr><td align="center" colspan="4">DISCOUNT(%)&nbsp;'.$mytotaldisper.'</td>
								<td align="right">(-)'.$mytotaldiscount.'</td></tr>
							<tr><th colspan="5"><hr /></th></tr>';
							/*<tr><td align="center" colspan="4">Total:&nbsp;</td>
								<td align="right">(+)'.$mytotalgrand.'</td></tr>
							<tr><th colspan="5"><hr /></th></tr>';	*/
				}
				
	  
	}////for loop startlen ends		
	//$myodiscount $myodiscountamount
	//$myoparcelbilltotal $myoparcelcharge $myoservcharge $schargeamount
	
	$tab_block.='<tr><td align="center" colspan="4">PARCEL &nbsp;</td>
								<td align="right">'.number_format($myoparcelcharge,2).'</td></tr>
							<tr><th colspan="5"><hr /></th></tr>';
		
	$tab_block.='<tr>
	<td align="center" colspan="4" style="font-size:8px; font-weight:normal;">DISC(%)&nbsp;'.$myodiscount.'% of '.number_format($myofoodbilltotal,2).'</td>
	<td align="right">(-)'.number_format($myodiscountamount,2).'</td></tr>
	<tr>
	<td align="center" colspan="4" style="font-size:8px; font-weight:normal;">S.Charge(%)&nbsp;'.$myoservcharge.'% of '.number_format($myofoodblafterdis,2).'</td>
	<td align="right">(+)'.number_format($schargeamount,2).'</td></tr>
	<tr>
	<td align="center" colspan="4" style="font-size:8px; font-weight:normal;">S.TAX(%)&nbsp;'.$myostax.'% of '.number_format($myofoodblafterdis,2).'</td>
						<td align="right">(+)'.number_format($staxamount,2).'</td></tr>
					<tr><td align="center" colspan="4" style="font-size:8px; font-weight:normal;">VAT(%)&nbsp;'.$myovat.'% of '.number_format($myofoodblafterdis,2).'</td>
						<td align="right">(+)'.number_format($vatamount,2).'</td></tr>
					<tr><td align="center" colspan="4" style="font-size:8px; font-weight:normal;">Swachh B Cess(%)&nbsp;'.$myosbtax.'% of '.number_format($myofoodblafterdis,2).'</td>
						<td align="right">(+)'.number_format($sbtaxamount,2).'</td></tr>
					<tr><th colspan="5"><hr /></th></tr>
					<tr><td align="center" colspan="4">Total:&nbsp;</td>
						<td align="right">'.$myogtotal.'</td></tr>
					<tr><td align="center" colspan="4">Paid:&nbsp;</td>
						<td align="right">'.$myogpaid.'</td></tr>
					<tr><th colspan="5"><hr /></th></tr>
					<tr><td align="right" colspan="5">Dues:&nbsp;<strong><input type="text" readonly="readonly" id="predues" name="predues" style="width:90px; text-align:right;" value="'.number_format($myogdues,2).'"></strong></td></tr>
					<tr><td align="right" colspan="5">ROUND-OFF:&nbsp;<strong><input type="text" readonly="readonly" id="rounddues" name="rounddues" style="width:90px; text-align:right;" value="'.round($myogdues).'"></strong></td></tr>
					<tr><th colspan="5"><hr /></th></tr>';	
	
  }////if end for $isbulled="NO"
  else{
	  header("Location: restpaybill.php");
	  exit();
	  }
	
	
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../combojs/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(function() {	
		jQuery('#payamount').on('input propertychange paste', function(){	
			var myparcelchrg=parseInt(document.getElementById("payamount").value);
		  if (((myparcelchrg=="NaN")||(myparcelchrg==""))&&(myparcelchrg!=0)) 
				{
				alert("Please enter a valid input for payment amount!");	
				document.forms["dirtyroom"]["payamount"].value=""; 
				}
				else{
					document.getElementById("payamount").value=myparcelchrg;
					var predueamnt=parseFloat(document.getElementById("rounddues").value);
					var diffofnum=parseFloat(predueamnt-myparcelchrg);
					document.getElementById("finaldues").value=(Math.round(diffofnum*100)/100); 
					}
					
       	});
		/////////////////on change payment mode/////////////////////////
		 $("#paymodd").change(function(el){		
		  document.getElementById("payamount").value=null;
		  var todopaymode=document.forms["dirtyroom"]["paymodd"].value; 
		  /////new elements urreason2 reasonofi2 reasonofi3 
		  if (todopaymode=="Card") 
				{
					$('#payamount').attr('readonly', false);
					// radio_check_val = document.getElementsByName('billmytype')[0].value;
					document.getElementById("reasonofii").value=null;
					$("#urreason").show(); 
					$("#reasonofi").show();
					$("#reasonofii").hide(); 
					$("#urreasons").hide(); 
					////new elements
					document.getElementById("reasonofi2").value=0;
					document.getElementById("reasonofi3").value=0;
					$("#reasonofi2").hide(); 
					$("#reasonofi3").hide(); 
					$("#urreason2").hide();     
					 
				}
				else if(todopaymode=="Mixed") 
				{
					////change payamount received to readonly
					 $('#payamount').attr('readonly', true);
					////new elements
					$("#urreason2").show();
					$("#reasonofi2").show(); 
					$("#reasonofi3").show();
					document.getElementById("reasonofi2").value=null;
					document.getElementById("reasonofi3").value=null;
					 
					 ////hide others
					 document.getElementById("reasonofii").value=null;
					 $("#reasonofii").hide(); 
					 $("#urreasons").hide(); 
					 document.getElementById("reasonofi").value=null;
					 $("#reasonofi").show();
					 $("#urreason").show(); 						
					
				}
				else if(todopaymode=="Cancelled") 
				{
					$('#payamount').attr('readonly', false);
					// radio_check_val = document.getElementsByName('billmytype')[0].value;
					document.getElementById("reasonofi").value=null;
					 $("#reasonofi").hide();
					 $("#urreason").hide(); 					 
					 $("#urreasons").show();  
					 $("#reasonofii").show(); 
					 
					 ////new elements
					document.getElementById("reasonofi2").value=0;
					document.getElementById("reasonofi3").value=0;
					$("#reasonofi2").hide(); 
					$("#reasonofi3").hide(); 
					$("#urreason2").hide();   
					 
				}
				else{
					$('#payamount').attr('readonly', false);
					document.getElementById("reasonofi").value=null;
					document.getElementById("reasonofii").value=null;
					 $("#reasonofi").hide();
					 $("#urreason").hide(); 
					 $("#reasonofii").hide(); 
					 $("#urreasons").hide();  
					  ////new elements
						document.getElementById("reasonofi2").value=0;
						document.getElementById("reasonofi3").value=0;
						$("#reasonofi2").hide(); 
						$("#reasonofi3").hide(); 
						$("#urreason2").hide();  
					}
				
		});
		/////////////////on change of card amount paid for mixed payment/////////////////////////
		 $("#reasonofi2").change(function(el){		
		 document.getElementById("payamount").value=null;
		  var card_amount=parseFloat(document.forms["dirtyroom"]["reasonofi2"].value); 
		    var predueamnt=parseFloat(document.getElementById("rounddues").value);
			var diffofnum=parseFloat(predueamnt-card_amount);
			document.getElementById("reasonofi3").value=(Math.round(diffofnum*100)/100);
			document.getElementById("payamount").value=(Math.round((card_amount+diffofnum)*100)/100);
			document.getElementById("finaldues").value=(Math.round((predueamnt-(card_amount+diffofnum))*100)/100);		  
		  });
		  
});
</script>
<script type="text/javascript">
<!--
// Form validation code will come here.
function dirtyformvalidate()
{

 var x=document.getElementById("paymodd").value;
 var y=document.getElementById("finaldues").value;
 	//alert(y);
 var ya=parseInt(0);
 	//alert(ya);
      	 if(x==null || x=="" || x=="Credit")
{
	alert("Cannot confirm bill if Payment Mode is : Credit!");
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
if(x=="Mixed")
{
	var xcard=document.getElementById("reasonofi").value;
	if(xcard==null || xcard=="")
		{
	alert("Please enter the Transaction Number of card payment!");
	document.forms["dirtyroom"].elements["reasonofi"].focus();
  	return false;
		}
	var xcardamount=document.getElementById("reasonofi2").value;
	if(xcardamount==null || xcardamount=="")
		{
	alert("Please enter the Amount of card payment!");
	document.forms["dirtyroom"].elements["reasonofi2"].focus();
  	return false;
		}
}
 if(x=="Cancelled")
{
	var xcan=document.getElementById("reasonofii").value;
	if(xcan==null || xcan=="")
		{
	alert("Please provide a reason for Cancellation of Bill!");
	document.forms["dirtyroom"].elements["reasonofii"].focus();
  	return false;
		}
}
if(y==null || y=="" || y=="NaN")
{
	alert("Please settle the final dues to zero!");
	document.forms["dirtyroom"].elements["payamount"].focus();
  	return false;
}
y=parseInt(y);
if(y!=ya)
{
	alert("Please settle the final dues to zero2!");
	document.forms["dirtyroom"].elements["payamount"].focus();
  	return false;
}
document.getElementById("formval").value="YES";
alert("Bill Confirmed!.");
}
//-->
</script>
</head>
<body>
<center>
<form id="dirtyroom" onSubmit="return(dirtyformvalidate());" action="restbillconfirm.php" method="post">
<table border="0" cellspacing="0" cellpadding="0" width="280" style="font-family:'Times New Roman', Times, serif; font-size:9px; font-weight:bold;">
	<tr><td colspan="5">
    <input type="hidden" id="thebillid" name="thebillid" value="<?php echo $mybillsid; ?>" >
     <input type="hidden" id="thebilldt" name="thebilldt" value="<?php echo $mybilldate; ?>" >
    </td></tr>
      <tr>
      <td colspan="5" align="center"><strong>AAHAR Bill No.<input type="text" readonly="readonly" id="billnumbb" name="billnumbb" style="width:70px; text-align:right;" value="<?php echo $myobillnum;?>" >&nbsp;(<?php echo $myocncmix.")-".$myostatus ;?><hr /></strong></td>
      </tr>
       <tr>
      <td colspan="2"><strong>O_TYPE:</strong><?php echo $myootype;?></td>
      <td colspan="3"><strong>DATE:</strong><?php echo $myobilldate;?></td>
       </tr>
       <tr>
      <td colspan="3"><strong>CUST:</strong><?php echo $mycustto;?></td>
      <td colspan="2"><strong>PHNo:</strong><?php echo $mycustphno;?></td>
       </tr>
       <tr><th colspan="5"><hr /></th></tr>
          <tr>
          	 <td align="center"><strong>ITEM</strong></td>
           	 <td align="center"><strong>FULL</strong></td>
       		 <td align="center"><strong>HALF</strong></td>
             <td align="center"><strong>DISC</strong></td>
      		 <td align="right"><strong>AMNT</strong></td>
          </tr>
          <tr><th colspan="5"><hr /></th></tr>
					  <?php
              if(isset($tab_block))
              {
                  echo $tab_block;
                  }
              ?>
              <tr><td colspan="5" align="center"><?php 
			  						if($myostatus=="Confirm")
									{
										echo "Thankyou! Please visit again.";
										}
										else{
											echo "BILL IS PENDING!!";
											}
			  					?>
              </td></tr>
               <tr bgcolor="#00CCFF">
          	 <td colspan="5" align="right">
             P.Mode:&nbsp;<select name="paymodd" id="paymodd">
      <option value="Credit">CREDIT</option>
      <option value="Cash">CASH</option>
      <option value="Card">CARD</option>
      <option value="Mixed">MIXED</option>
      <option value="Management">MANAGEMENT</option>
       <option value="Cancelled">CANCEL</option>
       </select></td>
           	 </tr>
              <tr bgcolor="#00CCFF">
          	 <td colspan="5" align="right">
            <div id="urreason" style="display: none;">Transaction No:
            <input type="text" id="reasonofi" name="reasonofi" style="display: none;  width:100px;">
            </div>
            <div id="urreason2" style="display: none;">CARD AMOUNT:
            <input type="text" id="reasonofi2" name="reasonofi2" style="display: none;  width:100px;">
            <br/>CASH AMOUNT:
            <input type="text" readonly="readonly" id="reasonofi3" name="reasonofi3" style="display: none;  width:100px;">
            </div>
            <div id="urreasons" style="display: none;">Cancellation Reason:
            <textarea id="reasonofii" name="reasonofii" cols="20" rows="5"></textarea>
            </div>
            </td>
           	 </tr>
             <tr bgcolor="#00CCFF">
                <td align="right" colspan="5">Payment Received:&nbsp;<input type="text" id="payamount" name="payamount" style="width:90px; text-align:right;"></td>
           	 </tr>
             
             
              <tr bgcolor="#99FF66">
                <td align="right" colspan="5">Final Dues:&nbsp;<input type="text" readonly="readonly" id="finaldues" name="finaldues" style="width:90px; text-align:right;"></td>
           	 </tr>
             <tr bgcolor="#99FF66">
                <td align="center" colspan="5"><input type="text" id="formval" name="formval" value="NO"><input type="Submit" value="FINALISE"></input></td>
           	 </tr>
           <tr><th colspan="5"><hr /></th></tr>
        </table>
        </form>
 </center>   
</body>
</html>