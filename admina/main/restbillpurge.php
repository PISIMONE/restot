<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$user_check=$_SESSION['login_user'];
if($user_check!="admin")
	{
	header("Location: mainpage.php");
	}	
	
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$mytodaydatey = (string)date("Y-m-d");


if((!isset($_POST['mybillid']))||(!isset($_POST['mybillkots']))||(!isset($_POST['mybnum']))||(!isset($_POST['mybstatus']))||(!isset($_POST['mybdt'])))
{
	header("Location: mainpage.php");
	}

//$thebillid $thebillkots $thebillnum $billstatus $thebilldate
$thebillid=$_POST['mybillid'];
$thebillkots=$_POST['mybillkots'];
$thebillnum=$_POST['mybnum'];
$billstatus=$_POST['mybstatus'];
$thebilldate=$_POST['mybdt'];
$queryone=null;

$queryone="DELETE FROM adirestbill WHERE id='$thebillid' AND billnum='$thebillnum' AND billdate LIKE '%$thebilldate%'";
$resultone=mysql_query($queryone);
$countone=null;																		
$countone=mysql_affected_rows();																		
$countone=(int)$countone;
	if ($countone==1)																								    
	{	
	//////deleting any entry in updated bill bill discount table STARTS//////////////
	$sql_delupdbill = null;
	$resultupdbill = null;
	$sql_delupdbill="INSERT INTO dis_updatebills SELECT * FROM adirestbill WHERE id='$mythebillid' AND billnum='$mythebillnum' AND billdate LIKE '%$mythebilldt%'";
				$resultupdbill = mysql_query($sql_delupdbill);
	//////deleting any entry in updated bill bill discount table ENDS//////////////
	
	
	$queryone="DELETE FROM reasonstable WHERE billid='$thebillid'";
    $resultone=mysql_query($queryone);
	
	$mykotidsexp=explode(',',$thebillkots);
	$mykotidsexp=array_filter($mykotidsexp);
	$mykotidlen=(int)count($mykotidsexp);
	$todokotid=null;
	$todokotidm=null;
	$startlen=0;
	for($startlen;$startlen<$mykotidlen;$startlen++)
				{
					$sqlt=null;
					$resulty=null;
				   $todokotid=$mykotidsexp[$startlen];
				   $sqlt = "DELETE FROM adikotdet WHERE kid='".$todokotid."'";
				   $resulty = mysql_query($sqlt);
				   $sqlt=null;
					$resulty=null;
				   $sqlt = "DELETE FROM adikotnum WHERE id='".$todokotid."'";
				   $resulty = mysql_query($sqlt);
				   $sqlt=null;
					$resulty=null;
					$sqlt = "DELETE FROM adifoodbill WHERE kid='".$todokotid."'";
				   $resulty = mysql_query($sqlt);
				   $sqlt=null;
					$resulty=null;
					$sqlt = "DELETE FROM reasonstable WHERE sno='KOT".$todokotid."' OR billid='$thebillid'";
				   $resulty = mysql_query($sqlt);
				    $sqlt=null;
					$resulty=null;
				}
		if($billstatus=="Management")
		{
		$queryone="DELETE FROM voucher_records WHERE paid_for_particulars='BILL NUMBER: $thebillnum, BILL ID: $thebillid'";
		$resultone=mysql_query($queryone);
		}
	
	$msg=rebillnumber($thebillnum, $thebilldate);
	
	}//if $countone==1 ENDS
	else{
		$msg="Bill Deletion failed!";
		}//else $countone==1 ENDS

function rebillnumber($rethebillnum, $rethebilldate)
{
	$funthebillnum=$rethebillnum;
	$funthebilldate=$rethebilldate;
	$billidarrae = null;
	$tempotype = null;
	$temponum = null;
	$query = null;
	$r = null;
	$mychangebillidlen=null;
	$todobillid=null;
	$todobillidm=null;
	$startlenbill=null;
	
		if (strpos($funthebillnum, 'PARCEL') !== FALSE)
		{
		//echo 'Found PARCEL';
		//do nothing to renumber parcel bills
		$msg="Bill Serialised Successfully!";
		}//if strpos($funthebillnum, 'PARCEL' ENDS
		else{
		//echo 'Found TABLE or ROOM';
		//TABLE1/6
		//ROOM101/5
		$tempotype=explode("/",$funthebillnum);
		$tempotype=array_filter($tempotype);
		$temponum=(((string)$tempotype[0])."/");
		//TABLE1/
		//ROOM101/
		$billidarrae = array();
		//$billidarrae[] = "item";
			$query = mysql_query("SELECT * FROM adirestbill WHERE billnum LIKE '$temponum%' AND billdate LIKE '$funthebilldate%'");
				while($r=mysql_fetch_array($query)) 
				{
					$billidarrae[]=$r['id'];
				}
				$billidarrae=array_filter($billidarrae);
				
				$mychangebillidlen=(int)count($billidarrae);
				$todobillid=null;
				$todobillidm=null;
				$startlenbill=0;
				for($startlenbill;$startlenbill<$mychangebillidlen;$startlenbill++)
				{
					$todobillid=$billidarrae[$startlenbill];
					$todobillidm=$todobillid;
					
					$query = mysql_query("SELECT * FROM adirestbill WHERE id='$todobillid' AND billdate LIKE '$funthebilldate%'");
					$r=mysql_fetch_array($query);
						{
							$billhavefbid=$r['fbid'];
							$billhavenum=$r['billnum'];
							$billhavetype=$r['billtype'];
						}
					
					
					if($billhavenum==($temponum.($startlenbill+1))){
						/////bill number is same as required to serialise
						//////so do nothing to this bill
						$msg="Bill Serialised Successfully!";
						}//////if of$billhavenum==($temponum.($startlenbill+1)) ENDS
						else{
							$billshouldhavenum=($temponum.($startlenbill+1));
							$querytwo=null;
							$resulttwo=null;
							//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							$querytwo="UPDATE adirestbill SET billnum='$billshouldhavenum' WHERE id='$todobillid' AND billdate LIKE '$funthebilldate%'";
							$resulttwo=mysql_query($querytwo);
							$counttwo=null;																		
							$counttwo=mysql_affected_rows();																		
							$counttwo=(int)$counttwo;
								if ($counttwo==1)																								    
								{	
								
								//////Updating any entry in updated bill bill discount table STARTS//////////////
								$sql_delupdbill = null;
								$resultupdbill = null;
								$sql_delupdbill="UPDATE dis_updatebills SET billnum='$billshouldhavenum' WHERE id='$todobillid' AND billdate LIKE '$funthebilldate%'";
								$resultupdbill = mysql_query($sql_delupdbill);
								//////Updating any entry in updated bill bill discount table ENDS//////////////
								
								
								
								$querytwo="UPDATE reasonstable SET sno='$billshouldhavenum' WHERE billid='$todobillid'";
								$resulttwo=mysql_query($querytwo);
								
								$billhavefbidexp=explode(',',$billhavefbid);
								$billhavefbidexp=array_filter($billhavefbidexp);
								$mykothavelen=0;
								$mykothavelen=(int)count($billhavefbidexp);
								$todobillkotid=null;
								$todobillkotidm=null;
								$starthavelen=0;
								for($starthavelen;$starthavelen<$mykothavelen;$starthavelen++)
											{
												$sqlbillt=null;
												$resultbilly=null;
											   $todobillkotid=$mykotidsexp[$starthavelen];
											   $sqlbillt = "UPDATE adikotnum SET otype='$tempotype[0]' WHERE id='".$todobillkotid."'";
											   $resultbilly = mysql_query($sqlbillt);
											   $sqlbillt=null;
												$resultbilly=null;
												$sqlbillt = "UPDATE adifoodbill SET otype='$tempotype[0]' WHERE kid='".$todobillkotid."'";
											   $resultbilly = mysql_query($sqlbillt);
											  $sqlbillt=null;
												$resultbilly=null;
											}
									if($billhavetype=="Management")
									{
									$querytwo="UPDATE voucher_records SET paid_for_particulars='BILL NUMBER: $billshouldhavenum, BILL ID: $todobillkotid' WHERE paid_for_particulars='BILL NUMBER: $billhavenum, BILL ID: $todobillid'";
									$resulttwo=mysql_query($querytwo);
									}
								
								$msg="Bill Serialised Successfully!";
								
								}//if $counttwo==1 ENDS
								else{
									
									$msg="Bill Serialisation Failed!";
									}
							
						
							
							}//////else of$billhavenum==($temponum.($startlenbill+1)) ENDS
					
					
					
					
				}////for $startlenbill ENDS
		
		
		
		
		}//else of strpos($funthebillnum, 'PARCEL' ENDS
	
	
	
	
	
	
	return $msg;
	}///function rebillnumber ENDS




header("Location: restdeletebills.php?mymsg=".$msg);

?>