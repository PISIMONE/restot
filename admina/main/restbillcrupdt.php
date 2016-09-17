<?php
include("../connect/connectdb.php");
include("check.php");
include("companyvars.php");
/*if($login_session!="admin")
{
	header("Location: restviewbill.php");
	exit();
	}*/
?>
<?php 
if(isset($_POST['mybillid']))
{
	$myomybillid=($_POST['mybillid']);
	}
	else{
		header("Location: restviewbill.php");
		exit();
		}
if(isset($_POST['mybid']))
{
	$mybillnum=($_POST['mybid']);
	}
	else{
		header("Location: restviewbill.php");
		exit();
		}
if(isset($_POST['mybstatus']))
{
	$mybillstatus=($_POST['mybstatus']);
	}
	else{
		header("Location: restviewbill.php");
		exit();
		}
if(isset($_POST['mybdt']))
{
	$mybillodate=($_POST['mybdt']);
	}
	else{
		header("Location: restviewbill.php");
		exit();
		}
$isbilledstatus=null;
$bquery=mysql_query("SELECT * FROM adirestbill WHERE id='$myomybillid' AND billnum='$mybillnum' AND billdate LIKE '%$mybillodate%'");
$roy=mysql_fetch_array($bquery); 
$isbilledstatus=$roy['status'];	
if($isbilledstatus!="Credit"){
	header("Location: restviewbill.php");
	}
if(($mybillnum!=null)&&($mybillodate!=null)&&($myomybillid!=null))	
{	
	$bquery=mysql_query("SELECT * FROM adirestbill WHERE id='$myomybillid' AND billnum='$mybillnum' AND billdate LIKE '%$mybillodate%'");
	$roy=mysql_fetch_array($bquery); 
	
	//////fbid, billnum, billtype, txnum, cncmix, otype, disctype, discount, discamnt, foodbilltotal, parcelbilltotal, parcelcharge, ordpartotal, servcharge, stax, vat, gtotal, gpaid, gdues, billdate, status
	$newformatdate = null;	
	$mykid=$roy['id'];
	$myfidb=$roy['fbid'];
	$myobillnum=$roy['billnum'];
	$myobilltype=$roy['billtype'];
	$myocncmix=$roy['cncmix'];
	$myootype=$roy['otype'];
	$myodisctype=$roy['disctype'];
	$myodiscount=$roy['discount'];
	$myodiscamnt=$roy['discamnt'];
	$myofoodbilltotal=$roy['foodbilltotal'];
	$myorderparcel=$roy['parcelbilltotal'];
	$myparceltaken=$roy['parcelcharge'];
	$myordpartotal=(float)($myofoodbilltotal+$myorderparcel);
	$mysevper=$roy['servcharge'];
	$myostax=$roy['stax'];
	$myovat=$roy['vat'];
	///swachh bharat tax 
	$myosbtax=$roy['sbtax'];
	
	$myogtotal=$roy['gtotal'];
	$myogpaid=$roy['gpaid'];
	$myogdues=$roy['gdues'];
	$myobilldate=$roy['billdate'];
	$newformatdate = date_create($myobilldate);
	$newformatdate = (string)(date_format($newformatdate, 'Y-m-d'));
	$myostatus=$roy['status'];		
	
}
else{
		header("Location: restviewbill.php");
		exit();
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE CREDIT BILL UPDATE PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
/////////////////////////////////////////////////
	  function disctypedfun(el) {
	   //disctyped disper discamount
	   var distypeform = el;  
	   var undisctype =  ($(distypeform).find("#disctyped").val());
		alert(undisctype);
		if(undisctype=="NORMAL")
		{
			$(distypeform).find("#urreason").show();
			$(distypeform).find("#disper").val(0);
			$(distypeform).find("#discamount").val(0);
			  $(distypeform).find("#disper").attr("readonly", false); 
			  $(distypeform).find("#disper").css('background-color' , '#3F6');
			    $(distypeform).find("#discamount").attr("readonly", true); 
				$(distypeform).find("#discamount").css('background-color' , '#FFFFFF');
			
			}
		else if(undisctype=="COUPON")
		{
			$(distypeform).find("#urreason").show();
			$(distypeform).find("#disper").val(0);
			$(distypeform).find("#discamount").val(0);
			  $(distypeform).find("#disper").attr("readonly", true); 
			  $(distypeform).find("#disper").css('background-color' , '#FFFFFF');
			    $(distypeform).find("#discamount").attr("readonly", false); 
				$(distypeform).find("#discamount").css('background-color' , '#3F6');
			
			}
			else
			{
			$(distypeform).find("#disper").val(0);
			$(distypeform).find("#discamount").val(0);
			$(distypeform).find("#urreason").hide();
			}
		calculateForm(distypeform);
		//////////////////////////////////////
	   }
	   
	   
 function disctypedcal(elp){
	 ////tptotal //disctyped disper discamount
			 var distypeamnt = elp;  
		  var distptotal=parseFloat($(distypeamnt).find("#tptotal").val());
		   var disamntchrg=parseFloat($(distypeamnt).find("#discamount").val());
		   if((isNaN(distptotal))||isNaN(disamntchrg)){
			   alert("Please fill in a valid input for Discount Amount!")
			   $(distypeamnt).find("#disper").val(0);
			   $(distypeamnt).find("#discamount").val(0);
			   exit();
			   }
		    var disamntper=null;
			disamntper=(parseFloat((disamntchrg*100)/distptotal)).toFixed(2);
			$(distypeamnt).find("#disper").val(disamntper);
		   	calculateForm(distypeamnt);
	   }
	   
function disctypedcalper(elpr){
	 ////tptotal //disctyped disper discamount
			 var distypeamnts = elpr;  
		  var distptotals=parseFloat($(distypeamnts).find("#tptotal").val());
		   var disamntpers=parseFloat($(distypeamnts).find("#disper").val());
		   if((isNaN(distptotals))||isNaN(disamntpers)){
			   alert("Please fill in a valid input for Discount Amount!")
			   $(distypeamnts).find("#disper").val(0);
			   $(distypeamnts).find("#discamount").val(0);
			   exit();
			   }
		    var disamntperamnt=null;
			disamntperamnt=(parseFloat((disamntpers*distptotals)/100)).toFixed(2);
			$(distypeamnts).find("#discamount").val(disamntperamnt);
		   	calculateForm(distypeamnts);
	   }

</script>
<script type="text/javascript">
 function calculateForm(empo) {
	 ///ordertyper ordertotal orderparcel
	 ///ordertotal orderparcel parceltaken tptotal disctyped disper discamount sevper stax vat gcount
	 var myform = empo;
	 //alert("Hello!");	
	////tptotal //disctyped disper discamount
	    var ga =  ($(myform).find("#ordertotal").val());
		 //alert(ga);			
		var pa = ($(myform).find("#orderparcel").val());
		if(pa==null || pa=="" || pa=="NaN"){pa=0;}
		 //alert(pa);	
		
		var pac = ($(myform).find("#parceltaken").val());
		if(pac==null || pac=="" || pac=="NaN"){pac=0;}
		 //alert(pa);	
		 
		 var xzy = ($(myform).find("#sevper").val());
		if(xzy==null || xzy=="" || xzy=="NaN"){xzy=0;}
		 
		 
	 	var x = ($(myform).find("#stax").val());
		if(x==null || x=="" || x=="NaN"){x=0;}
		 //alert(x);	
		var y = ($(myform).find("#vat").val());
		if(y==null || y=="" || y=="NaN"){y=0;}
		// alert(y);	
		
		var ysbt = ($(myform).find("#sbtax").val());
		if(ysbt==null || ysbt=="" || ysbt=="NaN"){ysbt=0;}
		// alert(ysbt);
		
		var z = ($(myform).find("#disper").val());
		if(z==null || z=="" || z=="NaN"){z=0;}
		
		var zf = ($(myform).find("#discamount").val());
		if(zf==null || zf=="" || zf=="NaN")
		{
			zf=0;
			}
			else{
				zf=parseFloat(zf); ///discount manually
				}
			
		ga=parseFloat(ga); //ordertotal
		pa=parseFloat(pa); //orderparcel
		pac=parseFloat(pac);//parceltaken
		// z is discount %
		gapa=parseFloat(ga+pa);
		var da=parseFloat((gapa*z)/100); 
		
		var gaa=gapa-(parseFloat(da)); //gaa is grand total after discount amount
		
		// x is service TAX %
		var a=parseFloat((gaa*x)/100); 
		//
		// alert(a);	
		// b is VAT %
		var b=parseFloat((gaa*y)/100);
		// alert(b);
		
		//this is swachh bharat tax
		var bsb=parseFloat((gaa*ysbt)/100);
		// alert(bsb);	
		
		// c is service charge %
		var c=parseFloat((gaa*xzy)/100);
		// alert(c);	
		
		//alert(gaa);
		//alert(a);
		//alert(b);
		//alert(c);
		//alert(pac);
		//alert(pa);
		var gcounto=Math.round((parseFloat(gaa+a+b+bsb+c+pac)*100))/100;
		
		myform.elements["gcount"].value=gcounto;
		//alert(parseFloat(gaa+a+b+c+pac+pa));
		//alert((ga+a+b));
		//alert("Hello!")  ;			
		}
 </script>  
<script type="text/javascript">
	function validategenForm(oForm) {	
	//parceltaken disctyped disper discamount sevper gcount
	var xatno = oForm.elements["thebillnum"].value;
	//alert("HELLO2");
	//alert(oForm);
	var r = confirm("Are you sure to update Bill No."+xatno+" !");
		if (r)
		 {
			  ///ordertotal orderparcel parceltaken tptotal disctyped disper discamount sevper stax vat gcount
			  var billparceltaken = parseFloat(oForm.elements["parceltaken"].value);
			   var billdisctyped = oForm.elements["disctyped"].value;
			   if(billdisctyped!="DEFAULT")
			   {
			    var billdisper = parseFloat(oForm.elements["disper"].value);
				var billdiscamount = parseFloat(oForm.elements["discamount"].value);
			   }
			   else{
				   var billdisper = 0;
				   var billdiscamount = 0;
				   }
				var billsevper = parseFloat(oForm.elements["sevper"].value);
				var billgcount = parseFloat(oForm.elements["gcount"].value);
		if((isNaN(billparceltaken))||(isNaN(billdisper))||(isNaN(billdiscamount))||(isNaN(billsevper))||(isNaN(billgcount))||(billgcount<0))
				{
					alert("Something wrong with the input values, Please correct it!");
					 return false;
					}
			  
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
    <h2>CREDIT BILL UPDATE DISCOUNT PANEL<a href="restviewbill.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
                       <form id="genbill1" action="restbillcrupdate.php" method="post">
						<table border="0" cellpadding="5" cellspacing="5" width="100%" bgcolor="#CCFF33">
						<tbody><tr bgcolor="YELLOW">
						<td><input type="hidden" id="thebillid" name="thebillid" value="<?php echo $mykid; ?>" >
                        <input type="hidden" id="thebilldt" name="thebilldt" value="<?php echo $newformatdate; ?>" >
						BILL NO.:<input type="text" readonly="readonly" id="thebillnum" name="thebillnum" value="<?php echo $myobillnum; ?>" style="width:90px;"><br/>
						KOT:<input type="text" readonly="readonly" id="kotids" name="kotids" value="<?php echo $myfidb; ?>" style="width:80px;"><br/>
						T.ORDERS:<input type="text" readonly="readonly" id="ordertotal" name="ordertotal" value="<?php echo $myofoodbilltotal; ?>" style="width:60px;"><br/>
						P.ORDERS<input type="text" readonly="readonly" id="orderparcel" name="orderparcel" value="<?php echo $myorderparcel; ?>" style="width:60px;"><br/>	
						P.AMOUNT<input type="text" id="parceltaken" name="parceltaken" onchange="calculateForm(this.form)" value="<?php echo $myparceltaken; ?>" style="background-color:#3F6; width:60px;"><br/>
                        T+P.AMOUNT<input type="text" readonly="readonly" id="tptotal" name="tptotal" value="<?php echo $myordpartotal; ?>" style="width:80px;"><br>
						DISCOUNT TYPE:<select name="disctyped" id="disctyped" style="background-color:#CF3;" onchange="disctypedfun(this.form)">
		            <option value="DEFAULT">DEFAULT</option>
					<option value="NORMAL">NORMAL</option>
					<option value="COUPON">COUPON</option>
        </select>
						
						<div id="urreason" style="display: none;">
						DISC(%):<input type="text" id="disper" name="disper" onchange="disctypedcalper(this.form)" onfocus="disctypedcalper(this.form)" onblur="disctypedcalper(this.form)" readonly="readonly" style="background-color:#3F6; width:60px;">	
						DISC.AMOUNT:<input type="text" id="discamount" name="discamount" onchange="disctypedcal(this.form)" onfocus="disctypedcal(this.form)" onblur="disctypedcal(this.form)" readonly="readonly" style="background-color:#3F6; width:60px;">	
						</div>
						
						
							
						S.Charge(%):<input type="text" id="sevper" name="sevper" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" style="background-color:#3F6; width:60px;" value="<?php echo $mysevper; ?>">	
						<input type="hidden" id="stax" name="stax" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" style="background-color:#3F6; width:60px;" value="<?php echo $myostax; ?>">
						<input type="hidden" id="vat" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" name="vat" style="background-color:#3F6; width:60px;" value="<?php echo $myovat; ?>">
                        <input type="hidden" id="sbtax" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" name="sbtax" style="background-color:#3F6; width:60px;" value="<?php echo $myosbtax; ?>">
						G.TOTAL:<input type="text" readonly="readonly" id="gcount" name="gcount" style="background-color:#FFF; width:60px;" value="<?php echo $myogtotal; ?>">			
						<input type="submit" onclick="return(validategenForm(this.form));" value="UPDATE IT">
						</td>
						  </tr></tbody></table></form>
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