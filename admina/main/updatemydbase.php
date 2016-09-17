<?php
include("../connect/connectdb.php");
// Unescape the string values in the JSON array
$tabledelid = ($_POST['mycodedbup']);



if($_POST['mycodedbup']=="YES")
{
$msg=null;
$query=null;
			
set_time_limit(0);		
$loc="upload_db/".$_FILES["file"]["name"];
$db_name=$_FILES["file"]["name"];

	if($_FILES["file"]["error"] > 0)
		echo "error code:" . $_FILES["file"]["error"]."<br>";
	else
	{
		
			move_uploaded_file($_FILES["file"]["tmp_name"],$loc);
			
            
		   
$filename = $loc;

$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 
	}
				
	$msg="Database Refreshed successfully";
	header("Location: backups.php?mymsg=$msg");
		

}


?>
