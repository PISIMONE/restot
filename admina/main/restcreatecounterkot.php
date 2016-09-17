<?php
include("../connect/connectdb.php");
// Unescape the string values in the JSON array
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$tableData = stripcslashes($_GET['pTableData']);
$waitername = trim($_GET['jsordernamee']);
$ootype = trim($_GET['jspersonphnoe']);
// Decode the JSON array
$tableData = json_decode($tableData,TRUE);
$mynewkotnum=null;
$mycount=0;
// now $tableData can be accessed like a PHP array
foreach($tableData as $sam)
{
	$mycount=(($mycount+count($sam)));
	}
//echo $ccount;
$mycount=($mycount/5);
$msg=null;
$query=null;
$query="INSERT INTO adikotnum(kotdate, bokinum, otype, waitrname, status) VALUES('$mytodaydate', 'NONE', '$ootype', '$waitername', 'Processing')";
$result = mysql_query($query) or die(mysql_error());
	$counte=null;
	$counte=mysql_affected_rows();
	$counte=(int)$counte;
		if ($counte==1)
		{				
			$query=mysql_query("SELECT id FROM adikotnum order by id desc");
			$row=mysql_fetch_row($query);
			$mymaxid=$row[0];
			$mymaxid=(int)$mymaxid;
			$mynewkotnum=$mymaxid;
			for($i=0;$i<$mycount;$i++)
			{
				$myitemCode=$tableData[$i]['itemCode'];
				$myitemName=addslashes(trim($tableData[$i]['itemName']));
				$myitemUprice=$tableData[$i]['itemUprice'];
				$myitemQuan=$tableData[$i]['itemQuan'];
				$myitemCharg=$tableData[$i]['itemCharg'];
				$query="INSERT INTO adikotdet(kid, icode, itemname, uiprice, uiquan, ktotal) VALUES($mymaxid, '$myitemCode', '$myitemName', $myitemUprice, $myitemQuan, $myitemCharg)";
				$result = mysql_query($query) or die(mysql_error());
				$county=null;
				$county=mysql_affected_rows();
				$county=(int)$county;
				if ($county==1)
				{					
					$msg="KOT GENERATION OK.<br />"; //.$sql;
					}
					else
					{
					$msg="KOT Detials ENTRY failed!.";
					}	
					
				}
		}
		else
		{
		$msg="KOT Creation failed!.";
		}	
echo $mynewkotnum;
?>
