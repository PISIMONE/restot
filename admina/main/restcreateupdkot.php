<?php
include("../connect/connectdb.php");
// Unescape the string values in the JSON array
$tableData = stripcslashes($_GET['pTableData']);
$tablekotnm = stripcslashes($_GET['kotnm']);
// Decode the JSON array
$tableData = json_decode($tableData,TRUE);
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
			for($i=0;$i<$mycount;$i++)
			{
				$myitemCode=$tableData[$i]['itemCode'];
				$myitemName=addslashes(trim($tableData[$i]['itemName']));
				$myitemUprice=$tableData[$i]['itemUprice'];
				$myitemQuan=$tableData[$i]['itemQuan'];
				$myitemCharg=$tableData[$i]['itemCharg'];
				$query="INSERT INTO adikotdet(kid, icode, itemname, uiprice, uiquan, ktotal) VALUES($tablekotnm, '$myitemCode', '$myitemName', $myitemUprice, $myitemQuan, $myitemCharg)";
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
			}
echo $tablekotnm;
?>
