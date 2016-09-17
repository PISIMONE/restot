<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$mytodaydatebill = (string)date("Y-m-d");
?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$checkquery=null;
$checkresult=null;
$checkrowb=null;
$checkstatus=null;
$checkmykotids=addslashes($_POST['kotids']);	
$checkmykotidsexp=explode(',',$checkmykotids);
$checkmykotidsexp=array_filter($checkmykotidsexp);
$checkmykotidslen=(int)count($checkmykotidsexp);
$checktodokotid=null;
$checkstartlen=0;	
$isbilled=null;

for($checkstartlen;$checkstartlen<$checkmykotidslen;$checkstartlen++)
{
	$checktodokotid=$checkmykotidsexp[$checkstartlen];
	
	$checkresult = mysql_query("SELECT * FROM adifoodbill WHERE kid='$checktodokotid'");
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
		break;
		}
}
//echo $isbilled;
//exit;
if($isbilled=="YES")
{
	$msg="Bill Already procedded!.";
		header("Location: restviewbill.php?mymsg=$msg");
		exit();
	}
	else{
		

	
$msg=null;
$sql=null;
///ordertyper kotids ordertotal orderparcel parceltaken disper sevper stax vat gcount
///ordertyper kotids ordertotal orderparcel parceltaken tptotal disctyped disper discamount sevper stax vat gcount
$myordertyper=addslashes($_POST['ordertyper']);
$mykotids=addslashes($_POST['kotids']);
$myordertotal=addslashes($_POST['ordertotal']);
$myorderparcel=addslashes($_POST['orderparcel']);
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
$mystax=addslashes($_POST['stax']);
$myvat=addslashes($_POST['vat']);
///shawchh bharat tax
$mysbtax=addslashes($_POST['sbtax']);
$mygcount=addslashes($_POST['gcount']);

$tempbillnum=substr(str_shuffle(MD5(microtime())), 0, 10);	//parcelbilltotal parcelcharge servcharge

$queryii="INSERT INTO adirestbill(fbid, billnum, billtype, txnum, cncmix, otype, disctype, discount, discamnt, foodbilltotal, parcelbilltotal, parcelcharge, ordpartotal, servcharge, stax, vat, sbtax, gtotal, gpaid, gdues, billdate, status) VALUES('$mykotids', '$tempbillnum', 'Credit', '', '', '$myordertyper', '$mydisctyped', '$mydisper', '$mydiscamount', '$myordertotal',  '$myorderparcel', '$myparceltaken', '$mytptotal', '$mysevper', '$mystax', '$myvat', '$mysbtax', '$mygcount', '', '$mygcount', '$mytodaydate', 'Credit')";
//echo $queryii;
//exit();
$result = mysql_query($queryii) or die(mysql_error());
	$counte=null;
	$counte=mysql_affected_rows();
	$counte=(int)$counte;
	$flagone=FALSE;
	$flagtwo=FALSE;
	$flagtree=FALSE;
		if ($counte==1)
		{	
		//SELECT * FROM `adirestbill` WHERE billnum LIKE '%TABLE201/%' AND billdate LIKE '%2010-07-03%' ORDER BY billnum DESC
			$bquery=mysql_query("SELECT id FROM adirestbill WHERE billnum='$tempbillnum'");
			$rowby=mysql_fetch_row($bquery);
			$mymaxidby=$rowby[0];
			$mymaxidby=(int)$mymaxidby;
			
			
			$bquery=mysql_query("SELECT billnum FROM adirestbill WHERE billnum LIKE '%$myordertyper/%' AND billdate LIKE '%$mytodaydatebill%' ORDER BY billnum DESC");
			
			$rowb=mysql_fetch_row($bquery);
			$mymaxidb=$rowb[0];
			//echo $mymaxidb."<br/>";
			$mymaxidbexp=explode('/',$mymaxidb);
			$mymaxidb=$mymaxidbexp[1];
			//echo $mymaxidb."<br/>";
			
			$mymaxidb=((int)$mymaxidb)+1;
			$mynewbillnum="$myordertyper/".$mymaxidb;
			
			//echo $mynewbillnum."<br/>";
			//exit();
			
			
			
			
			$bquery=mysql_query("UPDATE adirestbill SET billnum='$mynewbillnum' WHERE id='$mymaxidby' AND billnum='$tempbillnum'");
			$countey=null;
			$countey=mysql_affected_rows();
			$countey=(int)$countey;
				if ($countey==1)
				{	
				
				$mykotidsexp=explode(',',$mykotids);
				$mykotidsexp=array_filter($mykotidsexp);
				$mykotidlen=(int)count($mykotidsexp);
				$todokotid=null;
				$startlen=0;
				
				for($startlen;$startlen<$mykotidlen;$startlen++)
					{
					  $todokotid=$mykotidsexp[$startlen];
					  
					  $queryyy = "UPDATE adifoodbill SET status='RestBill' WHERE kid='$todokotid' AND otype='$myordertyper' AND status='Credit'";
				      $resulty = mysql_query($queryyy);
					  
					  $queryyy = mysql_query("UPDATE adikotnum SET status='Confirm' WHERE id='$todokotid' AND status='Delivered'");
					  $resulty = mysql_query($queryyy);					  
					  $fquery=mysql_query("SELECT billtype FROM adikotnum WHERE id='$todokotid'");
						$rowf=mysql_fetch_row($fquery);
						$myflagval=$rowf[0];
						if($myflagval=="MIX")
						{
							$flagone=TRUE;
							}
							elseif($myflagval=="NC")
							{
								$flagtwo=TRUE;
								}
							elseif($myflagval=="C")
							{
								$flagtree=TRUE;
								}
				
					}////for loop startlen ends		
					
					if($flagone==TRUE)
					{
						$namobilltype="MIX";
						}
					elseif(($flagone==FALSE)&&($flagtwo==TRUE))
					{
						$namobilltype="NC";
						}
					elseif(($flagone==FALSE)&&($flagtwo==FALSE))
					{
						$namobilltype="C";
						}
					$queryyy = "UPDATE adirestbill SET cncmix='$namobilltype' WHERE id='$mymaxidby' AND billnum='$mynewbillnum'";
					$resulty = mysql_query($queryyy) or die(mysql_error());
							
				}////if  countey ends
				else
				{
					$bquery=mysql_query("DELETE FROM adirestbill WHERE WHERE id='$mymaxidby' AND billnum='$tempbillnum'");
					$msg="Billnumber with Billnum:$tempbillnum updation failed.";
					}
			
		//
		}
		else
		{
			//
			$msg="Bill insertion failed.";
			
			}
			
		header("Location: restbillprintable.php?mymsg=$msg&billid=$mymaxidby&billno=$mynewbillnum&billdt=$mytodaydatebill");
	
	}///else of $isbilled ENDS
	
		
	
}
?>