<?php
include("../connect/connectdb.php");
include("check.php");
?>

<?php
if(isset($_GET['mymsg']))
{
$msgdb=$_GET['mymsg'];
}
else{
	$msgdb=null;
	}

$mysql_hostname="localhost";
$mysql_user=$conuname;
$mysql_password=$conupass;
$mysql_database=$condbname;


//CALLING BACKUP FUNCTION
$mybackupdb=backup_tables($mysql_hostname,$mysql_user,$mysql_password,$mysql_database);


if($mybackupdb!=null)
			{
				$mybackupdb=$mybackupdb;
			/*echo "<center><font color='RED' size=+1 >";
			echo $mybackupdb."<br / ><br />";
			echo "</font></center>";*/
			}



			
			
			
			
			
/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
  
  $link = mysql_connect($host,$user,$pass);
  $return = null ;
  mysql_select_db($name,$link);
  
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysql_query('SHOW TABLES');
    while($row = mysql_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  
  //cycle through
  foreach($tables as $table)
  {
  
  	$return.= 'DROP TABLE IF EXISTS '.$table.';';
    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";
	$columns = count($row2);
	
    $result = mysql_query('SELECT * FROM '.$table);
    $num_fields = mysql_num_fields($result);
    
    
    
    for ($i = 0; $i < $columns; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
          if (isset($row[$j])) {
								if ($row[$j] == null) {
								$return .= 'null' ;
								} else {
								$return .= '"'.$row[$j].'"' ;
								}
								}
								else {
								$return .= '""';
								}
		  
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";
  }
  $myfile='database_backup_files/db_backup_'.date("d_m_Y-h_i_s").'_'.rand((int)'0',(int)'999').'.zip';
  $msg='Your data is collected successfully and ready for download.'.'<br /><br /><center><a target=\'_blank\' href="'.$myfile.'">CLICK TO DOWNLOAD</a><br /><font size="2" color="#000000">(Right click and save target as:)<br><br>Awids Corporation Web Solution</font></center>';
  //save file
  $handle = fopen($myfile,'w+');
  	 fwrite($handle,$return);
 	 fclose($handle);
	 mysql_close($link);
	 return $msg;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RESTAURANT-FREE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="../css/images/favicon.ico" />
<link rel="stylesheet" href="styles/layoutmenu.css" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
<script type="text/javascript">
	function validategenForm(oForm) {	
	var r = confirm("Are you sure to Empty the Database !");
		if (r)
		 {
			    oForm.elements["mycode"].value="YES";
		 }
		 else{
			 return false;
			 }	
}
//-->
</script>
<script type="text/javascript">
	function validategenFormup(oForm) {	
	var r = confirm("Are you sure to Upload New Database !");
		if (r)
		 {
			    oForm.elements["mycodedbup"].value="YES";
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
      <p align="center"><h2>ADMIN DASHBOARD</h2>
       <table border="0" cellpadding="5" cellspacing="15">
       <tr align="center">
    	<td><?php if(isset($msgdb)){echo "<center><font color='RED' size=+1 >".$msgdb."<br/><br/></font></center>"; } ?></td>
  		</tr>
  <tr align="center">
    	<td><?php if(isset($mybackupdb)){echo "<center><font color='RED' size=+1 >".$mybackupdb."<br/><br/></font></center>"; } ?></td>
  </tr>
   <tr align="center" bgcolor="#FF0000">
         <td>Empty Current Database</td>
    	<td><?php if(isset($mybackupdb)){echo '<form id="deldb" action="delmydbase.php" method="post">
     <input type="hidden" id="mycode" name="mycode" value="NO">
     <input type="Submit" onclick="return(validategenForm(this.form));" value="EMPTY"></input>
      </form>'; } ?></td>
  </tr>
  <tr align="center">
            <td colspan="2">&nbsp;</td>
         </tr>
         <tr align="center">
                <td colspan="2">&nbsp;</td>
         </tr>
   <tr align="center" bgcolor="#00FF66">
         <td>Upload Database</td>
    	<td><?php if(isset($mybackupdb)){echo '<form id="upldb" action="updatemydbase.php" method="post" ENCTYPE="multipart/form-data">
		<INPUT TYPE="hidden" NAME="MAX_FILE_SIZE" VALUE="20000000">
	 <input type="file" id="file" name="file" >
     <input type="hidden" id="mycodedbup" name="mycodedbup" value="NO">
     <input type="Submit" onclick="return(validategenFormup(this.form));" value="UPLOAD"></input>
      </form>'; } ?></td>
  </tr>
</table>

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