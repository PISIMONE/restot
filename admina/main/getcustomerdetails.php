<?php
include("../connect/connectdb.php");
$tab_blockiim=null;
$cappno = $_GET['mappno'];
$cappno=(int)$cappno;
$qstring =null;
	$qstring ="SELECT * FROM adicustomers WHERE id=$cappno";	
//echo $qstring."<br/>";
$stmt = mysql_query($qstring);
while($r=mysql_fetch_array($stmt)) 
		{
		$tab_blockiim=$r['custid'].'####'.$r['custname'].'####'.$r['custaddrs'].'####'.$r['custphno']; 
		}
echo $tab_blockiim;
?>