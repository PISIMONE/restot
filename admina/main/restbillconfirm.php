 <?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$loginusername=$login_session;
?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")&&($_POST['formval']=="YES"))
{
$sql=null;
$query =null;
$checkmybillnumbm=null;
$checkthebillid=$_POST['thebillid'];	
$checkthebilldt=$_POST['thebilldt'];	
$checkmybillnumbm=$_POST['billnumbb'];	
$checkquery=null;
$checkresult=null;
$checkrowb=null;
$checkstatus=null;

$checkresult = mysql_query("SELECT * FROM adirestbill WHERE id='$checkthebillid' AND billnum='$checkmybillnumbm' AND billdate LIKE '%$checkthebilldt%'");

	$checkrowb=mysql_fetch_array($checkresult);
	$checkstatus=$checkrowb['status'];
	//echo $checkstatus."--SELECT * FROM adirestbill WHERE billnum='$checkmybillnumbm'";
	//exit;
	if($checkstatus=="Credit")
	{
	$isbilled="NO";
	}
	else{
		$isbilled="YES";
		$msg="Bill Already procedded!.";
		header("Location: restviewbill.php?mymsg=$msg");
		exit();
		}
//echo $isbilled;
//exit();
if($isbilled=="NO")
{
	

$msg=null;
$sql=null;
$mybilltypemcan=null;
$mybilltypemcard=null;
$myrounddues=addslashes($_POST['rounddues']);
$mybilltypem=addslashes($_POST['paymodd']);
$mythebillid=$_POST['thebillid'];	
$mythebilldt=$_POST['thebilldt'];	
$mybillnumbm=addslashes($_POST['billnumbb']);

/////getting the cardamount and cash amount if is set otherwise setting to 0(zero)
if(isset($_POST['reasonofi2']))
{
	$paid_card = $_POST['reasonofi2'];
	
	}else{
		$paid_card = 0;
		}

if(isset($_POST['reasonofi3']))
{
	$paid_cash = $_POST['reasonofi3'];
	
	}else{
		$paid_cash = 0;
		}

		/////$paid_card $paid_cash


//echo $myrounddues."<br/>";
//echo $mybilltypem."<br/>";
//echo $mybillnumbm."<br/>";

//exit();


if($mybilltypem=="Cancelled"){
	$mybilltypemcan=addslashes($_POST['reasonofii']);
	$query = "INSERT INTO reasonstable(entrydate, billid, sno, depart, user, gamount, reasons, status) VALUES('$mytodaydate', '$mythebillid', '$mybillnumbm', 'RESTAURANT', '$loginusername', '$myrounddues', '$mybilltypemcan', 'Cancelled')";
$result = mysql_query($query) or die(mysql_error());
		$countm=null;
				$countm=mysql_affected_rows();
				$countm=(int)$countm;
			if ($countm==1)
			{
				$sql = "UPDATE adirestbill SET billtype='$mybilltypem', gtotal='$myrounddues', gpaid='$myrounddues', gdues='0.00', billdate='$mytodaydate', status='Cancelled' WHERE id='$mythebillid' AND billnum='$mybillnumbm' AND billdate LIKE '%$mythebilldt%'";
				}
				else{
					exit();
					}
}
elseif($mybilltypem=="Card"){
	$mybilltypemcard=addslashes($_POST['reasonofi']);
	$sql = "UPDATE adirestbill SET billtype='$mybilltypem', txnum='$mybilltypemcard', gtotal='$myrounddues', gpaid='$myrounddues', gdues='0.00', billdate='$mytodaydate', status='Confirm' WHERE id='$mythebillid' AND billnum='$mybillnumbm' AND billdate LIKE '%$mythebilldt%'";
}
elseif($mybilltypem=="Mixed"){
	/////////$paid_card $paid_cash
	$mybilltypemcard=addslashes($_POST['reasonofi']);
	$sql = "UPDATE adirestbill SET billtype='$mybilltypem', txnum='$mybilltypemcard', gtotal='$myrounddues', cardamount='$paid_card', cashamount='$paid_cash', gpaid='$myrounddues', gdues='0.00', billdate='$mytodaydate', status='Confirm' WHERE id='$mythebillid' AND billnum='$mybillnumbm' AND billdate LIKE '%$mythebilldt%'";
}
else{
	$sql = "UPDATE adirestbill SET billtype='$mybilltypem', gtotal='$myrounddues', gpaid='$myrounddues', gdues='0.00', billdate='$mytodaydate', status='Confirm' WHERE id='$mythebillid' AND billnum='$mybillnumbm' AND billdate LIKE '%$mythebilldt%'";
}
	//echo $sql;
	//exit();
	$result = mysql_query($sql) or die(mysql_error());
	$count=null;
	$count=mysql_affected_rows();
	$count=(int)$count;
		if ($count==1)
		{		
			$bquery=mysql_query("SELECT fbid FROM adirestbill WHERE id='$mythebillid' AND billnum='$mybillnumbm' AND billdate LIKE '%$mythebilldt%'");
			while($roy=mysql_fetch_array($bquery)) 
			{
				$myfidb=$roy['fbid'];
				}	
				$mykotidsexp=explode(',',$myfidb);
				$mykotidsexp=array_filter($mykotidsexp);
				$mykotidlen=(int)count($mykotidsexp);
				$todokotid=null;
				$todokotidm=null;
				$startlen=0;
				$tab_block=null;
				 if($mybilltypem=="Cancelled"){
					 for($startlen;$startlen<$mykotidlen;$startlen++)
							{
					$todokotidm=$mykotidsexp[$startlen];
					$sqltm = "UPDATE adikotnum set status='Cancelled' WHERE id='".$todokotidm."'";
					$resultym = mysql_query($sqltm);		
					}							 
					 $startlen=0;
				 }
				for($startlen;$startlen<$mykotidlen;$startlen++)
				{
				  $todokotid=$mykotidsexp[$startlen];
				  if($mybilltypem=="Cancelled"){
				   $sqlt = "UPDATE adifoodbill set status='Cancelled' WHERE kid='".$todokotid."' AND status='RestBill'";
				  }
				  else{
				  $sqlt = "UPDATE adifoodbill set status='Confirm' WHERE kid='".$todokotid."' AND status='RestBill'";
				  }
				  $resulty = mysql_query($sqlt);
				}
				  //////force to insert voucher for RESTAURANT MANAGEMENT in ledger RESTAURANT_EXPENSES_MANAGEMENT STARTS///////////////
		if($mybilltypem=='Management'){
									//////////////////getting the vouchers max id//////////////////////////
								
		$sql=null;
		$tempvouchernum=substr(str_shuffle(MD5(microtime())), 0, 10);
		
		$sql="INSERT INTO voucher_records(voucher_number, voucher_date, ledger_dept, ledger_account_type, ledger_name, paid_to, paid_for_particulars, payment_mode, cheque_number, cheque_dated, cheque_amount, total_amount, remarks, createdon, status) VALUES
('$tempvouchernum', '$mytodaydate', 'RESTAURANT', 'EXPENSES', 'RESTAURANT_EXPENSES_MANAGEMENT', 'MANAGEMENT', 'BILL NUMBER: $mybillnumbm, BILL ID: $mythebillid', 'MANAGEMENT', '', '0000-00-00 00:00:00', '0.00', '$myrounddues', 'BILL SETTLED WITHOUT RECEIVING CASH BY RESTAURANT MANAGEMENT', '$mytodaydate', 'ACTIVE')";
			$result = mysql_query($sql);
			
						        $myvbokinum=null;
								$sqltv = null;
								$resultyv  = null;
								$sql=mysql_query("SELECT id FROM voucher_records WHERE voucher_number='$tempvouchernum'");
								$row=mysql_fetch_array($sql);
								$mymaxid=$row['id'];
								$mymaxid=(int)$mymaxid;
								if(($mymaxid>0)&&($mymaxid<10))
								{
									$myvbokinum="V0000".($mymaxid);
									}
								elseif(($mymaxid>9)&&($mymaxid<100))
								{
									$myvbokinum="V000".($mymaxid);
									}
								elseif(($mymaxid>99)&&($mymaxid<1000))
								{
									$myvbokinum="V00".($mymaxid);
									}
								elseif(($mymaxid>999)&&($mymaxid<10000))
								{
									$myvbokinum="V0".($mymaxid);
									}
								elseif(($mymaxid>9999)&&($mymaxid<100000))
								{
									$myvbokinum="V".($mymaxid);
									}
								$sqltv = "UPDATE voucher_records set voucher_number='$myvbokinum' WHERE voucher_number='$tempvouchernum'";
								$resultyv = mysql_query($sqltv);
							///////////////////////////////////////////////////////////////
			
			}
			//////////////////////force to insert voucher for HOTEL MANAGEMENT in ledger HOTEL_EXPENSES_MANAGEMENT ENDS///////////////
		  
				  
				
		$msg='Bill Number: '.$mybillnumbm.' Confirmed.<br />'; //.$sql;
		header("Location: restviewbill.php");
		}
		else
		{
		$msg="Billing confirmation failed!.";
		header("Location: restpaybill.php");
		}	
		
}///if $isbilled="NO" ENDS
else{
	header("Location: restviewbill.php");
	}
		
		
		
		
}
?>