<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$sql=null;
$query=null;
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
		//extract($r);	
		$myicode= $r['icode'];
		$myitemname= $r['itemname'];
		$myitemtype= $r['itemtype'];
		$myitemgroup= $r['itemgroup'];
		$myhalfrate= $r['halfrate'];
		$myfullrate= $r['fullrate'];
		}
	//echo $sql;
	//exit();
}
if(($_SERVER["REQUEST_METHOD"] == "POST")&&($_POST['formval']=="YES"))
{
$msg=null;
$sql=null;
$myitemcode=strtoupper(addslashes(trim($_POST['itemfcode'])));
$mypitemcode=strtoupper(addslashes(trim($_POST['itemfpcode'])));
$sql = "DELETE FROM adiitems WHERE icode='".$mypitemcode."'";
$result = mysql_query($sql);																		
$count=null;																		
$count=mysql_affected_rows();																		
$count=(int)$count;
	if ($count==1)																								    
	{					
	$msg="Item Deleted Successfully.<br />"; //.$sql;
	header("Location: delitems.php");
	}
	else
	{
	$msg="Deleting the Item failed!.";
	header("Location: delitems.php");
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE DELETE ITEM PAGE</title>
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
		function delformvalidate(){
			var r = confirm("Are you sure to delete this ITEM !");
		if (r == true)
		  {
		  document.forms["upditems"]["formval"].value="YES";
		  return true;
		  }
		else
		  {
		  return false;
		  }
		  return false;		
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
   
      <p align="center"> <h2>DELETE ITEM PANEL</h2>
      <form id="upditems" onsubmit="return(delformvalidate());" action="" method="post">
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
    <td>ITEM CODE :<input type="hidden" id="itemfpcode" name="itemfpcode" value="<?php echo $myicode; ?>"></td>
    <td><input type="text" readonly="readonly" id="itemfcode" name="itemfcode" value="<?php echo $myicode; ?>"></td>
    <td>ITEM TYPE :</td>
    <td><input type="text" readonly="readonly" id="itemftype" name="itemftype" value="<?php echo $myitemtype; ?>"></td>
  </tr>
   <tr>
    <td>ITEM NAME :</td>
    <td><input type="text" readonly="readonly" id="itemfname" name="itemfname" value="<?php echo $myitemname; ?>"></td>
    <td>ITEM GROUP :</td>
    <td><input type="text" readonly="readonly" id="itemfgroup" name="itemfgroup" value="<?php echo $myitemgroup; ?>"></td>
  </tr>
  <tr>
    
  </tr>
  <tr>
    <td>FULL PLATE RATE :</td>
    <td><input type="text" readonly="readonly" id="fullfrate" name="fullfrate" value="<?php echo $myfullrate; ?>"></td>
     <td>HALF PLATE RATE :</td>
    <td><input type="text" readonly="readonly" id="halffrate" name="halffrate" value="<?php echo $myhalfrate; ?>"></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input type="text" id="formval" name="formval" value="NO"></td>
    <td><input type="Submit" value="DELETE ITEM"></input></td>
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
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_M_FREE</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>