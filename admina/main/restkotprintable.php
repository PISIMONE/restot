<?php
include("../connect/connectdb.php");
include("check.php");
include("companyvars.php");
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
		$mybilltype=$r['billtype'];
		$myotype=$r['otype'];
		$mywaitrname=$r['waitrname'];
		$myloguser=$r['loguser'];
		$mycustto=$r['custto'];
		$mycustphno=$r['custphno'];
		$mytotalitems=$r['totalitems'];
		$mytotaldisper=$r['totaldisper'];
		$mytotaldiscount=$r['totaldiscount'];
		$mytotalgrand=$r['totalgrand'];
		$mystatus=$r['status'];
		$mysno=1;
			$query = mysql_query("SELECT * FROM adikotdet WHERE kid='$kotval'");
			while($r=mysql_fetch_array($query)) 
					{
					$mykdetid=$r['id'];
					$myicode=$r['icode'];
					$myitemname=$r['itemname'];
					$myuiquan=$r['uiquan'];
					$myhiquan=$r['hiquan'];
					$myicharge=$r['icharge'];
					$myidisper=$r['idisper'];
					$myktotal=$r['ktotal'];
					$mykktotal=$myktotal;
					$mygtotal=(($mygtotal+(int)$mykktotal));
					$tab_block.='<tr>
									<td align="left" colspan="4">'.$myitemname.'</td>';
					if((int)$myidisper>0)
					{			
					$tab_block.='<br/>'.$myicharge."-".$myidisper."%".'<br/>'.$myktotal.'<br/>';
					}
					$tab_block.='<td align="center" colspan="1">'.$myuiquan.'</td></tr>';
					$mysno++;
					}
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<center>
<table border="0" cellspacing="0" cellpadding="0" width="260" style="font-family:sans-serif; font-size:10px; font-weight:bold;">
      <tr>
      <td colspan="5" align="center"><strong><?php echo $compvarscname;?><br/>KOT No.<?php echo " ".$kotval." ";?>&nbsp;(<?php echo $mybilltype;?>)<hr /></strong></td>
      </tr>
       <tr>
      <td colspan="5"><strong>O_TYPE:</strong><?php echo $myotype;?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>DATE:</strong><?php echo $mykotdate;?></td>
       </tr>
       <tr>
      <td colspan="5"><strong>Waiter:</strong><?php echo $mywaitrname;?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>By:</strong><?php echo $myloguser;?></td>
       </tr>
       <tr><th colspan="5"><hr /></th></tr>
          <tr>
          	 <td align="center" colspan="4"><strong>ITEM</strong></td>
           	 <td align="center" colspan="1"><strong>QTY</strong></td>
          </tr>
					  <?php
              if(isset($tab_block))
              {
                  echo $tab_block;
                  }
              ?>
          <tr><th colspan="5"><hr /></th></tr>
          <tr><th colspan="5"><br/>Thankyou!<br/></th></tr>
          <?php 
		  if($mytotaldisper>0){
			  echo '<tr>
            <td align="center" colspan="4"><strong>DISCOUNT(%):&nbsp;<?php echo $mytotaldisper;?></strong></td>
            <td align="right">(-)<?php echo number_format($mytotaldiscount,2);?></td>
          </tr>';
		  } ?>
           <tr><th colspan="5"><hr /></th></tr>
        </table>
 </center>   
</body>
</html>