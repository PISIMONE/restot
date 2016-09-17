<?php
include("../connect/connectdb.php");
include("check.php");
$tabledelid = ($_POST['stfid']);
$msg=null;
$query=null;
			
				$query="DELETE FROM adistaffdet WHERE id=$tabledelid";
				$result = mysql_query($query) or die(mysql_error());
				$county=null;
				$county=mysql_affected_rows();
				$county=(int)$county;
					if ($county==1)
					{					
					$msg="Staff DELETED OK.<br />"; //.$sql;
					}
					else
					{
					$msg="Staff DELETION failed!.";
					}	
header("Location: deletestaffs.php");	
?>
