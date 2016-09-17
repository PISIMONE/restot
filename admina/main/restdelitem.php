<?php
include("../connect/connectdb.php");
// Unescape the string values in the JSON array
//itemkotid itemdelid
$tabkotdelid = stripcslashes($_GET['itemkotid']); //5
$tabledelid = stripcslashes($_GET['itemdelid']);  //16
$msg=null;
$query=null;
$error[]=null;
$fbcounter=null;
$fbidexplen=null;

$query = mysql_query("SELECT * FROM adikotnum WHERE id=$tabkotdelid");
$r=mysql_fetch_array($query);
$mykidstatus=$r['status'];
$myfbstatus=null;
if($mykidstatus=="Processing"){
	
	
	}///if end of $mykidstatus=="Processing"
	elseif($mykidstatus=="Cancelled"){
		$msg="ERROR1";
		echo $msg;
		exit();
		}///elseif end of $mykidstatus=="Cancelled"
		elseif($mykidstatus=="Delivered"){
		///has ENTRY in foodbill table
		////check foobbill table for status
		//1.) if status of this KOT is Credit then no bill has been generated
		//2.) if status is something else then make No changes
		
		}///elseif end of $mykidstatus=="Delivered"
		else{
			/////here thecondition is $mykidstatus=="Confirm"
			///has ENTRY in foodbill table AND at least the credit bill already generated
			////check foobbill table for status
			///1.) if status of this KOT is RestBill then only credit bill hasbeen generated
			////so delete the Entry from rest bill after collecting the fbid of all kot's
			///then delete all the entry from foodbill of fbid taken from restbills
			///then change the status of all the kot's collected from foodbill in the kotnum table
			///then delete the row to be delted from kotdet table
			////2.)if status is Credit then nobill hasbeen generated
			//////then collect the kid where otype="otpye of above Credit Kot" and statu="credit" from foodbill table
			/////then  change the status of all kid's collected above to status="Processing" 
			/////then delete the row to be delted from kotdet table
			//////then delete all the entry from foodbill table where kid where otype="otpye of above Credit Kot" and statu="credit"
			/////3.)if status is Confirm then make no changes
			$query = mysql_query("SELECT * FROM adifoodbill WHERE kid='$tabkotdelid'");
			$r=mysql_fetch_array($query);
			$myfbstatus=$r['status'];
					if($myfbstatus=="RestBill"){
						$query = mysql_query("SELECT * FROM adirestbill WHERE fbid LIKE '$tabkotdelid,%' or fbid LIKE '%,$tabkotdelid,%'");
						$r=mysql_fetch_array($query);
						$allthefbid=$r['fbid']; ///11,10
						$thebillid=$r['id']; ///7
						$thebillnum=$r['billnum'];///RBL7
						
						
							$query="DELETE FROM adikotdet WHERE id=$tabledelid";
							$result = mysql_query($query) or die(mysql_error());
							$county=null;
							$county=mysql_affected_rows();
							$county=(int)$county;
								if ($county==1)
								{					
								$allthefbidexp=explode(",",$allthefbid);
								$allthefbidexp=array_filter($allthefbidexp);
								$fbidexplen=(int)count($allthefbidexp);
								for($fbcounter=0;$fbcounter < $fbidexplen;$fbcounter++){
									$tosetkotid=$allthefbidexp[$fbcounter];
									$query="UPDATE adikotnum SET status='Processing' WHERE id=$tosetkotid";
									$result = mysql_query($query) or die(mysql_error());
									$query="DELETE FROM adifoodbill WHERE kid=$tosetkotid";
							        $result = mysql_query($query) or die(mysql_error());
									}
									////take it from hERE//////////////////////////////////////////////////////////////////////////
									$query="DELETE FROM adirestbill WHERE id=$thebillid AND billnum='$thebillnum'";
							        $result = mysql_query($query) or die(mysql_error());
									////take it from hERE//////////////////////////////////////////////////////////////////////////
								}
								else
								{
								$msg="ERROR2";
								echo $msg;
								exit();
								}
						
						}///////if ENDS $myfbstatus=="RestBill"
						
			
			
			
			
			
			
			}///else end of $mykidstatus=="Confirm"







			
			
			
			
			
			
				$query="DELETE FROM adikotdet WHERE id=$tabledelid";
				$result = mysql_query($query) or die(mysql_error());
				$county=null;
				$county=mysql_affected_rows();
				$county=(int)$county;
					if ($county==1)
					{					
					$msg="KOT Update Entry OK.<br />"; //.$sql;
					}
					else
					{
					$msg="KOT Update Detials ENTRY failed!.";
					}	
		
echo $mynewkotnum;
?>
