<?php
include("../connect/connectdb.php");
$tab_blockii=null;
$cappno = $_GET['mappno'];
$cappno=(int)$cappno;
$qstring =null;
	$qstring ="SELECT * FROM adiitems WHERE id=$cappno";	
//echo $qstring."<br/>";
$stmt = mysql_query($qstring);
while($r=mysql_fetch_array($stmt)) 
		{
		
		$tab_blockii=$r['icode'].'####'.$r['itemname'].'####'.$r['fullrate'].'####'.$r['halfrate']; 
		}
echo $tab_blockii;
?>