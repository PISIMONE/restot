<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$tab_blockk=null;
$mygtotal=null;
$mykoid=$_POST['myoid'];
$query = mysql_query("SELECT * FROM adikotnum WHERE id='$mykoid'");
while($r=mysql_fetch_array($query)) 
		{
		$mykid=$r['id'];
		$mykotdate=$r['kotdate'];
		$mybokinum=$r['bokinum'];
		$myotype=$r['otype'];
		$mywaitrname=$r['waitrname'];
		$mystatus=$r['status'];
		$mysno=1;
			$query = mysql_query("SELECT * FROM adikotdet WHERE kid='$mykoid'");
			while($r=mysql_fetch_array($query)) 
					{
				
					$mykdetid=$r['id'];
					$myicode=$r['icode'];
					$myitemname=$r['itemname'];
					$myuiprice=$r['uiprice'];
					$myuiquan=$r['uiquan'];
					$myktotal=$r['ktotal'];
					$mykktotal=$myktotal;
					$mygtotal=(($mygtotal+(int)$mykktotal));
					$tab_blockk.='<tr>
									<td>'.$mysno.'</td>
									<td>'.$myicode.'</td>
									<td>'.$myitemname.'</td>
									<td>'.$myuiprice.'</td>
									<td>'.$myuiquan.'</td>
									<td>'.$myktotal.'</td>
									<td><input type="button" value = "Delete" onClick="Javacsript:deleteRoww(this,'.$mykid.','.$mykdetid.')"></td>
								</tr>';
					$mysno++;
					}
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE PLACE AN ORDER PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script src="../datejs/jquery-1.10.2.js"></script>
 
	 <script type="text/javascript">
function deleteRoww(obj,thekotid,rowdelid) {	
	var mythekotid=thekotid;
    var  mydelidd=rowdelid;
			$.ajax({
			type: "GET",
			url: "restdelitem.php",
			data: { 
					itemkotid:mythekotid,
					itemdelid:mydelidd,
					},
			success: function(msg){
				//alert(msg);
				//return msg;
				 var index = obj.parentNode.parentNode.rowIndex;
					var table = document.getElementById("myTableDataa");
					table.deleteRow(index);
				// return value stored in msg variable
			}
		});
   
    
}
</script>
<script src="../json/jquery.json-2.4.min.js"></script>
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
    
      <p align="center">
     
      
      
       <form id="kotfinn" >
       <table id="myTableDataa" border="1" cellspacing="1" cellpadding="2" width="100%" bgcolor="#FFFFFF">
      <tr>
      <td colspan="7" height="40" align="center" bgcolor="#CCCCCC"><strong>KOT No.<input readonly="readonly" id="myykotid" name="myykotid" value="<?php echo $mykoid;?>"></strong></td>
       </tr>
      
       <tr>
      <td bgcolor="#CCCCCC"><strong>ORDER TYPE:</strong></td>
      <td bgcolor="#CCCCCC"><input readonly="readonly" id="roomnumm" name="roomnumm" value="<?php echo $myotype;?>"></td>
      <td bgcolor="#CCCCCC"><strong>Waiter Name:</strong></td>
      <td bgcolor="#CCCCCC"><input readonly="readonly" id="waitname" name="waitname" value="<?php echo $mywaitrname;?>"></td>
      <td bgcolor="#CCCCCC"><strong>KOT DATE:</strong></td>
      <td  colspan="2" bgcolor="#CCCCCC"><input readonly="readonly" id="kotdatee" name="kotdatee" value="<?php echo $mykotdate;?>"></td>
      </tr>
          <tr bgcolor="#CCCCCC">
          	<td align="center">S.No.</td>
            <td align="center"><strong>Item Code</strong></td>
           	 <td align="left"><strong>Item Name</strong></td>
       		 <td align="right"><strong>Unit Price</strong></td>
      		  <td align="center"><strong>Quantity</strong></td>
       		 <td align="right"><strong>Charge</strong></td>
             <td align="center"><strong>Action</strong></td>
          </tr>
					  <?php
              if(isset($tab_blockk))
              {
                  echo $tab_blockk;
                  }
              ?>
          
    </table>
     </form>
     
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

        </p>

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