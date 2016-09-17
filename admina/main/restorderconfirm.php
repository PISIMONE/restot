<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$thisquery=null;
$thisresult=null;
$thisnumrow=null;
$Vy3xp1y0eiui=null;
$Vcyjepzb2cs1=null;
$Vdzjah2iayln=null;
$Vpphze2cc2qi=null;
$Vhwx3yu5oiju=$_POST['myootype'];
$V3uekdi0twde=$_POST['mybookinum'];
$V1qf25cd4hwt=$_POST['myoid'];


$thisquery = "SELECT * FROM adikotnum WHERE id='".$V1qf25cd4hwt."' AND status='Processing'";
$thisresult = mysql_query($thisquery) or die(mysql_error());
$thisnumrow=mysql_num_rows($thisresult);
 //echo $thisnumrow."<br/>";
$thisnumrow=(int)$thisnumrow;


		
if($thisnumrow==1)
{


$Vcyjepzb2cs1 = "SELECT SUM(ktotal) as TOTAL FROM adikotdet WHERE kid='".$V1qf25cd4hwt."'";
$V4ebpgunyn30 = mysql_query($Vcyjepzb2cs1) or die(mysql_error());
while($Vby4kaxa14ar=mysql_fetch_array($V4ebpgunyn30)) 
		{
			$Vpphze2cc2qi = $Vby4kaxa14ar['TOTAL'];
		}
$Vcyjepzb2cs1 = "SELECT * FROM adikotnum WHERE id='".$V1qf25cd4hwt."' AND status='Processing'";
$V4ebpgunyn30 = mysql_query($Vcyjepzb2cs1) or die(mysql_error());
while($Vby4kaxa14ar=mysql_fetch_array($V4ebpgunyn30)) 
		{
			
			$Vlt5n0kskaxl = $Vby4kaxa14ar['totaldisper'];
			
		}
if(!isset($Vlt5n0kskaxl))
{
	$Vlt5n0kskaxl=0;
	}
$Vc0ka3nvlldq=(float)(($Vpphze2cc2qi*$Vlt5n0kskaxl)/100);
$V4u51cp5t0h5=(float)($Vpphze2cc2qi-$Vc0ka3nvlldq);
	
$Vcyjepzb2cs1 = "INSERT INTO adifoodbill(otype, bokinum, kid, ktotal, status) VALUES('$Vhwx3yu5oiju', '$V3uekdi0twde', $V1qf25cd4hwt, '$V4u51cp5t0h5', 'Credit')";
$V4ebpgunyn30 = mysql_query($Vcyjepzb2cs1) or die(mysql_error());
$Vo1yqtthxyo0=null;
$Vo1yqtthxyo0=mysql_affected_rows();
$Vo1yqtthxyo0=(int)$Vo1yqtthxyo0;
if ($Vo1yqtthxyo0==1)
{					

	$Vcyjepzb2cs1 = "UPDATE adikotnum SET status='Delivered' WHERE id='".$V1qf25cd4hwt."' AND status='Processing'";
	$V4ebpgunyn30 = mysql_query($Vcyjepzb2cs1) or die(mysql_error());
	$Vo1yqtthxyo0=null;
	$Vo1yqtthxyo0=mysql_affected_rows();
	$Vo1yqtthxyo0=(int)$Vo1yqtthxyo0;
	if ($Vo1yqtthxyo0==1)
	{					
	$Vy3xp1y0eiui="KOT Status Delivered.<br />"; 
	
	}
	else
	{
	$Vy3xp1y0eiui="KOT Status:'Delivered' Updation failed!.";
	}
}
else
{
$Vy3xp1y0eiui="KOT Grand Total Selection failed!.";
}		

//echo "I am here in 1<br/>";

}////if end for if($thisnumrow>0)
else{
	$alreadybilled="KOT is already proceeded.";
	//echo "I am here in 2 <br/>";
	header("Location: restorderdelivery.php?msg=$alreadybilled");
	exit();
	}


header("Location: restorderdelivery.php");				
?>