<?php
include("../connect/connectdb.php");
include("check.php");
include("companyvars.php");
?>
<?php

$msg=null;
$query=null;
$tab_block=null;
$tabview=null;
$tabpay=null;
$tabupdate=null;
$tabdelete=null;
$myfrmnum=1;
$theparcelamount=null;
$query = mysql_query("SELECT DISTINCT(otype),kid FROM adifoodbill WHERE (status='Credit') AND (otype LIKE '%PARCEL%' OR otype LIKE '%TABLE%' OR otype LIKE '%ROOM%') GROUP BY otype");
while($r=mysql_fetch_array($query)) 
		{
		$service_cblock=null;
		$myotype=$r['otype'];
		//echo "SELECT count(*) as MYCOUNT FROM adikotnum WHERE (status='Processing') AND (otype='".$myotype."')";
		///////////////to check if any KOT NUM is in Process or if the delivery is not confirmed / Cancelled.////////
		$queryy = mysql_query("SELECT count(*) as MYCOUNT FROM adikotnum WHERE (status='Processing') AND (otype='".$myotype."')");	
			while($rr=mysql_fetch_array($queryy)) 
			{
					
					$mygocount=(int)$rr['MYCOUNT'];	
					//echo $mygocount;
			}
		if($mygocount>0)
		{
			$tab_block.='<table border="0" cellpadding="5" cellspacing="5" width="100%" bgcolor="#CCFF33">
			<tr bgcolor="#FFCCFF"><td><font style="background-color:yellow;">ORDER TYPE:&nbsp;</font>'.$myotype.'<font color="#FF0000">&nbsp;: KOT IS IN PROCESS...<img src="images/arrow.gif" width="18px" />..PLEASE CONFIRM DELIVERY OF KOT.<a href="restorderdelivery.php"><img src="images/arrow.gif" width="18px" />GO TO KOT DELIVERY<img src="images/clickhere.gif" width="15px" /></a></font>										</td></tr></table>'; 
			}
			else{
					$grandmoney=null;
					$grandparcel=null;
					$kotids="";
					$queryye = mysql_query("SELECT kid FROM adifoodbill WHERE otype='".$myotype."' AND status='Credit'");	
					while($rer=mysql_fetch_array($queryye)) 
					{

						$mynewkotnum=$rer['kid'];
						$kotids=$kotids.$mynewkotnum.",";
						$queryyy="SELECT SUM(ktotal) AS HELLO FROM adikotdet WHERE kid='$mynewkotnum' AND itemname NOT LIKE '%PARCEL%'";
						//echo $queryyy."<br />";
						//exit();
						$resultyyy = mysql_query($queryyy) or die(mysql_error());
						$rowy=mysql_fetch_array($resultyyy);
						$myktotalyyy=$rowy['HELLO'];
						/////////////////applying kot dis per starts/////////////////////////////
						$querytoy = "SELECT * FROM adikotnum WHERE id='".$mynewkotnum."'";
						$resultoy = mysql_query($querytoy) or die(mysql_error());
						while($roty=mysql_fetch_array($resultoy)) 
								{
									$kotadisper=$roty['totaldisper'];
								}
						if(!isset($kotadisper))
						{
							$kotadisper=0;
							}
							$kotadiamount=(float)(($myktotalyyy*$kotadisper)/100);
							$kottoalamountd=(float)($myktotalyyy-$kotadiamount);
												
						
						/////////////////applying kot dis per ends/////////////////////////////
						
						$grandmoney=$grandmoney+$kottoalamountd;
						$queryyy="SELECT SUM(ktotal) AS HELLOP FROM adikotdet WHERE kid='$mynewkotnum' AND itemname LIKE '%PARCEL%'";
						//echo $queryyy."<br />";
						//exit();
						$resultyyy = mysql_query($queryyy) or die(mysql_error());
						$rowy=mysql_fetch_array($resultyyy);
						$myparclamnt=$rowy['HELLOP'];
						$grandparcel=$grandparcel+$myparclamnt;
					}
				
		if (strpos($myotype,'PARCEL') !== false) {
			$service_cblock='<input type="text" readonly="readonly" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" id="sevper" name="sevper" style="width:60px;" value="0">';
			}
			else{
				$service_cblock='<input type="text" id="sevper" name="sevper" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" style="background-color:#3F6; width:60px;" value="'.$compvarssercharge.'">';
				}	
				if ((strpos($myotype,'PARCEL') !== false)||((int)$grandparcel>0)) {
			$theparcelamount=$compvarscparcel;
			}
			else{
				$theparcelamount="0.00";
				}	
				
				////////////////////////////////////////////////ordertyper ordertotal orderparcel
				///ordertotal orderparcel parceltaken tptotal disctyped disper discamount sevper stax vat gcount
		 $tab_block.='<form id="genbill'.$myfrmnum.'" action="restbillingme.php" method="post">
						<table border="0" cellpadding="5" cellspacing="5" width="100%" bgcolor="#CCFF33">
						<tr bgcolor="YELLOW">
						<td>
						ORDER:<input type="text" readonly="readonly" id="ordertyper" name="ordertyper" value="'.$myotype.'" style="width:90px;">
						KOT:<input type="text" readonly="readonly" id="kotids" name="kotids" value="'.$kotids.'" style="width:80px;">
						T.ORDERS:<input type="text" readonly="readonly" id="ordertotal" name="ordertotal" value="'.$grandmoney.'" style="width:60px;">
						P.ORDERS<input type="text" readonly="readonly" id="orderparcel" name="orderparcel" value="'.$grandparcel.'" style="width:60px;">		
						P.AMOUNT<input type="text" id="parceltaken" name="parceltaken" onchange="calculateForm(this.form)" value="'.$theparcelamount.'" style="background-color:#3F6; width:60px;">		T+P.AMOUNT<input type="text" readonly="readonly" id="tptotal" name="tptotal" value="'.(float)($grandmoney+$grandparcel+$theparcelamount).'" style="width:80px;">	<br/>
						DISCOUNT TYPE:<select name="disctyped" id="disctyped" style="background-color:#CF3;" onchange="disctypedfun(this.form)">
		            <option value="DEFAULT">DEFAULT</option>
					<option value="NORMAL">NORMAL</option>
					<option value="COUPON">COUPON</option>
        </select>
						
						<div id="urreason" style="display: none;">
						DISC(%):<input type="text" id="disper" name="disper" onchange="disctypedcalper(this.form)" onfocus="disctypedcalper(this.form)" onblur="disctypedcalper(this.form)" readonly="readonly" style="background-color:#3F6; width:60px;">	
						DISC.AMOUNT:<input type="text" id="discamount" name="discamount" onchange="disctypedcal(this.form)" onfocus="disctypedcal(this.form)" onblur="disctypedcal(this.form)" readonly="readonly" style="background-color:#3F6; width:60px;">	
						</div>
						
						
							
						S.Charge(%):'.$service_cblock.'	
						<input type="hidden" id="stax" name="stax" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" style="background-color:#3F6; width:60px;" value="'.$compvarscstaxper.'">
						<input type="hidden" id="vat" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" name="vat" style="background-color:#3F6; width:60px;" value="'.$compvarscvatper.'">
						
						<input type="hidden" id="sbtax" onchange="calculateForm(this.form)" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" name="sbtax" style="background-color:#3F6; width:60px;" value="'.$compvarscsbtaxper.'">
						
						G.TOTAL:<input type="text" readonly="readonly" id="gcount" name="gcount" onfocus="calculateForm(this.form)" onblur="calculateForm(this.form)" style="background-color:#FFF; width:60px;">			
						<input type="submit" onmouseover="calculateForm(this.form)" onclick="return(validategenForm(this.form));" value="GENERATE BILL '.$myotype.'">
						</td>
						  </tr></table></form><br/>'; 
						  $myfrmnum++;
				
				}
		
		
				
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE BILLING PAGE</title>
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
			disamntperamnt=parseFloat((disamntpers*distptotals)/100).toFixed(2);
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
	var xatno = oForm.elements["ordertyper"].value;
	//alert("HELLO2");
	//alert(oForm);
	var r = confirm("Are you sure to create Bill For "+xatno+" !");
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
		if((isNaN(billparceltaken))||(isNaN(billdisper))||(isNaN(billdiscamount))||(isNaN(billsevper))||(isNaN(billgcount))||(billgcount<0)||(billgcount==null))
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
    <h2>BILLING PANEL<a href="restbillingmain.php"><img src="images/back.png" style="float:right"></a></h2>
      <p align="center">
  <table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#FFFFFF">
  <tr>
    <td><?php
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
  </table>
  <?php
  if(isset($tab_block))
  {
	  echo $tab_block;
	  }
  ?>

      </p>
<br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
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