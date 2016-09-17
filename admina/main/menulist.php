<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$querymenulist=null;
$tab_blockmenulist=null;
if(isset($_POST['myusermenu'])){
        $usermenu=$_POST['myusermenu'];
		if($usermenu=="TABLE"){
		$querymenulist = mysql_query("SELECT id,itemname FROM adiitems WHERE menutype NOT LIKE '%PARCEL%' ORDER BY itemname ASC");
		}
		elseif($usermenu=="PARCEL"){
			$querymenulist = mysql_query("SELECT id,itemname FROM adiitems WHERE menutype LIKE '%PARCEL%' ORDER BY itemname ASC");
			}
			else{
				$querymenulist = mysql_query("SELECT id,itemname FROM adiitems ORDER BY itemname ASC");
				}
}
else{
	$querymenulist = mysql_query("SELECT id,itemname FROM adiitems ORDER BY itemname ASC");
	}
$tab_blockmenulist.='<select name="ucode" id="ucode" onchange="myitemcall(this.value)" class="selectmenu" style="background-color:#CF3;"><option value="DEFAULT">DEFAULT</option>';
while($rmenulist=mysql_fetch_array($querymenulist)) 
		{

		$tabid=$rmenulist['id'];
		$tabitemname=preg_replace('/[^A-Za-z0-9\-]/',' ',$rmenulist['itemname']);			
		$tab_blockmenulist.='<option value="'.$tabid.'">'.$tabitemname.'</option>';
		}
$tab_blockmenulist.='</select>';
echo $tab_blockmenulist;
?>