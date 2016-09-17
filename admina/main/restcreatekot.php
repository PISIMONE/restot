<?php
include("../connect/connectdb.php");
// Unescape the string values in the JSON array
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$tableData=null;
/////pTableData  jsitemsnume  jsdispere   jsdisamounte jsmykototalie jsuserinfore///////////////////////
$tabpTableData = stripcslashes($_POST['pTableData']);
$tabjsitemsnume = stripcslashes($_POST['jsitemsnume']);
$tabjsdispere = stripcslashes($_POST['jsdispere']);
$tabjsdisamounte= stripcslashes($_POST['jsdisamounte']);
$tabjsmykototalie= stripcslashes($_POST['jsmykototalie']);
$tabjsuserinfore = stripcslashes($_POST['jsuserinfore']);
// Decode the JSON array
$tableData = json_decode($tabpTableData,TRUE);
$mynewkotnum=null;
$billone=FALSE; ///chargable
$billtwo=FALSE; ////non-chargeable
$billotype=null;
$mycount=0;
// now $tableData can be accessed like a PHP array
foreach($tableData as $sam)
{
	$mycount=(($mycount+count($sam)));
	}
//echo $ccount;
$mycount=($mycount/11);
$msg=null;
$query=null;


$tabjsuserexp=explode('#',$tabjsuserinfore);
$tabordertype=$tabjsuserexp[0];	//////////
$tabordernum=$tabjsuserexp[1];	/////////////
$tabwaiternameid=$tabjsuserexp[2];///////////////
$tablogeduser=$tabjsuserexp[3];	/////////admin//////////////
$tabcustnamecode=$tabjsuserexp[4];////////////////
$tabcustaddrs=$tabjsuserexp[5];	///////////CUST FULL ADRESS////
$tabcustphno=$tabjsuserexp[6];//////////CUST PHNO///////////////
if($tabordertype=="TABLE"||$tabordertype=="ROOM")
{
	$tabordertable=$tabordertype.$tabordernum;
	}
	else{
		$tabordertable=$tabordertype;
		}
$tempbokinum=substr(str_shuffle(MD5(microtime())), 0, 10);	
$query="INSERT INTO adikotnum(kotdate, bokinum, billtype, otype, waitrname, loguser, custto, custaddrs, custphno, totalitems, totaldisper, totaldiscount, totalgrand, status) VALUES('$mytodaydate', '$tempbokinum', 'UNKNOWN', '$tabordertable', '$tabwaiternameid', '$tablogeduser', '$tabcustnamecode', '$tabcustaddrs', '$tabcustphno', $tabjsitemsnume, $tabjsdispere, $tabjsdisamounte, $tabjsmykototalie, 'Processing')";
$result = mysql_query($query) or die(mysql_error());
	$counte=null;
	$counte=mysql_affected_rows();
	$counte=(int)$counte;
		if ($counte==1)
		{				
			$query=mysql_query("SELECT id FROM adikotnum where bokinum='$tempbokinum'");
			$row=mysql_fetch_row($query);
			$mymaxid=$row[0];
			$mymaxid=(int)$mymaxid;
			$mynewkotnum=$mymaxid;
			for($i=0;$i<$mycount;$i++)
			{
				$itemtupo=null;
				$myitemCode=$tableData[$i]['itemCode'];
				$myitemid=$tableData[$i]['itemId'];
				$myitemName=addslashes(trim($tableData[$i]['itemName']));
					if (strpos($myitemName,'(NC)') !== false) {
						$billtwo=TRUE;  ///non-chargeable
						$itemtupo="NC";
					}
					else{
						 $billone=TRUE; /////chargable
						 $itemtupo="C";
						}
					if(($billone==TRUE) && ($billtwo==TRUE))
					{
						$billotype="MIX";
						}
						elseif(($billone==TRUE) && ($billtwo==FALSE)){
							$billotype="C";												
							}
						elseif(($billone==FALSE) && ($billtwo==TRUE)){
							$billotype="NC";												
							}
				$myitemUprice=$tableData[$i]['itemUprice'];
				$myitemHprice=$tableData[$i]['itemHprice'];
				$myitemFQuan=$tableData[$i]['itemFQuan'];
				$myitemHQuan=$tableData[$i]['itemHQuan'];
				$myitemCharg=$tableData[$i]['itemCharg'];
				$myitemDisper=$tableData[$i]['itemDisper'];
				$myitemDisamount=$tableData[$i]['itemDisamount'];
				$myitemCharged=$tableData[$i]['itemCharged'];		
			
			
				$query="INSERT INTO adikotdet(kid, itemtype, itemid, icode, itemname, uiprice, hiprice, uiquan, hiquan, icharge, idisper, idiscount, ktotal) VALUES($mynewkotnum, '$itemtupo', '$myitemid', '$myitemCode', '$myitemName', $myitemUprice, $myitemHprice, $myitemFQuan, $myitemHQuan, $myitemCharg, $myitemDisper, $myitemDisamount, $myitemCharged)";
				$result = mysql_query($query) or die(mysql_error());
				$county=null;
				$county=mysql_affected_rows();
				$county=(int)$county;
					if ($county==1)
					{					
						$msg="OK"; //.$sql;
					   }
						else
						{
						$msg="FAILED";
						$query="DELETE FROM adikotdet WHERE kid='$mynewkotnum'";
						$result = mysql_query($query) or die(mysql_error());
						$query="DELETE FROM adikotnum WHERE id='$mynewkotnum'";
						$result = mysql_query($query) or die(mysql_error());
						break;
						}	
					
				}
				if($tabordertype=="PARCEL"){
					$query="UPDATE adikotnum SET otype='$tabordertype$mynewkotnum' WHERE id='$mynewkotnum'";
					$result = mysql_query($query) or die(mysql_error());
					//$query="INSERT INTO adikotdet(kid, itemtype, itemid, itemname, ktotal) VALUES($mynewkotnum, 'C', '$myitemid', 'PARCEL', $tabordernum)";
					//$result = mysql_query($query) or die(mysql_error());
					}
				if($msg=="OK")
				{
					$query="UPDATE adikotnum SET billtype='$billotype',bokinum='NONE' WHERE id='$mynewkotnum'";
					$result = mysql_query($query) or die(mysql_error());
					}
		}
		else
		{
		$msg="KOT Creation failed!.";
		}	
echo $mynewkotnum;
?>
