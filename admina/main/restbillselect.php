<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$user_check=$_SESSION['login_user'];
if($user_check!="admin")
	{
	header("Location: mainpage.php");
	}	
	
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$mytodaydatey = (string)date("Y-m-d");
$tab_all=null;
$cmafrod = $_GET['mafromd'];
$myfrmnum=0;
$temptodate=null;
if($cmafrod==""||$cmafrod==null){
	$cmafrod=$mytodaydatey." 00:00:00";
	$cmatod=$mytodaydatey." 23:59:59";
	$temptodate=null;
	}
	else{
		$temptodate=$cmafrod;
		$cmafrod=$temptodate." 00:00:00";
		$cmatod=$temptodate." 23:59:59";
		}
		
$query=null;
$tab_block=null;
$tabview=null;
$tabcreupd=null;
$newformatdate = null;	
$myfrmnum=1;

$tab_block='<table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#FFFFFF">';
$query = mysql_query("SELECT * FROM adirestbill WHERE ((billdate>='$cmafrod') AND (billdate<='$cmatod'))");
while($r=mysql_fetch_array($query)) 
		{
		$newformatdate = null;	
		$myid=$r['id'];
		$foodkots=$r['fbid'];
		$mybillnum=$r['billnum'];
		$mybilltype=$r['billtype'];
		$myotype=$r['otype']; 
		$mygtotal=$r['gtotal']; 
		$mybilldate=$r['billdate'];
		$newformatdate = date_create($mybilldate);
		$newformatdate = (string)(date_format($newformatdate, 'Y-m-d'));
		$mystatus=$r['status'];
		
		if($mystatus=="Confirm")
			{
				$myacolor="#00FF00";
				}
			elseif($mystatus=="Credit")
			{
				$myacolor="PINK";		
					}
		elseif($mystatus=="Cancelled")
			{
				$myacolor="RED";
					}
		elseif($mystatus=="Card")
			{
				$myacolor="#00FF00";
					}
		elseif($mystatus=="Management")
			{
				$myacolor="#FF9900";
					}
			else
			{
				$myacolor="WHITE";
					}
					
			$tabcreupd='<form id="billcreupdt'.$myfrmnum.'" action="restbillpurge.php" method="post">
						<input type="hidden" id="mybillid" name="mybillid" value="'.$myid.'">
						<input type="hidden" id="mybillkots" name="mybillkots" value="'.$foodkots.'">
						<input type="hidden" id="mybnum" name="mybnum" value="'.$mybillnum.'">
						<input type="hidden" id="mybstatus" name="mybstatus" value="'.$mystatus.'">
						<input type="hidden" id="mybdt" name="mybdt" value="'.$newformatdate.'">
						<input type="submit" onclick="return(delbill(this.form));" value="DELETE"></form>';
		
		
							 $tab_block.='<tr bgcolor="'.$myacolor.'">
						<td align="center">'.$mybillnum.'</td>
						<td align="center">'.$mybilldate.'</td>
						<td align="center">'.$mybilltype.'</td>
						<td align="center">'.$myotype.'</td>
						<td align="center">'.$mygtotal.'</td>
						<td align="center">'.$mystatus.'</td>
						<td align="center">'.$tabcreupd.'</td>
					 </tr>';
					 $myfrmnum++;
		}
		$tab_block.='</table>';
		
echo  $tab_block;
?>