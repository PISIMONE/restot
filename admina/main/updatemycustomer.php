<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$msg=null;
$sql=null;
////////stname stidp emailid staddrs stphno dob doa
	$mystcustoid=addslashes($_POST['custoid']);
	$mystcustoidd=addslashes($_POST['custoidd']);
	$mystname=addslashes($_POST['stname']);
	$mystname=trim($mystname);
	$mystname=ucwords(strtolower($mystname));
	
	$mystidp=addslashes($_POST['stidp']);
	$mystaddrs=addslashes($_POST['staddrs']);
	$mystaddrs=strtoupper($mystaddrs);
	
	$mystphno=addslashes($_POST['stphno']);
	$mystemailid=addslashes($_POST['emailid']);
	$mystdob=addslashes($_POST['dob']);
	$mystdob=$mystdob." 00:00:00";
	$mystdoa=addslashes($_POST['doa']);	
	$mystdoa=$mystdoa." 00:00:00";
	
	$tempbokinum=substr(str_shuffle(MD5(microtime())), 0, 10);		
	$sql = "UPDATE adicustomers SET custname='$mystname', custidproof='$mystidp', custaddrs='$mystaddrs', custphno='$mystphno', custemailid='$mystemailid', dob='$mystdob', doanni='$mystdoa', updatedon='$mytodaydate' WHERE id='$mystcustoid'";
	$result = mysql_query($sql) or die(mysql_error());
	$count=null;
	$count=mysql_affected_rows();
	$count=(int)$count;
		if ($count==1)
		{		
		  $msg="Customer details Updated Sucessfully.<br />"; //.$sql;
		}
		else
		{
		$msg="Customer details updation failed!.";
		}	
header("Location: viewcustomers.php?mymsg=$msg");
}
?>