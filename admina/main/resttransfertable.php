<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
if(isset($_GET['mymsg']))
	{
	$msg=$_GET['mymsg'];
	}
	else{
		$msg=null;
		}
$query=null;
$tab_block=null;
$tabview=null;
$tabupdate=null;
$tabdelete=null;
$myfrmnum=1;
$query = mysql_query("SELECT DISTINCT(otype) FROM adikotnum WHERE (otype LIKE '%TABLE%') AND ((status!='Confirm') AND (status!='Cancelled')) ORDER BY otype DESC");
while($r=mysql_fetch_array($query)) 
		{
		//$myotypeid=$r['id'];
		$myotype=$r['otype'];
		//$mystatus=$status;
		$tab_block.='<option value="'.$myotype.'">'.$myotype.'</option>'; 
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE TABLE TRANSFER PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script type="text/javascript">
	function transformvalidate(el){
			var r = confirm("Are you sure to Transfer Table Number!");
		if (r)
		 {
			  var fromtab=document.getElementById("fromtable").value;
			  var totab=document.getElementById("totable").value;
			  if(fromtab==null || fromtab=="DEFAULT" || fromtab=="")
				{
					alert("Please select the From Table Number!");
					return false;
				}
				if(totab==null || totab=="DEFAULT" || totab=="")
				{
					alert("Please select the To Table Number!");
					return false;
				}
				
				if(isNaN(totab))
				{
					alert("Please entry only numeric value(example: 25) for To Table Number!");
					return false;
				}
			 		 
			return true;
		}
			 else{
				 return false;
				 }		
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
    <h2>TABLE TRANSFER PANEL<a href="restmainpage.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
      <table border="0" cellpadding="1" cellspacing="1" width="100%">
  <tr>
    <td colspan="8"> <?php
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
    <table>
      <form id="transfertab" onsubmit="return(transformvalidate());" action="transfermytable.php" method="post">
  <table border="0" cellpadding="1" cellspacing="1" width="60%" height="20%" bgcolor="#CCFF00">
   <tr bgcolor="#CCCCCC">
    <td width="12%"><strong>SELECT TABLE:</strong></td>
    <td width="12%"><select name="fromtable" id="fromtable" style="background-color:#CF3;">
        <option value="DEFAULT">DEFAULT</option>
        <?php echo $tab_block; ?>
        </select></td>
    <td width="12%"><strong>TRANSFER TO:</strong></td>
    <td width="12%"><strong><input type="text" id="totable" name="totable" style="width:60px;"></strong></td>
    <td width="12%" align="center"><strong><!-- UPDATE --></strong></td>
  </tr>
  <tr align="center">
        <td colspan="5"><input type="Submit" value="TRANSFER"></input></td>
  </tr>
</table>
</form>
      </p>
<br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
        <br /><br />
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