<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$msg=null;
$sql=null;
$mygtotal=null;
$mymybid=addslashes($_POST['mybid']);
$mytotamount=0;
$mynewtab=null;
$query = mysql_query("SELECT * FROM adirestbill WHERE billnum='$mymybid'");
while($r=mysql_fetch_array($query)) 
		{

		$myid=$r['id'];
		$mybillnum =$r['billnum'];
		$mybilltype=$r['billtype'];
		$myotype=$r['otype'];
		$mydiscount=$r['discount'];
		$mystax=$r['stax'];
		$myvat=$r['vat'];
		$mygtotal=$r['gtotal']; 
		$mybilldate=$r['billdate'];
		$mystatus=$r['status'];
		////////////////////////////
		$queryy = mysql_query("SELECT * FROM adirestbilldet WHERE billnum='$mymybid'");
		while($rr=mysql_fetch_array($queryy)) 
		{

			$myicode=$rr['icode'];
			$myitemname=$rr['itemname'];
			$myitemnamee=substr($myitemname, 0, 20)."...";
			$myuiprice=$rr['uiprice'];
			$myuiprice=(float)$myuiprice;
			$myuiquan=(float)$rr['uiquan'];
			$myicamount=(float)($myuiprice*$myuiquan);
			$myktotal=$rr['ktotal'];
		 /////////////////////////////////
			$mynewtab.='<tr>
           <td align="left">'.$myitemnamee.'</td>
           <td align="right">'.number_format($myuiprice,2).'</td>
           <td align="right">'.$myuiquan.'</td>
           <td align="right">'.number_format($myicamount,2).'</td>
          </tr>';
			}
	
		}
}
?>
<html>
<head></head>
<body>
<center>
<table border="0" cellspacing="2" cellpadding="1" width="470" style="font-size:10px; font-weight:bold;">
   <tr align="center">
   <td colspan="3">
           <img src="images/adityabill_logo.png" width="100"><br/><font color="#000099" size="-2">RESTAURANT-FREE<br/>2nd Floor, Above Blackberry,<br/> Citadel Building,<br/>Main Road, Ranchi<br/>Phone: 0651 - 65556601/02, 0651 - 65556603/04</font>
           </td>
   </tr>
   <tr>
    <td align="left">
    <strong>BILL.</strong>&nbsp;<?php echo $mybillnum;?>
    </td>
    <td>&nbsp;</td>
    <td align="right">
    <strong>DATE:</strong>&nbsp;<?php echo $mybilldate;?>
    </td>
   </tr>
   <tr>
   <td align="left"><strong>O.Type</strong>:&nbsp;<?php echo $myotype;?></td>
   <td align="right"><strong>P.Mode</strong>:&nbsp;<?php echo $mybilltype;?></td>
   <td align="right"><strong>STATUS</strong>:&nbsp;<?php echo $mystatus;?></td>
   </tr>
   <tr>
     <td colspan="3">
       <table border="0" cellspacing="1" cellpadding="2" width="100%" style="font-size:10px; font-weight:bold;">
         <tr bgcolor="#CCCCCC" >
           <td align="left">Items</td>
           <td align="right">U.Price</td>
           <td align="right">Quant</td>
           <td align="right">Amnt</td>
          </tr>
          <?php echo $mynewtab; ?>
          <tr>
           <td align="left" colspan="4"><hr /></td>
           </tr>
             </table>
      </td>
   </tr>
   <tr>
   		<td>&nbsp;</td>
        <td colspan="2">
           <table border="0" cellspacing="1" cellpadding="0" width="100%" style="font-size:10px; font-weight:bold;">
          <tr>
            <td>Discount(%):</td>
            <td align="right"><?php echo $mydiscount;?></td>
          </tr>
          <tr>
            <td>S. Tax(%):</td>
            <td align="right"><?php echo $mystax;?></td>
          </tr>
          <tr>
            <td>VAT(%):</td>
            <td align="right"><?php echo $myvat;?></td>
          </tr>
          <?php 
		  $pos = strpos($myotype,"PARCEL");
		  if ($pos=== false) {
			  //string not found
		  }
		  else{
				// We found a string inside string
				echo '<tr>
				<td>Parcel Charges(in Rs.):</td>
				<td align="right">20</td>
			  </tr>';
				}
				?>
        </table>
       </td>
   </tr>
   <tr>
   <td align="left" colspan="4"><hr /></td>
   </tr>
   <tr bgcolor="#CCCCCC">
   <td colspan="2" align="right"><strong>Grand Total:</strong></td>   
   <td align="right"><strong><?php echo $mygtotal;?></strong></td>
   </tr>
       <tr>
    <td align="center" bgcolor="#CCCCCC" colspan="3">Thankyou for Visiting Us.</td>
   </tr>
</table>
</center>
</body>
</html>