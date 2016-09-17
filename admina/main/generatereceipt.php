<?php
include("../connect/connectdb.php");
include("check.php");
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
	////voucherdate depart acctype lname paidto particul paymodd chequeno chequedate chequeamnt tamount remarkss
$msg=null;
$sql=null;
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$myvoucherdate=addslashes(trim($_POST['voucherdate']));
$myvoucherdate=$myvoucherdate." 00:00:00";
$mydepart=strtoupper(addslashes(trim($_POST['depart'])));
$myacctype=strtoupper(addslashes(trim($_POST['acctype'])));
$mylname=strtoupper(addslashes(trim($_POST['lname'])));
$mypaidto=strtoupper(addslashes(trim($_POST['paidto'])));
$myparticul=strtoupper(addslashes(trim($_POST['particul'])));
$mypaymodd=strtoupper(addslashes(trim($_POST['paymodd'])));
if($mypaymodd=="CHEQUE")
{
$mychequeno=strtoupper(addslashes(trim($_POST['chequeno'])));
$mychequedate=addslashes(trim($_POST['chequedate']));
$mychequedate=$mychequedate." 00:00:00";
$mychequeamnt=strtoupper(addslashes(trim($_POST['chequeamnt'])));
$mytamount="";
}
if(($mypaymodd=="CASH")||($mypaymodd=="CARD")||($mypaymodd=="MANAGEMENT"))
{
$mytamount=strtoupper(addslashes(trim($_POST['tamount'])));
$mychequeno="";
$mychequedate="";
$mychequeamnt="";
}
$myremarkss=strtoupper(addslashes(trim($_POST['remarkss'])));
//////////////////getting the booking max id//////////////////////////
		
	///////////////////////////////////////////////////////////////
	$tempreceiptnum=substr(str_shuffle(MD5(microtime())), 0, 10);
$sql = "INSERT INTO receipt_records(receipt_number, receipt_date, ledger_dept, ledger_account_type, ledger_name, paid_to, paid_for_particulars, payment_mode, cheque_number, cheque_dated, cheque_amount, total_amount, remarks, createdon, status) VALUE('$tempreceiptnum', '$myvoucherdate', '$mydepart', '$myacctype', '$mylname', '$mypaidto', '$myparticul', '$mypaymodd', '$mychequeno', '$mychequedate', '$mychequeamnt', '$mytamount', '$myremarkss', '$mytodaydate', 'ACTIVE')";
$result = mysql_query($sql);																		
$count=null;																		
$count=mysql_affected_rows();																		
$count=(int)$count;
	if ($count==1)																								    
	{			
		$mybokinum = null;
		$sqltv = null;
		$resultyv = null;
		$sql=null;
	    $sql=mysql_query("SELECT id FROM receipt_records WHERE receipt_number='$tempreceiptnum'");
		$row=mysql_fetch_array($sql);
		$mymaxid=$row['id'];
		$mymaxid=(int)$mymaxid;
		if(($mymaxid>0)&&($mymaxid<10))
		{
			$mybokinum="R0000".($mymaxid);
			}
		elseif(($mymaxid>9)&&($mymaxid<100))
		{
			$mybokinum="R000".($mymaxid);
			}
		elseif(($mymaxid>99)&&($mymaxid<1000))
		{
			$mybokinum="R00".($mymaxid);
			}
		elseif(($mymaxid>999)&&($mymaxid<10000))
		{
			$mybokinum="R0".($mymaxid);
			}
		elseif(($mymaxid>9999)&&($mymaxid<100000))
		{
			$mybokinum="R".($mymaxid);
			}
			$sqltv = "UPDATE receipt_records set receipt_number='$mybokinum' WHERE receipt_number='$tempreceiptnum'";
			$resultyv = mysql_query($sqltv);
			
	$msg="$mybokinum receipt Created.<br />"; //.$sql;
	header("Location: receipts.php?mymsg=$msg");
	}
	else
	{
	$msg="$mybokinum receipt creation failed!.";
	header("Location: receipts.php?mymsg=$msg");
	}	
}
?>