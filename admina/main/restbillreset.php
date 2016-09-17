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
$checkthebilloldsts=$_POST['thebilloldsts'];	
$checkpaymodd=$_POST['paymodd'];	
//thebilloldsts paymodd
//echo $checkthebilloldsts."<br/>";
//echo $checkpaymodd."<br/>";
//exit();


if($checkthebilloldsts==$checkpaymodd)
	{
	$msg="Nochanges made to Bill!.";
		header("Location: changepaymode.php?mymsg=$msg");
		exit();
	}
	else{

			$msg=null;
			$sql=null;
			
			if($checkpaymodd=="Card"){
				$checkreasonofi=$_POST['reasonofi'];
				$sql = "UPDATE adirestbill SET billtype='$checkpaymodd', txnum='$checkreasonofi' WHERE id='$checkthebillid' AND billnum='$checkmybillnumbm' AND billdate LIKE '$checkthebilldt%'";
				}
				else{
					$checkreasonofi=null;
					$sql = "UPDATE adirestbill SET billtype='$checkpaymodd', txnum=Null WHERE id='$checkthebillid' AND billnum='$checkmybillnumbm' AND billdate LIKE '$checkthebilldt%'";
					}

				   // echo $sql."<br/>";
					//exit();
				
					$result = mysql_query($sql) or die(mysql_error());
					$count=null;
					$count=mysql_affected_rows();
					$count=(int)$count;
						if ($count==1)
						{		
						$msg="Billing Paymode Changed Successfully.";
						header("Location: changepaymode.php?mymsg=$msg");
						exit();
						}
						else
						{
						$msg="Billing paymode updation failed!.";
						header("Location: changepaymode.php?mymsg=$msg");
						exit();
						}	
		

			}
		
		
}
?>