<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$mytodaydatey = (string)date("Y-m-d");


$cmafrod = $_GET['mafromd'];
$cmatod = $_GET['mafromd'];
$myfrmnum=0;
$mygrandsum=0;
if($cmafrod==""||$cmafrod==null){
	$cmafrod=$mytodaydatey." 00:00:00";
	}
	else{
		$cmafrod=$cmafrod." 00:00:00";
		}
if($cmatod==""||$cmatod==null){
	$cmatod=$mytodaydatey." 23:59:59";
	}
	else{
		$cmatod=$cmatod." 23:59:59";
		}

	//$qstring="SELECT * FROM adirestbill WHERE ((billdate>='$cmafrod') AND (billdate<='$cmatod'))";


$tab_all=null;

$query=null;
$tab_block=null;
$tabview=null;
$tabcreupd=null;
$newformatdate = null;	
$myfrmnum=1;

$query = mysql_query("SELECT * FROM adirestbill WHERE ((billdate>='$cmafrod') AND (billdate<='$cmatod')) AND ((billtype='Cash') OR (billtype='Card')) AND status='Confirm'");
$tab_block='<table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#FFFFFF">
	<tr bgcolor="#CCCCCC">
    <td align="center"><strong>BILL-No.</strong></td>
    <td align="center"><strong>DATE</strong></td>
    <td align="center"><strong>B.TYPE</strong></td>
    <td align="center"><strong>O.TYPE</strong></td>
    <td align="center"><strong>GRAND</strong></td>
    <td align="center"><strong>STATUS</strong></td>
    <td align="center"><strong>ACTION</strong></td>
 </tr>';
while($r=mysql_fetch_array($query)) 
		{
		$newformatdate = null;	
		$myid=$r['id'];
		$mybillnum=$r['billnum'];
		$mybilltype=$r['billtype'];
		$myotype=$r['otype']; 
		$mygtotal=$r['gtotal']; 
		$mybilldate=$r['billdate'];
		$newformatdate = date_create($mybilldate);
		$newformatdate = (string)(date_format($newformatdate, 'Y-m-d'));
		$mystatus=$r['status'];
		
		if(($mybilltype=="Cash")||($mybilltype=="Card"))
			{
				$myacolor="#00FF00";
				$tabcreupd='<form id="billcreupdt'.$myfrmnum.'" action="changebillmode.php" method="post">
						<input type="hidden" id="mybillid" name="mybillid" value="'.$myid.'">
						<input type="hidden" id="mybid" name="mybid" value="'.$mybillnum.'">
						<input type="hidden" id="mybdt" name="mybdt" value="'.$newformatdate.'">
						<input type="submit" onclick="return(updatediscount(this.form));" value="CHANGE"></form>';
				}
			else
			{
				$myacolor="WHITE";
				$tabcreupd="&nbsp;";			
					}
		
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


echo $tab_block;
?>