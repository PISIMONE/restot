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
$query = mysql_query("SELECT * FROM store_out WHERE unique_id='$kotval'");
while($r=mysql_fetch_array($query)) 
		{
		$mykid=$r['unique_id'];
		$myt_type=$r['t_type'];
		$mytoken_number=$r['token_number'];
		$mykotdate=$r['outdate'];
		$mynoofitems=$r['noofitems'];
		$mydisper=$r['disper'];
		$mydiscount=$r['discount'];
		$mygtotal=$r['gtotal'];
		$myuserinfo=$r['userinfo'];
		//$myuserinfo=preg_replace('~#~',' ',$myuserinfo);
		$myuserinforex=explode('#',$myuserinfo);
		$mysno=1;
			$query = mysql_query("SELECT * FROM store_out_details WHERE token_id='$kotval'");
			while($r=mysql_fetch_array($query)) 
					{

					$mykdetid=$r['unique_id'];
					$myicode=$r['item_code'];
					$myitemname=$r['particulars'];
					$myitemname=preg_replace('~STORE~','S',$myitemname);
					$myitemname=preg_replace('~COUNTER~','C',$myitemname);
					$myuiquan=$r['quantity'];
					$myuiprice=$r['unitprice'];
					$myudisper=$r['disper'];				
					$myktotal=$r['charged'];
					$tab_block.='<tr>
									<td align="center">'.$mysno.'.'.$myicode.'</td>
									<td align="left">'.$myitemname.'</td>
									 <td align="right">'.$myuiprice.'</td>
									 <td align="center">'.$myuiquan.'</td>
									 <td align="center">'.$myudisper.'</td>
									  <td align="right">'.$myktotal.'</td>
								</tr>';
					$mysno++;
					}
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE VIEW A STORE OUT PAGE</title>
</head>
<body>
<center>
<table border="0" cellspacing="0" cellpadding="0" width="280" style="font-size:8px; font-weight:bold;">
      <tr>
      <td colspan="6" align="center"><strong>COUNTER KOT No.&nbsp;<?php echo " ".$mykid;?><hr /></strong></td>
      </tr>
       <tr>
      <td colspan="3"><strong>O_TYPE:&nbsp;</strong><?php echo $myt_type;?></td>
      <td colspan="3"><strong>DATE:&nbsp;</strong><?php echo $mykotdate;?></td>
       </tr>
      <tr>
      <td colspan="3"><?php echo $myuserinforex[0];?></td>
      <td colspan="3"><?php echo $myuserinforex[1];?></td>
       </tr>
       <tr>
      <td colspan="3"><?php echo $myuserinforex[2];?></td>
      <td colspan="3"><?php echo $myuserinforex[3];?></td>
       </tr>
      <tr>
      <td colspan="6"><?php echo $myuserinforex[4];?></td>
      </tr>
       <tr><th colspan="6"><hr /></th></tr>
          <tr>
          	 <td align="center"><strong>Code</strong></td>
           	 <td align="left"><strong>Items</strong></td>
       		 <td align="right"><strong>UPrice</strong></td>
      		  <td align="center"><strong>Qnt</strong></td>
              <td align="center"><strong>Dis(%)</strong></td>
       		 <td align="right"><strong>Amount</strong></td>
          </tr>
					  <?php
              if(isset($tab_block))
              {
                  echo $tab_block;
                  }
              ?>
          <tr><th colspan="6"><hr /></th></tr>
           <tr>
            <td align="right" colspan="5"><strong>Discount(%):<strong><?php echo number_format($mydisper,2);?></strong></strong></td>
            <td align="right"><strong><?php echo number_format($mydiscount,2);?></strong></td>
          </tr>
          <tr><th colspan="6"><hr /></th></tr>
          <tr>
            <td align="right" colspan="5"><strong>GRAND TOTAL:</strong></td>
            <td align="right"><strong><?php echo number_format($mygtotal,2);?></strong></td>
          </tr>
           <tr align="left"><th colspan="6">(S)-STORE,(C)-COUNTER<hr /></th></tr>
          <tr><th colspan="6">Thankyou For Visiting RESTAURANT-FREE!<hr /></th></tr>
        </table>
 </center>   
</body>
</html>