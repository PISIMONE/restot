<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$tab_block=null;
$mygtotal=null;
$myktype=$_POST['myootype'];
$mybnum=$_POST['mybookinum'];
$mykoid=$_POST['myoid'];
$query = "SELECT SUM(ktotal) as TOTAL FROM adikotdet WHERE kid='".$mykoid."'";
$result = mysql_query($query) or die(mysql_error());
while($r=mysql_fetch_array($result)) 
		{
			
			$mygtotal=$r['TOTAL'];
		}
$query = "INSERT INTO adifoodbill(otype, bokinum, kid, ktotal, status) VALUES('$myktype', '$mybnum', $mykoid, '$mygtotal', 'Credit')";
$result = mysql_query($query) or die(mysql_error());
$county=null;
$county=mysql_affected_rows();
$county=(int)$county;
if ($county==1)
{					

	$query = "UPDATE adikotnum SET status='Delivered' WHERE id='".$mykoid."'";
	$result = mysql_query($query) or die(mysql_error());
	$county=null;
	$county=mysql_affected_rows();
	$county=(int)$county;
	if ($county==1)
	{					
	$msg="KOT Status Delivered.<br />"; //.$sql;
	
	}
	else
	{
	$msg="KOT Status:'Delivered' Updation failed!.";
	}
}
else
{
$msg="KOT Grand Total Selection failed!.";
}			
header("Location: orderdelivery.php");				
?>