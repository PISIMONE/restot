<?php
include("../connect/connectdb.php");
// Unescape the string values in the JSON array
$tabledelid = stripcslashes($_GET['itemdelid']);
$msg=null;
$query=null;
			
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
