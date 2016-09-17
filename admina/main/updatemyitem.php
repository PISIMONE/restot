<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$sql=null;
$query=null;
$group_block=null;
$group_menu=null;
if(!isset($_POST['formval']))
{
$_POST['formval']="NO";
}
if(($_SERVER["REQUEST_METHOD"] == "POST")&&($_POST['formval']=="NO"))
{
$myicode=($_POST['myicode']);
$query="SELECT * FROM adiitems WHERE icode='$myicode'";
$query = mysql_query($query);
$r=mysql_fetch_array($query); 
		{
		$myicode= $r['icode'];
		$myitemname=$r['itemname'];
		$mymenutype=$r['menutype'];
		$myitemtype= $r['itemtype'];
		$mynvegtype= $r['nvegtype'];
		$myitemgroup= $r['itemgroup'];
		$myhalfrate= $r['halfrate'];
		$myfullrate= $r['fullrate'];
		}
	//echo $sql;
	//exit();
	$query = mysql_query("SELECT DISTINCT(itemgroup) FROM adiitems ORDER BY itemgroup ASC");
while($r=mysql_fetch_array($query)) 
		{

		$group_block.='<option value="'.$r['itemgroup'].'">'.$r['itemgroup'].'</option>';
		}
	$query = mysql_query("SELECT DISTINCT(menutype) FROM adiitems ORDER BY menutype ASC");
while($rum=mysql_fetch_array($query)) 
		{

			if(($rum['menutype']!=null)||($rum['menutype']!="")){
			$group_menu.='<option value="'.$rum['menutype'].'">'.$rum['menutype'].'</option>';
			}
		}
}
if(($_SERVER["REQUEST_METHOD"] == "POST")&&($_POST['formval']=="YES"))
{
$msg=null;
$sql=null;
$myitemnewmenu=addslashes($_POST['newmenu']);
$myitemcode=strtoupper(addslashes(trim($_POST['itemfcode'])));
$mypitemcode=strtoupper(addslashes(trim($_POST['itemfpcode'])));
$myitemname=addslashes($_POST['itemfname']);
$myitemname=ucwords(strtolower($myitemname));
$myitemtype=addslashes($_POST['itemftype']);
if($myitemtype=="NON-VEG" )
{
	$myitemtypenveg=strtoupper(addslashes($_POST['nvegtype']));
	}
	else{
		$myitemtypenveg="";
		}
$myitemgroup=addslashes($_POST['newgroup']);
$myitemgroup=ucwords(strtolower($myitemgroup));
$myfullrate=addslashes($_POST['fullfrate']);
$myhalfrate=addslashes($_POST['halffrate']);
if($myhalfrate==""||$myhalfrate==null)
{
	$myhalfrate="0";
	}
$sql = "UPDATE adiitems SET icode='$myitemcode', itemname='$myitemname', menutype='$myitemnewmenu', itemtype='$myitemtype', nvegtype='$myitemtypenveg', itemgroup='$myitemgroup', halfrate=$myhalfrate, fullrate=$myfullrate WHERE icode='".$mypitemcode."'";
$result = mysql_query($sql);																		
$count=null;																		
$count=mysql_affected_rows();																		
$count=(int)$count;
	if ($count==1)																								    
	{					
	$msg="Item Updated Successfully.<br />"; //.$sql;
	header("Location: updateitems.php");
	}
	else
	{
	$msg="Updating the Item failed!.";
	header("Location: updateitems.php");
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE UPDATE ITEM PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
$(function() {
 $("#searchkey").bind("change", function() {
     $.ajax({
         type: "GET", 
         url: "findmyitems.php",
         data: "mappno="+$("#searchkey").val(),		 		
         success: function(html) {
             $("#tabres").html(html);
                                  }
           });
       }); 
});
</script>
<script type="text/javascript">
$(function() {
 $("#itemmenutype").bind("change", function() {
     var mymunutype=$("#itemmenutype").val();	
	 if(mymunutype=="DEFAULT"){ 		
	 document.getElementById("newmenu").value= null;
	 }
	 else{
		 document.getElementById("newmenu").value= mymunutype;
		 }
       }); 
	   ///////////////////////////////////
 $("#itemfgroup").bind("change", function() {
     var mygrptype=$("#itemfgroup").val();	
	 if(mygrptype=="DEFAULT"){ 		
	 document.getElementById("newgroup").value= null;
	 }
	 else{
		 document.getElementById("newgroup").value= mygrptype;
		 }
       }); 
	   //////////////////////////////////////////
	   ////////////////////////////////////////
	    $("#itemftype").bind("change", function() {
     var myftype=$("#itemftype").val();	
	 if((myftype=="DEFAULT")||(myftype=="")||(myftype==null)){ 		
	 document.getElementById("nvegtype").value= null;
	  $("#nvegtype").hide(); 
	 }
	 else if(myftype=="NON-VEG"){
		   $("#nvegtype").show(); 
		 }
		 else{
			 document.getElementById("nvegtype").value= null;
			 $("#nvegtype").hide(); 
			 }
       }); 
});
</script>
<script type="text/javascript">
<!--
// Form validation code will come here.
function addformvalidate()
{
var xum=document.forms["upditems"]["newmenu"].value;
 var xa=document.forms["upditems"]["newgroup"].value;
  var z=document.forms["upditems"]["itemftype"].value;
 var x=document.forms["upditems"]["itemfcode"].value;
  var y=document.forms["upditems"]["itemfname"].value;
  var ya=document.forms["upditems"]["fullfrate"].value;
  
   if(xum==null || xum=="DEFAULT")
{
	alert("Please select the Menu Type of ITEM!");
	document.forms["upditems"].elements["newmenu"].focus();
  	return false;
}
  if(xa==null || xa=="DEFAULT")
{
	alert("Please select the Item Group!");
	document.forms["upditems"].elements["itemfgroup"].focus();
  	return false;
}
 if(z==null || z=="DEFAULT")
{
	alert("Please provide select the Item Type!");
	document.forms["upditems"].elements["itemftype"].focus();
  	return false;
}
if(z=="NON-VEG")
{
	var zxm=document.forms["upditems"]["nvegtype"].value;
		if(zxm==""||zxm==null)
	{
		alert("Please provide the Non-Veg Type i.e. Chicken / Fish / Mutton!");
		document.forms["upditems"].elements["nvegtype"].focus();
		return false;
	}
}
 if(x==null || x=="")
{
	alert("Please provide Item Code!");
	document.forms["upditems"].elements["itemfcode"].focus();
  	return false;
}
	 if(y==null || y=="")
{
	alert("Please provide Item Name!");
	document.forms["upditems"].elements["itemfname"].focus();
  	return false;
}
	
 
	 if(ya==null || ya=="")
{
	alert("Please provide Full Plate Rate!");
	document.forms["upditems"].elements["fullfrate"].focus();
  	return false;
}
document.forms["upditems"]["formval"].value="YES";
}
//-->
</script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="fullwidthmenu">
<?php
include("restmainmenu.php");
?>
</div>   
<div id="header">
  <div class="shell">
    <h1 id="logo"><a href="#">RESTAURANT-FREE</a></h1>
  </div>
</div>
<div id="main">
  <div class="shell">
    
    <div align="center">
   
      <p align="center"> <h2>UPDATE ITEM PANEL</h2>
      <form id="upditems" onsubmit="return(addformvalidate());" action="" method="post">
       <table border="0" cellpadding="5" cellspacing="15">
  <tr>
    <td colspan="4"><?php
			if(isset($msg))
			{
			echo "<center><font color='RED' size=+1 >";
			echo $msg;
			echo "</font></center>";
			}
			else{
				echo "&nbsp;";
				}
			?></td>
    </tr>
 <tr>
    <td>SELECT MENU TYPE :</td>
    <td><select name="itemmenutype" id="itemmenutype">
    <option value="DEFAULT">DEFAULT</option>
   				<?php echo $group_menu;?>
       </select></td>
    <td><font color="#0000FF" size="-1">MENU TYPE (Previous / New):</font></td>
    <td><input type="text" id="newmenu" name="newmenu" value="<?php echo $mymenutype; ?>"></td>  
  </tr>
  <tr>
    <td>ITEM GROUP :</td>
    <td> <select name="itemfgroup" id="itemfgroup">
   <option value="DEFAULT">DEFAULT</option>
   				<?php echo $group_block;?>
       </select></td>
    <td><font color="#0000FF" size="-1">NEW GROUP:</font></td>
    <td><input type="text" id="newgroup" name="newgroup" value="<?php echo $myitemgroup; ?>"></td>  
  </tr>
   <tr>
    <td>ITEM TYPE :</td>
    <td><select name="itemftype" id="itemftype">
    <option value="DEFAULT">DEFAULT</option>
     <option value="VEG">VEG</option>
      <option value="NON-VEG">NON-VEG</option>
       </select></td>
        <td colspan="2"><input type="text" id="nvegtype" name="nvegtype" style="display: none;  width:200px;" placeholder="i.e. Chicken / Fish / Mutton"></td>
  </tr>
   <tr>
    <td>ITEM CODE :<input type="hidden" id="itemfpcode" name="itemfpcode" value="<?php echo $myicode; ?>"></td>
    <td><input type="text" id="itemfcode" name="itemfcode" value="<?php echo $myicode; ?>"></td>
     <td>ITEM NAME :</td>
    <td><input type="text" id="itemfname" name="itemfname" value="<?php echo $myitemname; ?>"></td>
  </tr>
  <tr>
    <td>FULL PLATE RATE :</td>
    <td><input type="text" id="fullfrate" name="fullfrate" value="<?php echo $myfullrate; ?>"></td>
     <td>HALF PLATE RATE :</td>
    <td><input type="text" id="halffrate" name="halffrate" value="<?php echo $myhalfrate; ?>"></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input type="text" id="formval" name="formval" value="NO"></td>
    <td><input type="Submit" value="UPDATE ITEM"></input></td>
    <td>&nbsp;</td>
  </tr>
  </table>
</form>
      </p>
    <br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
        <br /><br /><br /><br /><br /><br />
    </div>
    
    <div class="cl">&nbsp;</div>
  </div>
</div>
<div class="footer">
  <div class="shell">
    <p class="lf">Copyright &copy; 2010 <a href="#">RESTAURANT-FREE</a> - All Rights Reserved</p>
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_ME_FREE</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>