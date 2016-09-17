<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$Vgyelg4hyy0x = (string)date("Y-m-d H:i:s");
$Vtl3kxq0evgq=$Vbdoen3sc23v;

$Vy3xp1y0eiui=null;
$Vcyjepzb2cs1=null;

$Vo1yqtthxyo0=null;
$V1qf25cd4hwt=$_GET['mappno'];




$thisquery=null;
$thisresult=null;
$thisnumrow=null;
$thisquery = "SELECT * FROM adikotnum WHERE id='".$V1qf25cd4hwt."' AND status='Processing'";
$thisresult = mysql_query($thisquery) or die(mysql_error());
$thisnumrow=mysql_num_rows($thisresult);
// echo $thisnumrow."<br/>";
 

if(($thisnumrow==null ) || ($thisnumrow=='') || (!isset($thisnumrow)) || ($thisnumrow==0))
		{
			$thisnumrow=0;
			}
		
		
if($thisnumrow==1)
{





$Vcmcdprua4gz="KOT".$V1qf25cd4hwt;
$Vyvxmnhfx4as=$_GET['mapcangtotal'];
$Vzop2x1z4qbq=$_GET['mapcanres'];
$Vcyjepzb2cs1 = "INSERT INTO reasonstable(entrydate, sno, depart, user, gamount, reasons, status) VALUES('$Vgyelg4hyy0x', '$Vcmcdprua4gz', 'RESTAURANT', '$Vtl3kxq0evgq', '$Vyvxmnhfx4as', '$Vzop2x1z4qbq', 'Cancelled')";
$V4ebpgunyn30 = mysql_query($Vcyjepzb2cs1) or die(mysql_error());
				$Vkcmnaf0ivy5=null;
				$Vkcmnaf0ivy5=mysql_affected_rows();
				$Vkcmnaf0ivy5=(int)$Vkcmnaf0ivy5;
			if ($Vkcmnaf0ivy5==1)
			{
				$Vcyjepzb2cs1w = "UPDATE adikotnum SET status='Cancelled' WHERE id='".$V1qf25cd4hwt."'";
				$V4ebpgunyn30w = mysql_query($Vcyjepzb2cs1w) or die(mysql_error());
				$Vo1yqtthxyo0=mysql_affected_rows();
				$Vo1yqtthxyo0=(int)$Vo1yqtthxyo0;
					if ($Vo1yqtthxyo0==1)
					{					
					$Vy3xp1y0eiui="KOT Status Changed to Cancelled.";
					}
					else
					{
					$Vcyjepzb2cs1i = "DELETE FROM reasonstable WHERE sno='".$Vcmcdprua4gz."'";
					$V4ebpgunyn30i = mysql_query($Vcyjepzb2cs1i) or die(mysql_error());
					$Vy3xp1y0eiui="KOT Status Updation failed!.";
					}	

			}
			else{
				$Vy3xp1y0eiui="Insert into reason table failed!.";
				}
				


}//if condition ($thisnumrow==1) ENDS
else{
	$Vy3xp1y0eiui="Action on this KOT already done.";
	}


echo $Vy3xp1y0eiui;
?>