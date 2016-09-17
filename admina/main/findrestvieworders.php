<?php
include("../connect/connectdb.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydate = (string)date("Y-m-d H:i:s");
$query=null;
$tab_block=null;
$tabview=null;
$tabupdate=null;
$tabdelete=null;
$myfrmnum=1;
$cmafrod = $_POST['mafromd'];
$cmatod = $_POST['matod'];
if($cmafrod==""||$cmafrod==null){
	$cmafrod="1970-01-01 00:00:00";
	}
	else{
		$cmafrod=$cmafrod." 00:00:00";
		}
if($cmatod==""||$cmatod==null){
	$cmatod=$mytodaydate;
	}
	else{
		$cmatod=$cmatod." 23:59:59";
		}

	$qstring="SELECT * FROM adikotnum WHERE (OTYPE LIKE '%PARCEL%' OR OTYPE LIKE '%TABLE%') AND ((kotdate>='$cmafrod') AND (kotdate<='$cmatod')) ORDER BY id DESC";

	//echo $qstring;
	//exit();
$stmt = mysql_query($qstring);

while($r=mysql_fetch_array($stmt)) 
		{
		$mykid=$r['id'];
		$mykotdate=$r['kotdate'];
		$mybokinum=$r['bokinum'];
		$myotype=$r['otype'];
		$mywaitrname=$r['waitrname'];
		$mystatus=$r['status'];
			if($mystatus=="Delivered")
			{
				$tabview='<form id="viewo'.$myfrmnum.'" action="restorderviewme.php" method="post">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="VIEW"></input>
						  </form>';
				$tabupdate="&nbsp;";			
				$tabdelete="&nbsp;";
				$myacolor="#00FF00";
				}
			elseif($mystatus=="Cancelled")
			{
				$tabview='<form id="viewo'.$myfrmnum.'" action="restorderviewme.php" method="post">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="VIEW"></input>
						  </form>';
				$tabupdate="&nbsp;";
			
				$tabdelete="&nbsp;";								
				$myacolor="#FF0000";			
					}
			elseif($mystatus=="Confirm")
			{
				$tabview='<form id="viewo'.$myfrmnum.'" action="restorderviewme.php" method="post">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="VIEW"></input>
						  </form>';
				/*$tabupdate='<form id="updto'.$myfrmnum.'" action="restorderupdateme.php" method="post">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="UPDATE"></input>
						  </form>';*/
				  $tabupdate='&nbsp';
				$tabdelete="&nbsp;";								
				$myacolor="WHITE";			
					}		
			else
			{	
					if($mystatus=="Processing"){$myacolor="#FFFF00";}
					else{$myacolor="WHITE";}				
				$tabview='<form id="viewo'.$myfrmnum.'" action="restorderviewme.php" method="post">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="VIEW"></input>
						  </form>';
				/*$tabupdate='<form id="updto'.$myfrmnum.'" action="restorderupdateme.php" method="post">
						 <input type="hidden" id="myoid" name="myoid" value="'.$mykid.'">
						 <input type="Submit" value="UPDATE"></input>
						  </form>';*/
						  $tabupdate='&nbsp';
			$tabdelete="&nbsp;";				
				}
						
							////////////////////////////////////////////////
		 $tab_block.='<tr bgcolor="'.$myacolor.'">
						<td width="10%">'.$mykid.'</td>
						<td width="10%">'.$mykotdate.'</td>
						<td width="10%">'.$myotype.'</td>
						<td width="10%">'.$mywaitrname.'</td>
						<td width="10%">'.$mystatus.'</td>
						<td width="10%" align="center">'.$tabview.'</td>
						<td width="10%" align="center">'.$tabupdate.'</td>
						 </tr>'; 
				
		}


echo '<table border="0" cellpadding="1" cellspacing="1" width="100%">  
          <tr bgcolor="#CCCCCC">
            <td width="12%"><strong>KOT NUMBER</strong></td>
            <td width="12%"><strong>KOT DATE</strong></td>
            <td width="12%"><strong>ORDER TYPE</strong></td>
            <td width="12%"><strong>WAITER NAME</strong></td>
            <td width="12%"><strong>STATUS</strong></td>
            <td width="12%" align="center"><strong>VIEW</strong></td>
            <td width="12%" align="center"><strong><!-- UPDATE --></strong></td>
          </tr>'.$tab_block.'</table>';
?>