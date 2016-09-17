<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$tab_block=null;
$mygtotal=null;
$mykoid=$_POST['myoid'];
$query = "UPDATE adikotnum SET status='Cancelled' WHERE id='".$mykoid."'";
$result = mysql_query($query) or die(mysql_error());
				$county=null;
				$county=mysql_affected_rows();
				$county=(int)$county;
					if ($county==1)
					{					
					$msg="KOT Status Changed to Cancelled.<br />"; //.$sql;
					}
					else
					{
					$msg="KOT Status Updation failed!.";
					}	
					header("Location: orderview.php");
?>