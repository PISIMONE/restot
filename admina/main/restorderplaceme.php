<?php
include("../connect/connectdb.php");
include("check.php");
include("companyvars.php");
$loginusername=$login_session;
$sql=null;
$query =null;
$group_block=null;
$group_blockcust=null;
$query = mysql_query("SELECT * FROM adistaffdet WHERE sdesig='WAITER' ORDER BY sname ASC");
while($r=mysql_fetch_array($query)) 
		{
		$group_block.='<option value="'.$r['sid'].'">'.$r['sname']." - ".$r['sid'].'</option>';
		}
$query = mysql_query("SELECT * FROM adicustomers ORDER BY custname ASC");
while($r=mysql_fetch_array($query)) 
		{
		$group_blockcust.='<option value="'.$r['id'].'">'.$r['custname']." - ".$r['custid'].'</option>';
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE ORDER PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<link rel="stylesheet" href="../combojs/jquery-ui.css">
<script src="../combojs/jquery-1.10.2.js"></script>


  <link rel="stylesheet" href="docsupport/prism.css">
  <link rel="stylesheet" href="chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>


TRUNCATED
 
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
    <h2>STOCK OUT PAGE<a href="restorderlist.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
      <div id="myform">      
      <form id="addroom">
      <table border="1" cellspacing="1" cellpadding="1" width="100%" bgcolor="#CCCCCC">
      <tr>
    <td colspan="11" height="40">SELECT THE TYPE OF ORDER MENU LIST:<input type="radio" id="mynewmenutype1" name="mynewmenutype" value="PARCEL" tabindex="1"/> PARCEL<input type="radio" id="mynewmenutype2" name="mynewmenutype" value="TABLE" tabindex="2"/> TABLE</td>
     </tr>
      <tr><td colspan="11" height="40" align="center" bgcolor="#CCCCCC"><strong>SELECT ITEMS</strong></td><tr>
      <tr>     
        <td colspan="4" align="center" bgcolor="#33CCFF"><strong>BILLING TYPE:</strong><select id="store_type" style="background-color:#CF3;" tabindex="3">
                      <option value="DEFAULT">DEFAULT</option>
                      <option value="C">CHARGABLE</option>
                      <option value="NC">NON-CHARGABLE</option>                      
                  </select></td>
        <td colspan="7" align="center" bgcolor="#33CCFF">Select Item:<div id="itemslisted" name="itemslisted">
        <select name="ucode" id="ucode" onchange="myitemcall(this.value)" class="selectmenu chosen-select" style="width:400px; background-color:#CF3;" tabindex="4">
        <option value="DEFAULT">DEFAULT</option>
        </select>
        </div>
        </td>        
      </tr>
      <tr>     
        <td align="center"><strong>CODE</strong></td>
        <td align="center"><strong>Item</strong></td>
        <td align="center"><strong>F.Price</strong></td>
        <td align="center"><strong>H.Price</strong></td>
        <td align="center"><strong>F.Qnty</strong></td>
        <td align="center"><strong>H.Qnty</strong></td>
        <td align="center"><strong>Charges</strong></td>
        <td align="center"><strong>DIS(%)</strong></td>
        <td align="center"><strong>DISCOUNT</strong></td>
        <td align="center"><strong>AMOUNT</strong></td>
        <td align="center"><strong>Action</strong></td>
      </tr>
      <tr>
        <td align="right"><input type="text" readonly="readonly" id="prodcode" name="prodcode" style="width:60px;"></td>
     	<td align="right"><input type="text" readonly="readonly" id="prodname" name="prodname"></td>
        <td align="right"><input type="text" readonly="readonly" id="uprice" name="uprice" style="width:70px;"></td>
        <td align="center"><input type="text" readonly="readonly" id="hprice" name="hprice" style="width:50px;"></td>
        <td align="center" bgcolor="#33CCFF"><input type="text" id="uquant" name="uquant" style="width:50px; background-color:#CF3;" tabindex="5"></td>
        <td align="center" bgcolor="#33CCFF"><input type="text" readonly="readonly" id="hquant" name="hquant" style="width:50px;"></td>
        <td align="right"><input type="text" readonly="readonly" id="ucharge" name="ucharge" style="width:100px;"></td>
        <td align="center" bgcolor="#33CCFF"><input type="text" id="udisper" name="udisper" value="0" style="width:50px; background-color:#CF3;" tabindex="6"></td>
        <td align="right"><input type="text" readonly="readonly" id="udisamount" name="udisamount" value="0" style="width:70px;"></td>
        <td align="right"><input type="text" readonly="readonly" id="ucharged" name="ucharged" style="width:100px;"></td>
        <td align="center"><input type="button" id="add" value="Add" onclick="addformvalidate();" style="width:40px; background-color:#CF3;" tabindex="8"></td>
      </tr>
      <tr>
      <td colspan="5" align="right">REMARKS:</td>
      <td colspan="6"><input type="text" id="remarks" name="remarks" style="width:300px; background-color:#6FF;" tabindex="7"></td>
      </tr>
    </table>
      </form>
       </div>
       <div><p><br /></p></div>
       <div id="mydata">
       <form id="kotfin" >
       <table id="myTableData" border="1" cellspacing="1" cellpadding="2" width="100%" bgcolor="#FFFFFF">
      <tr>
      <td colspan="12" height="40" align="center" bgcolor="#CCCCCC"><strong>Items List (OUT)
      <input type="hidden" id="loguser" name="loguser" value="<?php echo $loginusername; ?>">
      </strong></td>
      </tr>
      <tr>
          <td colspan="12" height="40" align="center" bgcolor="#33CCFF"><div>Choose option:</div>
   <div id="foodinfo"> 
   <table border="0" cellspacing="1" cellpadding="1" width="100%">
      <tr align="center">
        <td><input type="radio" id="billmytype1" name="billmytype" value="PARCEL" tabindex="9"/> PARCEL 
    <input type="radio" id="billmytype2" name="billmytype" value="TABLE" tabindex="10"/> TABLE
    <input type="radio" id="billmytype3" name="billmytype" value="ROOM" tabindex="11"/>ROOM
    <input type="hidden" id="theparcharge" name="theparcharge" value="<?php echo $compvarscparcel; ?>"></td>
    	<td>
                 <div id="urreason" style="display: none;">PARCEL CHARGE:
            <input type="text" id="reasonofi" name="reasonofi" style="display: none;  width:100px;" tabindex="12">
            </div>
            <div id="urreasons" style="display: none;">TABLE No.:
            <input type="text" id="reasonofii" name="reasonofii" style="display: none;  width:100px;" tabindex="12">
            </div>
             <div id="urreasonss" style="display: none;">ROOM No.:
            <input type="text" id="reasonofiii" name="reasonofiii" style="display: none;  width:100px;" tabindex="12">
            </div>
        </td>
        <td>Waiter Name:<select name="ordername" id="ordername" class="chosen-select" style="background-color:#CF3;" tabindex="13">
        <option value="DEFAULT">DEFAULT</option>
		             <?php echo $group_block;?>
        </select></td>
      </tr>
    </table>
    </div>
   
    </td>
      </tr>
       <tr>       
      <td colspan="5" bgcolor="#CCCCCC" align="center">Customer Name:<select name="mycustname" id="mycustname" class="chosen-select" style="background-color:#CF3;" tabindex="14">
        <option value="DEFAULT">DEFAULT</option>
		             <?php echo $group_blockcust;?>
        </select><br/><input type="text" id="custname" name="custname" style="background-color:#CF3;"></td>
      <td colspan="5" bgcolor="#CCCCCC">Address:<input type="text" id="addrees" name="addrees" style="background-color:#CF3; width:240px; height:30px;"></td>
      <td colspan="2" bgcolor="#CCCCCC">Phone No.:<input type="text" id="personphno" name="personphno" style="background-color:#CF3;"></td>
      </tr>
          <tr bgcolor="#CCCCCC">
          	<td align="center"><strong>Code</strong></td>
            <td align="center"><strong>ID</strong></td>
           	<td align="left"><strong>Item</strong></td>
       		<td align="right"><strong>F.Price</strong></td>
            <td align="right"><strong>H.Price</strong></td>
            <td align="center"><strong>F.Qnty</strong></td>
            <td align="center"><strong>H.Qnty</strong></td>
      		<td align="center"><strong>Charges</strong></td>
            <td align="center"><strong>DIS(%)</strong></td>
            <td align="center"><strong>DISCOUNT</strong></td>
            <td align="center"><strong>Charged</strong></td>
            <td align="center"><strong>Action</strong></td>
          </tr>
    </table>
    <table border="1" cellspacing="1" cellpadding="2" width="100%" bgcolor="#FFFFFF">
    <tr>
    <td colspan="11" align="right"><strong>Total No. of items</strong><input type="text" readonly="readonly" id="itemsnum" name="itemsnum" value="0"></td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td colspan="11" align="right" bgcolor="#33CCFF"><strong>Discount(%)</strong><input type="text" id="disper" name="disper" value="0" style="background-color:#CF3;" tabindex="15"></td>
    <td><input type="text" readonly="readonly" id="disamount" name="disamount" value="0" style="float:right;"></td>
    </tr>
    <tr bgcolor="#CCCCCC">
    
    <td colspan="12" align="right"><strong>GRAND TOTAL:</strong><input type="text" readonly="readonly" id="mykototali" name="mykototali" value="0"></td>
    
         </table>

     <input type="button" onclick="callkotjson();" value="GENERATE TOKEN" tabindex="16"></input>
    </form>
     </div>
    
        </p>
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
 <script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
</body>
</html>