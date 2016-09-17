<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$query=null;
$kotval = stripcslashes($_GET['tkval']);
//echo $tableData;
$tab_block=null;
$mygtotal=null;
$query = mysql_query("SELECT * FROM adikotnum WHERE id='$kotval'");
while($r=mysql_fetch_array($query)) 
		{
		$mykid=$r['id'];
		$mykotdate=$r['kotdate'];
		$mybokinum=$r['bokinum'];
		$myotype=$r['otype'];
		$mywaitrname=$r['waitrname'];
		$mystatus=$r['status'];
		$mysno=1;
			$query = mysql_query("SELECT * FROM adikotdet WHERE kid='$kotval'");
			while($r=mysql_fetch_array($query)) 
					{
					
					$mykdetid=$r['id'];
					$myicode=$r['icode'];
					$myitemname=$r['itemname'];
					$myuiprice=$r['uiprice'];
					$myuiquan=$r['uiquan'];
					$myktotal=$r['ktotal'];
					$mykktotal=$r['myktotal'];
					$mygtotal=(($mygtotal+(int)$mykktotal));
					$tab_block.='<tr>
									<td align="center">'.$mysno.'</td>
									<td align="center">'.$myicode.'</td>
									<td align="left">'.$myitemname.'</td>
									 <td align="right">'.$myuiprice.'</td>
									 <td align="center">'.$myuiquan.'</td>
									  <td align="right">'.$myktotal.'</td>
								</tr>';
					$mysno++;
					}
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE VIEW AN ORDER PAGE</title>
</head>
<body>
<center>
<table border="0" cellspacing="0" cellpadding="0" width="340" style="font-size:10px;">
      <tr>
      <td colspan="6" align="center"><strong>KOT No.<?php echo " ".$kotval;?><hr /></strong></td>
      </tr>
       <tr>
      <td colspan="2"><strong>O_TYPE:</strong><?php echo $myotype;?></td>
      <td colspan="2"><strong>Waiter:</strong><?php echo $mywaitrname;?></td>
      <td colspan="2"><strong>DATE:</strong><?php echo $mykotdate;?></td>
       </tr>
       <tr><th colspan="6"><hr /></th></tr>
          <tr>
          	<td align="center"><strong>S.No.</strong></td>
            <td align="center"><strong>Item Code</strong></td>
           	 <td align="left"><strong>Item Name</strong></td>
       		 <td align="right"><strong>U_Price</strong></td>
      		  <td align="center"><strong>Quantity</strong></td>
       		 <td align="right"><strong>Charge</strong></td>
          </tr>
					  <?php
              if(isset($tab_block))
              {
                  echo $tab_block;
                  }
              ?>
          <tr><th colspan="6"><hr /></th></tr>
          <tr>
            <td align="right" colspan="5"><strong>GRAND TOTAL:</strong></td>
            <td align="right"><strong><?php echo number_format($mygtotal,2);?></strong></td>
          </tr>
          <tr><th colspan="6"><hr /></th></tr>
        </table>
 </center>   
</body>
</html>