<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$tab_block=null;
$query = mysql_query("SELECT * FROM adiitems");
while($r=mysql_fetch_array($query)) 
		{
	$tab_block.='<tr bgcolor="#CCCCCC">
    <td width="15%">'.$r['icode'].'</td>
    <td width="15%">'.$r['itemname'].'</td>
    <td width="15%">'.$r['itemtype'].'</td>
    <td width="15%">'.$r['itemgroup'].'</td>
	<td width="15%" align="right">'.$r['halfrate'].'</td>
    <td width="15%" align="right">'.$r['fullrate'].'</td>
  </tr>'; 
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE VIEW ITEMS PAGE</title>
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
         url: "restfinditems.php",
         data: "mappno="+$("#searchkey").val(),		 		
         success: function(html) {
             $("#tabres").html(html);
                                  }
           });
       }); 
});
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
      <p align="center"><h2>VIEW ITEMS PANEL</h2>
      <table border="1" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
          <tr>
            <td colspan="2">SEARCH TERM</td>
          </tr>
          <tr>
            <td>Search Key:</td>
            <td><input type="text" id="searchkey" name="searchkey"></td>
          </tr>
           </table>
<div id="tabres" name="tabres">
      <form id="addroom" onsubmit="return(addformvalidate());" action="" method="post"></form>
  <table border="0" cellpadding="8" cellspacing="5" width="100%" bgcolor="#FFFFFF">
  <tr>
    <td colspan="6"> <?php
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
  <tr bgcolor="#CCCCCC">
    <td width="15%"><strong>Item Code</strong></td>
    <td width="15%"><strong>Item Name</strong></td>
    <td width="15%"><strong>Type</strong></td>
    <td width="15%"><strong>Group</strong></td>
    <td width="15%" align="right"><strong>Half Rate</strong></td>
    <td width="15%" align="right"><strong>Full Rate</strong></td>
  </tr>
  <?php
  if(isset($tab_block))
  {
	  echo $tab_block;
	  }
  ?>
</table>

		</div>
      </p>
<br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
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