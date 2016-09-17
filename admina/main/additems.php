<?php
include("../connect/connectdb.php");
include("check.php");
if(isset($_GET['mymsg'])){
	$msg=($_GET['mymsg']);
	}
	else{
		$msg=null;
		}
$sql=null;
$query =null;
$group_block=null;
$group_menu=null;
$query = mysql_query("SELECT DISTINCT(itemgroup) FROM adiitems ORDER BY itemgroup ASC");
while($r=mysql_fetch_array($query)) 
		{
		$group_block.='<option value="'.$r['itemgroup'].'">'.$r['itemgroup'].'</option>';
		}
$query = mysql_query("SELECT DISTINCT(menutype) FROM adiitems ORDER BY menutype ASC");
while($rum=mysql_fetch_array($query)) 
		{
			if(($rum['menutype']!=null)||($rum['menutype']!="")){
			$group_menu.='<option value="'.$rum['menutype'].'">'.$rum['menutype'].'</option>';
			}
		}

?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$msg=null;
$sql=null;
$mynewmenu=strtoupper(addslashes(trim($_POST['newmenu'])));
$myitemcode=strtoupper(addslashes(trim($_POST['itemfcode'])));
$myitemname=addslashes($_POST['itemfname']);
$myitemname=ucwords(strtolower($myitemname));
$myitemtype=addslashes($_POST['itemftype']);
if($myitemtype=="NON-VEG" )
{
	$myitemtypenveg=strtoupper(addslashes($_POST['nvegtype']));
	}
	else{
		$myitemtypenveg="";
		}
$myitemgroup=addslashes($_POST['itemfgroup']);
if($myitemgroup==null || $myitemgroup=="DEFAULT" || $myitemgroup=="" )
{
	$myitemgroup=addslashes($_POST['newgroup']);
	}
$myitemgroup=ucwords(strtolower($myitemgroup));
$myfullrate=addslashes($_POST['fullfrate']);
$myhalfrate=addslashes($_POST['halffrate']);
if($myhalfrate==""||$myhalfrate==null)
{
	$myhalfrate="0";
	}
$sql = "INSERT INTO adiitems(icode, itemname, menutype, itemtype, nvegtype, itemgroup, halfrate, fullrate) VALUE('$myitemcode', '$myitemname', '$mynewmenu', '$myitemtype', '$myitemtypenveg', '$myitemgroup', $myhalfrate, $myfullrate)";
$result = mysql_query($sql);																		
$count=null;																		
$count=mysql_affected_rows();																		
$count=(int)$count;
	if ($count==1)																								    
	{					
	$msg="Item Sucessfully Added.<br />"; //.$sql;
	}
	else
	{
	$msg="Adding the Item failed!.";
	}	
	header("Location: additems.php?mymsg=$msg");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE ADD ITEMS PAGE</title>
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
$( "#itemfgroup" ).combobox();
$( "#toggle" ).click(function() {
$( "#itemfgroup" ).toggle();
});
});
</script>
<script type="text/javascript">
$(function() {
 $("#itemmenutype").bind("change", function() {
     var mymunutype=$("#itemmenutype").val();	
	 if(mymunutype=="DEFAULT"){ 		
	 document.getElementById("newmenu").value= null;
	 }
	 else{
		 document.getElementById("newmenu").value= mymunutype;
		 }
       }); 
	   ////////////////////////////////////////
	    $("#itemftype").bind("change", function() {
     var myftype=$("#itemftype").val();	
	 if((myftype=="DEFAULT")||(myftype=="")||(myftype==null)){ 		
	 document.getElementById("nvegtype").value= null;
	  $("#nvegtype").hide(); 
	 }
	 else if(myftype=="NON-VEG"){
		   $("#nvegtype").show(); 
		 }
		 else{
			 document.getElementById("nvegtype").value= null;
			 $("#nvegtype").hide(); 
			 }
       }); 
});
</script>
<script type="text/javascript">
<!--
// Form validation code will come here.
function addformvalidate()
{
	 var xum=document.forms["additems"]["newmenu"].value;
 var x=document.forms["additems"]["itemfcode"].value;
  var y=document.forms["additems"]["itemfname"].value;
   var z=document.forms["additems"]["itemftype"].value;
  var xa=$('#hollowman').val();
   var xam=document.forms["additems"]["newgroup"].value;
  var ya=document.forms["additems"]["fullfrate"].value;
     if(xum==null || xum=="")
{
	alert("Please provide MENU TYPE of Item!");
	document.forms["additems"].elements["itemmenutype"].focus();
  	return false;
}
 if(xa==null || xa=="DEFAULT" || xa=="")
{
			if(xam=="" || xam==null)
		{
			alert("Please provide Item Group!");
			document.forms["additems"].elements["newgroup"].focus();
			return false;
			}
  	
}else{
	document.getElementById("newgroup").value=null;
	}
	
	 if(z==null || z=="DEFAULT")
{
	alert("Please select the Item Type!");
	document.forms["additems"].elements["itemftype"].focus();
  	return false;
}
 if(z=="NON-VEG")
{
	var zxm=document.forms["additems"]["nvegtype"].value;
		if(zxm==""||zxm==null)
	{
		alert("Please provide the Non-Veg Type i.e. Chicken / Fish / Mutton!");
		document.forms["additems"].elements["nvegtype"].focus();
		return false;
	}
}

 if(y==null || y=="")
{
	alert("Please provide Item Name!");
	document.forms["additems"].elements["itemfname"].focus();
  	return false;
}	
if(ya==null || ya=="")
{
	alert("Please provide Full Plate Rate!");
	document.forms["additems"].elements["fullfrate"].focus();
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
      <p align="center"><h2>ADD ITEMS PANEL</h2>
      <form id="additems" onsubmit="return(addformvalidate());" action="" method="post">
       <table border="0" cellpadding="5" cellspacing="15">
  <tr>
    <td colspan="4"><?php
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

    <tr>
    <td>MENU TYPE :</td>
    <td><select name="itemmenutype" id="itemmenutype">
    <option value="DEFAULT">DEFAULT</option>
   				<?php echo $group_menu;?>
       </select></td>
    <td><font color="#0000FF" size="-1">NEW MENU TYPE:</font></td>
    <td><input type="text" id="newmenu" name="newmenu" placeholder="New Menu Type Name" ></td>  
  </tr>
  <tr>
    <td colspan="2">ITEM GROUP :&nbsp;<select name="itemfgroup" id="itemfgroup" class="smallInput" style="width: 90px;">
    <option value="DEFAULT">DEFAULT</option>
   				<?php echo $group_block;?>
       </select></td>
    <td><font color="#0000FF" size="-1">NEW GROUP:</font></td>
    <td><input type="text" id="newgroup" name="newgroup" placeholder="New Group Name" ></td>  
  </tr>
   <tr>
    <td>ITEM TYPE :</td>
    <td><select name="itemftype" id="itemftype">
    <option value="DEFAULT">DEFAULT</option>
     <option value="VEG">VEG</option>
      <option value="NON-VEG">NON-VEG</option>
       </select></td>
         <td colspan="2"><input type="text" id="nvegtype" name="nvegtype" style="display: none;  width:300px;" placeholder="CATEGORY:i.e. Chicken / Fish / Mutton / Egg"></td>
  </tr>
   <tr>
    <td>ITEM CODE :</td>
    <td><input type="text" id="itemfcode" name="itemfcode"></td>
     <td>ITEM NAME :</td>
    <td><input type="text" id="itemfname" name="itemfname"></td>
  </tr>
  <tr>
    <td>FULL PLATE RATE :</td>
    <td><input type="text" id="fullfrate" name="fullfrate"></td>
     <td>HALF PLATE RATE :</td>
    <td><input type="text" id="halffrate" name="halffrate"></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="Submit" value="ADD ITEM"></input></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
      </p>
    <br /><br /><br /><br /><br /><br /><br /><br />
       <br /><br /><br /><br /><br /><br /><br /><br />
        <br /><br /><br /><br /><br /><br />
    </div>
    
    <div class="cl">&nbsp;</div>
  </div>
</div>
<div class="footer">
  <div class="shell">
    <p class="lf">Copyright &copy; 2010 <a href="#">RESTAURANT-FREE</a> - All Rights Reserved</p>
    <p class="rf"><a href="#" target="_blank">Website</a>Designed by <a href="http://www.SAMPLE_FREE.co.in" target="_blank">SAMPLE_M_FREE</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>