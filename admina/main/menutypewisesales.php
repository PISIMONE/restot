<?php
include("../connect/connectdb.php");
include("check.php");
date_default_timezone_set('Asia/Calcutta');
$mytodaydatem = (string)date("Y-m-d H:i:s");
$sql=null;
$query =null;
$group_menu=null;
$query = mysql_query("SELECT DISTINCT(menutype) FROM adiitems ORDER BY menutype ASC");
while($r=mysql_fetch_array($query)) 
		{
		if(($r['menutype']!="")||($r['menutype']!=null))
		$group_menu.='<option value="'.$r['menutype'].'">'.$r['menutype'].'</option>';
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE MENUTYPE-WISE SALES REPORT PAGE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<link rel="stylesheet" href="../combojs/jquery-ui.css">
<script src="../combojs/jquery-1.10.2.js"></script>
<script src="../combojs/jquery-ui.js"></script>
<style>
.custom-combobox {
position: relative;
display: inline-block;
}
.custom-combobox-toggle {
position: absolute;
top: 0;
bottom: 0;
margin-left: -1px;
padding: 0;
/* support: IE7 */
*height: 1.7em;
*top: 0.1em;
}
.custom-combobox-input {
margin: 0;
padding: 0.3em;
}
</style>
<script>
(function( $ ) {
$.widget( "custom.combobox", {
_create: function() {
this.wrapper = $( "<span>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );
this.element.hide();
this._createAutocomplete();
this._createShowAllButton();
},
_createAutocomplete: function() {
var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";
this.input = $( "<input>" )
.appendTo( this.wrapper )
.val( value )
.attr( "title", "" )
.attr( "id", "hollowman" )
.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
.autocomplete({
delay: 0,
minLength: 0,
source: $.proxy( this, "_source" )
})
.tooltip({
tooltipClass: "ui-state-highlight"
});
this._on( this.input, {
autocompleteselect: function( event, ui ) {
ui.item.option.selected = true;
this._trigger( "select", event, {
item: ui.item.option
});
},
autocompletechange: "_removeIfInvalid"
});
},
_createShowAllButton: function() {
var input = this.input,
wasOpen = false;
$( "<a>" )
.attr( "tabIndex", -1 )
.attr( "title", "Show All Items" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.addClass( "custom-combobox-toggle ui-corner-right" )
.mousedown(function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.click(function() {
input.focus();
// Close if already visible
if ( wasOpen ) {
return;
}
// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},
_source: function( request, response ) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
var text = $( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
label: text,
value: text,
option: this
};
}) );
},
_removeIfInvalid: function( event, ui ) {
// Selected an item, nothing to do
if ( ui.item ) {
return;
}
// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;
this.element.children( "option" ).each(function() {
if ( $( this ).text().toLowerCase() === valueLowerCase ) {
this.selected = valid = true;
return false;
}
});
// Found a match, nothing to do
if ( valid ) {
return;
}
// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " didn't match any item" )
.tooltip( "open" );
this.element.val( "" );
this._delay(function() {
this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.autocomplete( "instance" ).term = "";
},
_destroy: function() {
this.wrapper.remove();
this.element.show();
}
});
})( jQuery );
$(function() {
$( "#myitemtype" ).combobox(
////////////////////////////////////////////////////////////////////////////////
		{
					select: function (event, ui) { 
					//alert("Hello");
					var adepart = ui.item.value;/*Whatever you have chosen of this combo box*/
					
					var abilltype=$("#billtype").val();
					 var abillstatusm=$("#billstatus").val();
					
					 var afromd=$("#fromd").val();
					
					 var atod=$("#tod").val();
					 //alert(lilname);
					
					  if(adepart=="DEFAULT")
					  {
						   $("#myledgers").html('<div>&nbsp;</div>');
						  }
					else
					 {//////////else not default starts/////////////
						  //alert(adepart);
					 /////////////RESTAURANT STARTS////////////////////
					 $.ajax({
						 type: "GET", 
						 url: "findrestmenutypewise.php",
						 data: { 
								 maitem:adepart,
								 mabilltype:abilltype,
								 mabillus:abillstatusm,
								 mafromd:afromd,
								 matod:atod
								 },		 		
						 success: function(html) {
							//alert("Hello");
							 $("#myledgers").html(html);
												 }
						   });
						 /////////////RESTAURANT ENDS//////////////////// 
						
						
					 }//////////else not default ends/////////////
	
	
	
	
					}
		}
////////////////////////////////////////////////////////////////////////////////
							);
$( "#toggle" ).click(function() {
$( "#myitemtype" ).toggle();
});
});
</script>

<script>
   $(function() {
    $( "#fromd" ).datepicker({
		dateFormat: 'yy-mm-dd',
      });
    });	
	 $(function() {
    $( "#tod" ).datepicker({
		dateFormat: 'yy-mm-dd',
      });
    });	
    </script>
   <script type="text/javascript">
$(function() {
	 //////////////////searcht fromd tod
	 $('#billtype, #billstatus, #fromd, #tod').bind('change', function() {
	var adepart=$("#myitemtype").val();
	// alert(adepart);
	 var abilltype=$("#billtype").val();
	 var abillstatusm=$("#billstatus").val();
	 var afromd=$("#fromd").val();
	 var atod=$("#tod").val();
	 //alert(lilname);
	  if(adepart=="DEFAULT")
	  {
		   $("#myledgers").html('<div>&nbsp;</div>');
		  }
	else
	 {//////////else not default starts/////////////
		
	 /////////////RESTAURANT STARTS////////////////////
     $.ajax({
         type: "GET", 
         url: "findrestmenutypewise.php",
         data: { 
		 		 maitem:adepart,
		 		 mabilltype:abilltype,
				 mabillus:abillstatusm,
				 mafromd:afromd,
				 matod:atod
				 },		 		
         success: function(html) {
			//alert("Hello");
             $("#myledgers").html(html);
			                     }
           });
		 /////////////RESTAURANT ENDS//////////////////// 
		
        
	 }//////////else not default ends/////////////
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
      <p align="center"><h2>MENUTYPE-WISE SALES REPORT DASHBOARD</h2>
     <table border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFCC" width="100%">
      <tr align="center">
    <td colspan="10"><font color="#CC3333" size="+1">Today's Date:&nbsp;<?php echo $mytodaydatem ?></font></td>    
    </tr>
  <tr align="center">
    <td colspan="10"><font color="#00CC33" size="+1">SEARCH REPORT BETWEEN DATES</font></td>    
  </tr>
  <tr>
  <td>FROM DATE:</td>
  <td><input type="text" id="fromd" name="fromd"></td>
  <td>TO DATE:</td>
  <td><input type="text" id="tod" name="tod"></td>
  <td>BILL TYPE:</td>
    <td><select name="billtype" id="billtype">
        <option value="ALL">ALL</option>
	    <option value="NC">NC</option>
        <option value="C">C</option>
        </select></td>
  <td>BILL STATUS:</td>
    <td><select name="billstatus" id="billstatus">
        <option value="ALL">ALL</option>
		<option value="Confirm">CONFIRM</option>
        <option value="Credit">CREDIT</option>
        <option value="Cancelled">CANCELLED</option>
        </select></td>
  <td>MENU TYPE:</td>
    <td width="250px"><select name="myitemtype" id="myitemtype">
        <option value="DEFAULT">DEFAULT</option>
       <?php echo $group_menu;?>
        </select></td>
  </tr>
   
  </table>
  <div><br/></div>
 <div id="myledgers">  &nbsp;
 </div>

 
      </p>
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      
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