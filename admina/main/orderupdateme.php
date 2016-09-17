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
					$mykktotal=$r['myktotal'];
					$mygtotal=(($mygtotal+(int)$mykktotal));
					$tab_blockk.='<tr>
									<td>'.$mysno.'</td>
									<td>'.$myicode.'</td>
									<td>'.$myitemname.'</td>
									 <td>'.$myuiprice.'</td>
									 <td>'.$myuiquan.'</td>
									  <td>'.$myktotal.'</td>
									  <td><input type="button" value = "Delete" onClick="Javacsript:deleteRoww(this,'.$mykdetid.')"></td>
								</tr>';
					$mysno++;
					}
		}

?>
<?php
$tab_block=null;
$query = mysql_query("SELECT icode,itemname FROM adiitems");
while($r=mysql_fetch_array($query)) 
		{
		$tabicode=$r['icode'];
		$tabitemname=preg_replace('/[^A-Za-z0-9\-]/',' ',$r['itemname']);			
		$tab_block.='<option value="'.$tabicode.'">'.$tabitemname.'</option>';
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
$(function() {
 $("#ucode").bind("change", function() {
     $.ajax({
         type: "GET", 
         url: "placemyitems.php",
         data: "mappno="+$("#ucode").val(),		 		
         success: function(msg) {
			 //alert("Hello");
			 document.getElementById("uprice").value= msg;
			 document.getElementById("uquant").value="";
			 document.getElementById("ucharge").value="";
                             	}
           });
       }); 
});
</script>
 <script>
	$(function() {		
		jQuery('#uquant').on('input propertychange paste', function() {
		var unchrg = parseFloat((document.getElementById("uprice").value));
		unchrg=unchrg.toFixed(2);
		var unquan = parseFloat((document.getElementById("uquant").value));
		unquan=unquan.toFixed(2);
		//alert(unquan);
		//alert(chtotal);
		var myamnt=((unchrg*unquan));
		myamnt=myamnt.toFixed(2);
		document.getElementById("ucharge").value=myamnt;	
		});
		
		
	});
	</script> 
 
	 <script type="text/javascript">
	 
var counterText = 0;
var mygtchrg=0;
function addRow() {
	var noofprerow = 0;
	$('#myTableDataa tr').each(function(row, tr){
           noofprerow++;
		});  
		var counterText=(noofprerow+1);
		//alert(counterText);	
	var z=document.getElementById("ucode");
  var za=z.options[z.selectedIndex].text;
	
	var myliucode=document.getElementById("ucode").value; 
	 var myliuprice=document.getElementById("uprice").value;
	 var myliuquant=document.getElementById("uquant").value;
	 var liucharge=document.getElementById("ucharge").value;
	
       //alert(counterText+myliucode+myliuprice+myliuquant+liucharge);
	 
    var table = document.getElementById("myTableData"); 
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount); 
	row.insertCell(0).innerHTML= counterText;
	row.insertCell(1).innerHTML= myliucode;
    row.insertCell(2).innerHTML= za;
    row.insertCell(3).innerHTML= myliuprice;
    row.insertCell(4).innerHTML= myliuquant;
	row.insertCell(5).innerHTML= liucharge;
    row.insertCell(6).innerHTML= '<input type="button" value = "Delete" onClick="Javacsript:deleteRow(this)">';
	counterText++;
	mygtchrg=(mygtchrg+liucharge);
	document.getElementById("mykototal")=mygtchrg;
}
 
function deleteRow(obj) {
      
    var index = obj.parentNode.parentNode.rowIndex;
    var table = document.getElementById("myTableData");
    table.deleteRow(index);
    
}
function deleteRoww(obj,rowdelid) {	
    var  mydelidd=rowdelid;
			$.ajax({
			type: "GET",
			url: "delitem.php",
			data: "itemdelid="+mydelidd,
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
<script type="text/javascript">
<!--
// Form validation code will come here.
function addformvalidate()
{
 var x=document.forms["addroom"]["ucode"].value;
 var y=document.forms["addroom"]["uquant"].value;
      	 if(x==null || x=="" || x=="DEFAULT")
{
	alert("Please Select an Item!");
	document.forms["addroom"].elements["ucode"].focus();
  	return false;
}
 	 if(y==null || y=="" || y=="0")
{
	alert("Please enter the Quantity!");
	document.forms["addroom"].elements["uquant"].focus();
  	return false;
}
//document.forms["addroom"]["formval"].value="YES";
addRow();
}
//-->
</script>
<script src="../json/jquery.json-2.4.min.js"></script>
<script type="text/javascript">
<!--
function callkotjson()
{
var mywaiter=document.forms["kotfinn"]["waitname"].value;
//alert(mywaiter);
if(mywaiter==""||mywaiter==null)
{
	alert("Please fill-in Waiter's Name!");
	document.forms["kotfinn"].elements["waitname"].focus();
	return false;
}
else{
	
	var TableData=null;
	TableData = storeTblValues()
	//alert(TableData);
	//exit();
	TableData = $.toJSON(TableData);
	//alert(TableData);
	//exit();
	kotsending(TableData);
	//window.open('orderplace.php','self');
	
	//header("Location: orderplace.php");
	//alert(mymsg);
	}
}
//-->
</script>
<script type="text/javascript">
function storeTblValues()
{
   
	 var TableData = new Array();
		//alert(noofmyrow);
		//exit();
    $('#myTableData tr').each(function(row, tr){
        TableData[row]={
            "itemCode" : $(tr).find('td:eq(1)').text()
            , "itemName" :$(tr).find('td:eq(2)').text()
            , "itemUprice" : $(tr).find('td:eq(3)').text()
            , "itemQuan" : $(tr).find('td:eq(4)').text()
			, "itemCharg" : $(tr).find('td:eq(5)').text()
        }    
    }); 
	
	return TableData;
}
</script>
<script type="text/javascript">
<!--
// Form validation code will come here.
function kotsending(TableData)
{
	//////THIS ALERTS DATA THAT IS TO BE SEND////////////////////alert(TableData);
	var jskotid=document.forms["kotfinn"]["myykotid"].value;
 $.ajax({
    type: "GET",
    url: "createupdkot.php",
    data: "pTableData="+TableData+"&kotnm="+jskotid,
    success: function(msg){
		//alert(msg);
		//return msg;
		window.open('kotprintable.php?tkval='+msg,'popup','scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0');
		window.location.replace("orderview.php");
		// return value stored in msg variable
    }
});
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
    <h2>UPDATE AN ORDER TYPE :<?php echo " ".$myotype;?><a href="orderview.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
      <div id="myform">      
      <form id="addroom">
      <table border="1" cellspacing="1" cellpadding="1" width="100%">
      <td colspan="5" height="40" align="center" bgcolor="#CCCCCC"><strong>Items of Menu</strong></td>
     <tr>     
        <td align="center"><strong>Item Name</strong></td>
        <td align="right"><strong>Unit Price</strong></td>
        <td align="right"><strong>Quantity</strong></td>
        <td align="right"><strong>Charge</strong></td>
        <td align="center"><strong>Action</strong></td>
      </tr>
      <tr>
      <td align="center">
        <select name="ucode" id="ucode">
        <option value="DEFAULT">DEFAULT</option>
		<?php echo $tab_block; ?>
        </select>
        </td>
        <td align="right"><input type="text" readonly="readonly" id="uprice" name="uprice"></td>
        <td align="right"><input type="text" id="uquant" name="uquant"></td>
        <td align="right"><input type="text" readonly="readonly" id="ucharge" name="ucharge"></td>
        <td align="center"><input type="button" id="add" value="Add" onclick="addformvalidate();"></td>
      </tr>
    </table>
      </form>
       </div>
       <div><p><br /></p></div>
      
       <form id="kotfinn" >
       <table id="myTableDataa" border="1" cellspacing="1" cellpadding="2" width="100%">
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
      <div id="mydata">
    <form id="kotfin" >
       <table id="myTableData" border="1" cellspacing="1" cellpadding="2" width="100%">
       </table>
   
    <table id="grandtol" border="1" cellspacing="1" cellpadding="2" width="100%">
    <tr bgcolor="#CCCCCC">
            <td align="right" colspan="5"><strong>GRAND TOTAL:</strong></td>
            <td align="right"><strong><?php echo number_format($mygtotal,2);?></strong></td>
          </tr>
    </table>
     <input type="button" onclick="callkotjson();" value="UPDATE TOKEN"></input>  
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
</body>
</html>