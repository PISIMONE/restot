<?php
include("../connect/connectdb.php");
include("check.php");
include("companyvars.php");
?>
<?php 
if(isset($_GET['mymsg']))
{
	$msg=($_GET['mymsg']);
	}
	else{
		$msg=null;
		}
if(isset($_GET['billid']))
{
	$myomybillid=($_GET['billid']);
	}
	else{
		$myomybillid=null;
		}
if(isset($_GET['billno']))
{
	$mybillnum=($_GET['billno']);
	}
	else{
		$mybillnum=null;
		}
if(isset($_GET['billdt']))
{
	$mybillodate=($_GET['billdt']);
	}
	else{
		$mybillodate=null;
		}
if(($mybillnum!=null)&&($mybillodate!=null)&&($myomybillid!=null))	
{	
	$bquery=mysql_query("SELECT * FROM adirestbill WHERE id='$myomybillid' AND billnum='$mybillnum' AND billdate LIKE '%$mybillodate%'");
	while($roy=mysql_fetch_array($bquery)) 
	{
	//////fbid, billnum, billtype, txnum, cncmix, otype, disctype, discount, discamnt, foodbilltotal, parcelbilltotal, parcelcharge, ordpartotal, servcharge, stax, vat, gtotal, gpaid, gdues, billdate, status
	$mykid=$roy['id'];
	$myfidb=$roy['fbid'];
	$myobillnum=$roy['billnum'];
	$myobilltype=$roy['billtype'];
	$myocncmix=$roy['cncmix'];
	$myootype=$roy['otype'];
	$myodisctype=$roy['disctype'];
	$myodiscount=$roy['discount'];
	$myodiscamnt=$roy['discamnt'];
	$myofoodbilltotal=$roy['foodbilltotal'];
	$myorderparcel=$roy['parcelbilltotal'];
	$myparceltaken=$roy['parcelcharge'];
	$myofoodbilltotal=(float)($myofoodbilltotal+$myorderparcel);
	
	
	$myodisamounto=(($myofoodbilltotal*$myodiscount)/100);
	$myofoodbilldistotal=(float)($myofoodbilltotal-$myodisamounto);
	
	//parcelbilltotal parcelcharge servcharge
	
	$mysevper=$roy['servcharge'];
	$schargeamount=(($myofoodbilldistotal*$mysevper)/100);
	//$myorderparcel $myparceltakenv $mysevpers $schargeamount
	
	
	$myostax=$roy['stax'];
	$staxamount=(($myofoodbilldistotal*$myostax)/100);
	$myovat=$roy['vat'];
	$vatamount=(($myofoodbilldistotal*$myovat)/100);
	
	///swachh bharat tax 
	$myosbtax=$roy['sbtax'];
	$sbtaxamount=(($myofoodbilldistotal*$myosbtax)/100);
	
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
			//$tab_block.='<tr><td align="left">KOT No:&nbsp;'.$mykid.'</td></tr>';
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
						$tab_block.='<tr><td align="left" colspan="3">'.$myitemname;
						if((int)$myidisper>0){
							$tab_block.='<br/>'.$myicharge.'-'.$myidisper.'%<br/></td>';
							}
							else{
								$tab_block.='</td>';
								}
						$tab_block.='<td align="center" colspan="1">'.(int)$myuiquan.'</td><td align="right" colspan="1">'.$myktotal.'</td></tr>';
						$mysno++;
						}
			}
			
				if(((float)$mytotaldiscount)>0)
				{	
				$tab_block.='<tr><td align="center" colspan="4">DISCOUNT(%)&nbsp;'.$mytotaldisper.'</td>
								<td align="right">(-)'.$mytotaldiscount.'</td></tr>
							<tr><th colspan="5"><hr /></th></tr>';
							/*<tr><td align="center" colspan="4">Total:&nbsp;</td>
								<td align="right">(+)'.$mytotalgrand.'</td></tr>
							<tr><th colspan="5"><hr /></th></tr>';	*/
				}
				
	  
	}////for loop startlen ends		$myodiscount
	if((int)$myparceltaken>0)
	{
		$tab_block.='<tr><td align="center" colspan="4">PARCEL &nbsp;</td>
								<td align="right">'.number_format($myparceltaken,2).'</td></tr>
							<tr><th colspan="5"><hr /></th></tr>';
		}
		else{
					$tab_block.='<tr><th colspan="5"><hr /></th></tr>';
					}
					///if discount applied is > 0
	$tab_block.='<tr><td align="right" colspan="4" style="font-size:8px; font-weight:normal;"><strong>NET AMOUNT&nbsp;&nbsp;</strong></td>
						<td align="right">'.number_format(((float)$myofoodbilltotal+(float)$myparceltaken),2).'</td></tr><tr><th colspan="5"><hr /></th></tr>';
	if($myodisctype!="NONE"){
		$thedisctype="(".$myodisctype.")";
		}
		else{
			$thedisctype="&nbsp;&nbsp;";
			}
	if((int)$myodiscount>0)
	{
	$tab_block.='<tr><td align="center" colspan="4" style="font-size:8px; font-weight:normal;">DISC(%)'.$thedisctype.' '.$myodiscount.'</td>
						<td align="right">'.number_format($myodisamounto,2).'</td></tr>';
	}
						
	$tab_block.='<tr><td align="center" colspan="4" style="font-size:8px; font-weight:normal;">S.Charge(%)&nbsp;&nbsp;'.$mysevper.'</td>
						<td align="right">'.number_format($schargeamount,2).'</td></tr>
	                 <tr><td align="center" colspan="4" style="font-size:8px; font-weight:normal;">S.TAX(%)&nbsp;&nbsp;'.$myostax.'</td>
						<td align="right">'.number_format($staxamount,2).'</td></tr>
					<tr><td align="center" colspan="4" style="font-size:8px; font-weight:normal;">VAT(%)&nbsp;&nbsp;'.$myovat.'</td>
						<td align="right">'.number_format($vatamount,2).'</td></tr>
					<tr><td align="center" colspan="4" style="font-size:8px; font-weight:normal;">SWACHH B CESS(%)&nbsp;&nbsp;'.$myosbtax.'</td>
						<td align="right">'.number_format($sbtaxamount,2).'</td></tr>
					<tr><th colspan="5"><hr /></th></tr>
					<tr><td align="center" colspan="4">Total:&nbsp;</td>
						<td align="right">'.number_format($myogtotal,2).'</td></tr>
					<tr><td align="center" colspan="4">Paid:&nbsp;</td>
						<td align="right">'.number_format($myogpaid,2).'</td></tr>
					<tr><th colspan="5"><hr /></th></tr>';
		if((int)$myogdues>0){			
		$tab_block.='<tr><td align="center" colspan="4">Dues:&nbsp;</td>
						<td align="right"><strong>'.number_format($myogdues,2).'</strong></td></tr>
					<tr><td align="center" colspan="4">ROUND-OFF:</td><td align="right"><strong>'.round($myogdues).'</strong></td></tr>
					<tr><th colspan="5"><hr /></th></tr>';	
		}
	
}
else{
		header("Location: restviewbill.php");
		exit();
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<center>
<table border="0" cellspacing="0" cellpadding="0" width="250" style="font-family:sans-serif; font-size:10px; font-weight:bold;">
      <tr>
      <td colspan="5" align="center"><strong><?php echo " ".$compvarscname." ";?></strong><br/>
      <?php echo " ".$compvarscaddrs." ";?><br/>
      <?php echo "email: ".$compvarscemail;?><br/>
      <?php echo " Ph No:".$compvarscphno;?><br/>
      </td>
      </tr>
      <tr><td colspan="5"><hr /></td></tr>
       <tr>
      <td colspan="5" align="left"><strong>TIN No.</strong><?php if($compvarsctinno!="NONE"){echo " ".$compvarsctinno." ";} ?><br/>
      <strong>CST No.</strong><?php if($compvarscstno!="NONE"){echo " ".$compvarscstno." ";} ?><br/>
      </td>
      </tr>
      <tr><td colspan="5"><hr /></td></tr>
      <tr><td colspan="5" align="center">
      Bill No.<?php echo " ".$myobillnum." ";?>&nbsp;(<?php echo $myocncmix.")-".$myostatus ;?><hr /></strong></td>
      </tr>
       <tr>
      <td colspan="5"><strong>O_TYPE:</strong><?php echo $myootype;?>,&nbsp;&nbsp;<?php echo $myobilldate;?></td>
       </tr>
       <tr>
      <td colspan="5"><strong>CUST:</strong><?php echo $mycustto;?>,<?php echo $mycustphno;?></td>
       </tr>
       <tr><th colspan="5"><hr /></th></tr>
          <tr>
          	 <td align="center" colspan="3"><strong>ITEM</strong></td>
           	 <td align="center" colspan="1"><strong>QTY</strong></td>
      		 <td align="right" colspan="1"><strong>AMNT</strong></td>
          </tr>
          <tr><th colspan="5"><hr /></th></tr>
					  <?php
              if(isset($tab_block))
              {
                  echo $tab_block;
                  }
              ?>
              <tr><th colspan="5"><?php 
			  						if($myostatus=="Confirm")
									{
										echo "Thankyou! Please visit again.";
										}
										elseif($myostatus=="Cancelled")
									{
										echo "Bill has been CANCELLED!!";
										}
										else{
											echo "BILL IS PENDING!!";
											}
			  					?>
              </th></tr>
              <tr><th colspan="5"><hr /></th></tr>
        </table>
         <?php 
	if($mystatus=="Cancelled")
	{ 
	$queryrs = mysql_query("SELECT * FROM reasonstable WHERE billid='$myomybillid' AND sno='$myobillnum'");
while($rs=mysql_fetch_array($queryrs)) 
		{

		$canentrydate=$rs['entrydate'];
		$cansno=$rs['sno'];
		$candepart=$rs['depart'];
		$canuser=$rs['user'];
		$cangamount=$rs['gamount'];
		$canreasons=$rs['reasons'];
		}
	echo '<table border="0" cellspacing="0" cellpadding="0" width="250" bgcolor="#FFFFFF" style="font-size:9px; font-weight:bold;">
	<tr bgcolor="RED"><td>Cancel Date:</td><td>'.$canentrydate.'</td></tr>
	<tr><td>BILL No.:</td><td>'.$cansno.'</td></tr>
	<tr><td>Department:</td><td>'.$candepart.'</td></tr>
	<tr><td>Cancelled By:</td><td>'.$canuser.'</td></tr>
	<tr><td>Amount:</td><td>'.$cangamount.'</td></tr>
	<tr><td>Reason:</td><td>'.$canreasons.'</td></tr></table>';
	} 
	?>
 </center>   
</body>
</html>