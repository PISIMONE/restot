<?php
include("../connect/connectdb.php");
include("check.php");
if($login_session!="admin")
{
	header("Location: restviewbill.php");
	}
?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
///ordertyper kotids ordertotal orderparcel parceltaken tptotal disctyped disper discamount sevper stax vat gcount

// thebillid thebilldt thebillnum parceltaken disctyped disper discamount sevper gcount
$msg=null;
$sql=null;
$thisstring=null;
if((!isset($_POST['thebillid']))||(!isset($_POST['thebilldt']))||(!isset($_POST['thebillnum'])))
{
	header("Location: restviewbill.php");
	}
$mythebillid=$_POST['thebillid'];
$mythebilldt=$_POST['thebilldt'];
$mythebillnum=$_POST['thebillnum'];

////checking if billing status is Credit ONLY
$isbilled=null;
$checkresult =null;
$checkrowb=null;
$checkstatus=null;


$isbilled="YES";
$thisstring="SELECT * FROM adirestbill WHERE id='$mythebillid' AND billnum='$mythebillnum' AND billdate LIKE '%$mythebilldt%'";
$checkresult = mysql_query($thisstring);


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
		$msg="Bill Already procedded!.";
		header("Location: restviewbill.php?mymsg=$msg");
		exit();
		}




  if($isbilled=="NO"){


				$myparceltaken=addslashes($_POST['parceltaken']);
				$mytptotal=addslashes($_POST['tptotal']);
				$mydisctyped=addslashes($_POST['disctyped']);
				if($_POST['disctyped']=="DEFAULT")
				{
					$mydisctyped="NONE";
					}
				$mydisper=addslashes($_POST['disper']);
				if(!isset($_POST['disper']))
				{
					$mydisper=0;
					}
				$mydiscamount=addslashes($_POST['discamount']);
				if(!isset($_POST['discamount']))
				{
					$mydiscamount=0;
					}
				
				$mysevper=addslashes($_POST['sevper']);
				$mygcount=addslashes($_POST['gcount']);
				
				/////check dis_updatebills 
				
				
				$sql="INSERT INTO dis_updatebills SELECT * FROM adirestbill WHERE id='$mythebillid' AND billnum='$mythebillnum' AND billdate LIKE '%$mythebilldt%'";
				$result = mysql_query($sql) or die(mysql_error());
				
				$sql="UPDATE adirestbill SET disctype='$mydisctyped', discount='$mydisper', discamnt='$mydiscamount', parcelcharge='$myparceltaken', servcharge='$mysevper', gtotal='$mygcount', gdues='$mygcount' WHERE id='$mythebillid' AND billnum='$mythebillnum' AND billdate LIKE '%$mythebilldt%'";
				//echo $queryii;
				//exit();
				$result = mysql_query($sql) or die(mysql_error());
					$counte=null;
					$counte=mysql_affected_rows();
					$counte=(int)$counte;
						if ($counte==1)
						{	
						$msg="Bill Update Successfully";
						//header("Location: restbillprintable.php?mymsg=$msg&billno=$mythebillnum&billdt=$mythebilldt");
						header("Location: restviewbill.php?mymsg=$msg");
						}
						else
						{
							$msg="Bill UPDATION failed.";
							header("Location: restviewbill.php?mymsg=$msg");
							}
			
  }
  else{
	  header("Location: restviewbill.php");
	  }


}
?>