<?php
include("../connect/connectdb.php");
$cappno = $_GET['mappno'];
if($cappno!="DEFAULT")
{
$cappno=(string)$cappno;
$query=null;
$query = mysql_query("SELECT fullrate FROM adiitems WHERE icode='$cappno'");
$r=mysql_fetch_array($query);
$tabicode=$r['fullrate'];
echo $tabicode;
}
?>