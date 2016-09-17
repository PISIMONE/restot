<?php
include("../connect/connectdb.php");
$tab_block=null;
$cappno = $_GET['mappno'];
$cappno=(string)$cappno;
$myfrmnum=1;
if($cappno==""||$cappno==null){
	$cappno="%";
	}
	$qstring="SELECT * FROM adiitems 
			WHERE 
			icode LIKE \"%$cappno%\"
			or 
			itemname LIKE \"%$cappno%\"
			or 
			itemtype LIKE \"%$cappno%\"
			or 
			itemgroup LIKE \"%$cappno%\"";
	
//echo $qstring."<br/>";
$stmt = mysql_query($qstring);
$tab_block.='<table border="0" cellpadding="8" cellspacing="5" width="100%">
  <tr bgcolor="#CCCCCC">
    <td width="15%"><strong>Item Code</strong></td>
    <td width="15%"><strong>Item Name</strong></td>
    <td width="15%"><strong>Type</strong></td>
    <td width="15%"><strong>Group</strong></td>
    <td width="15%" align="right"><strong>Half Rate</strong></td>
    <td width="15%" align="right"><strong>Full Rate</strong></td>
    <td width="15%" align="right"><strong>ACTION</strong></td>
  </tr>';
while($r=mysql_fetch_array($stmt)) 
		{
		
	$tab_block.='<tr bgcolor="#CCCCCC">
    <td width="15%">'.$r['icode'].'</td>
    <td width="15%">'.$r['itemname'].'</td>
    <td width="15%">'.$r['itemtype'].'</td>
    <td width="15%">'.$r['itemgroup'].'</td>
	<td width="15%" align="right">'.$r['halfrate'].'</td>
    <td width="15%" align="right">'.$r['fullrate'].'</td>
	<td width="15%" align="right"><form id="upditem'.$myfrmnum.'" action="updatemyitem.php" method="post">
     <input type="hidden" id="myicode" name="myicode" value="'.$r['icode'].'">
     <input type="Submit" value="UPDATE"></input>
      </form></td>
  </tr>'; 
  $myfrmnum++;
		}
$tab_block.='</table>';
echo $tab_block;
?>