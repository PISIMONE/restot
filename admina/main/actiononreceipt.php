<?php
include("../connect/connectdb.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$tab_voucherses=null;
$cappno = $_POST['vocnum'];
$cmafrod = $_POST['stats'];
if($cmafrod=="ACTIVE")
{
	$newcmafrod="CANCELLED";
	}
	elseif($cmafrod=="CANCELLED")
	{
		$newcmafrod="ACTIVE";
		}
$qstring="UPDATE receipt_records SET status='".$newcmafrod."',createdon='".$mytodaydate."' WHERE receipt_number='".$cappno."' AND status='".$cmafrod."'";
//echo $qstring."<br/>";
//exit();
$result = mysql_query($qstring);																		
$count=null;																		
$count=mysql_affected_rows();																		
$count=(int)$count;
	if ($count==1)																								    
	{					
	$msg="$cappno receipt $newcmafrod.<br />"; //.$sql;
	header("Location: receipts.php?mymsg=$msg");
	}
	else
	{
	$msg="$cappno receipt $newcmafrod failed!.";
	header("Location: receipts.php?mymsg=$msg");
	}	
?>