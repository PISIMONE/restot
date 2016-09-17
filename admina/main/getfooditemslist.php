<?php
include("../connect/connectdb.php");
$tab_blockiiy="FLAG";
$cappno = $_GET['mappno'];
$qstring =null;
	$qstring ="SELECT * FROM adistaffdet WHERE sid='$cappno'";	
//echo $qstring."<br/>";
$stmt = mysql_query($qstring);
while($r=mysql_fetch_array($stmt)) 
		{
			$tab_blockiiy=$r['sid'].'----'.$r['saddrs'].'####'.$r['sphno']; 
		}
echo $tab_blockiiy;
?>