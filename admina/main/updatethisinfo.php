<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//compname compaddrs phone compemail webadd ptitle compslog regnum tinnum cstnum vatnum staxper vatper scharge parcel
$msg=NULL;
$query=NULL;


$rotcompname=addslashes($_POST['compname']);
if(($rotcompname=="")||($rotcompname==NULL))
{
	$rotcompname="NONE";
	}
	
$rotcompaddrs=addslashes($_POST['compaddrs']);
if(($rotcompaddrs=="")||($rotcompaddrs==NULL))
{
	$rotcompaddrs="NONE";
	}

$rotphone=addslashes($_POST['phone']);
if(($rotphone=="")||($rotphone==NULL))
{
	$rotphone="NONE";
	}

$rotcompemail=addslashes($_POST['compemail']);
if(($rotcompemail=="")||($rotcompemail==NULL))
{
	$rotcompemail="NONE";
	}

$rotwebadd=addslashes($_POST['webadd']);
if(($rotwebadd=="")||($rotwebadd==NULL))
{
	$rotwebadd="NONE";
	}

$rotptitle=addslashes($_POST['ptitle']);
if(($rotptitle=="")||($rotptitle==NULL))
{
	$rotptitle="NONE";
	}

$rotcompslog=addslashes($_POST['compslog']);
if(($rotcompslog=="")||($rotcompslog==NULL))
{
	$rotcompslog="NONE";
	}

$rotregnum=addslashes($_POST['regnum']);
if(($rotregnum=="")||($rotregnum==NULL))
{
	$rotregnum="NONE";
	}

$rottinnum=addslashes($_POST['tinnum']);
if(($rottinnum=="")||($rottinnum==NULL))
{
	$rottinnum="NONE";
	}

$rotcstnum=addslashes($_POST['cstnum']);
if(($rotcstnum=="")||($rotcstnum==NULL))
{
	$rotcstnum="NONE";
	}

$rotvatnum=addslashes($_POST['vatnum']);
if(($rotvatnum=="")||($rotvatnum==NULL))
{
	$rotvatnum="NONE";
	}
	
$rotsbtnum=addslashes($_POST['sbtnum']);	///swachh bharat tax number
if(($rotsbtnum=="")||($rotsbtnum==NULL))
{
	$rotsbtnum="NONE";
	}

$rotstaxper=addslashes($_POST['staxper']);
if(($rotstaxper=="")||($rotstaxper==NULL))
{
	$rotstaxper="0.00";
	}

$rotvatper=addslashes($_POST['vatper']);
if(($rotvatper=="")||($rotvatper==NULL))
{
	$rotvatper="0.00";
	}

$rotsbtper=addslashes($_POST['sbtper']);	///swachh bharat tax percentage
if(($rotsbtper=="")||($rotsbtper==NULL))
{
	$rotsbtper="0.00";
	}

$rotscharge=addslashes($_POST['scharge']);
if(($rotscharge=="")||($rotscharge==NULL))
{
	$rotscharge="0.00";
	}

$rotparcel=addslashes($_POST['parcel']);
if(($rotparcel=="")||($rotparcel==NULL))
{
	$rotparcel="0.00";
	}
	
$rotclogo="NONE";
$count=NULL;

	$query = "UPDATE `thecompinfo` SET `cname` = '$rotcompname', `caddrs` = '$rotcompaddrs', `cphno` = '$rotphone', `cemail` = '$rotcompemail', `cweb` = '$rotwebadd', `clogo` = '$rotclogo', `cptitle` = '$rotptitle', `cslog` = '$rotcompslog', `cregno` = '$rotregnum', `ctinno` = '$rottinnum', `cstno` = '$rotcstnum', `cvatno` = '$rotvatnum', `sbtno` = '$rotsbtnum', `cstaxper` = '$rotstaxper', `cvatper` = '$rotvatper', `csbtaxper` = '$rotsbtper', `sercharge` = '$rotscharge', `cparcel` = '$rotparcel', `createdon` = '2010-06-26 00:00:00', `updatedon` = '$mytodaydate' WHERE `id` = 1";
	
        $result = mysql_query($query) or die(mysql_error());
		$count = mysql_affected_rows();
		
		if($count>0)
		{
			$msg="Company Info Updated Successfully.";
			}
			else{
				$msg="Company Info Updation failed!.";
				}
			
		header("Location: companyinfo.php?mymsg=$msg");

}
?>