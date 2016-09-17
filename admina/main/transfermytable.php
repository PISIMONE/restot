<?php
include("../connect/connectdb.php");
include("check.php");
?>
<?php
$msg=null;
$sql=null;
$query=null;
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$msg=null;
$sql=null;
$myfromtable=(addslashes(trim($_POST['fromtable'])));
$mytotable=(addslashes(trim($_POST['totable'])));
$mytotable="TABLE".$mytotable;

$qry=mysql_query("SELECT otype FROM adikotnum WHERE otype='$mytotable' AND status!='Confirm'");
$row=mysql_fetch_array($qry);
if($row)
{   
   $msg = "Table is already booked.";
   header("Location: resttransfertable.php?mymsg=$msg");
   exit();
}
else{
			$sql = "UPDATE adikotnum SET otype='$mytotable' WHERE otype='$myfromtable' AND status!='Confirm'";
			$result = mysql_query($sql);																		
			$count=null;																		
			$count=mysql_affected_rows();																		
			$count=(int)$count;
				if ($count>0)																								    
				{		
				$sql = "UPDATE adifoodbill SET otype='$mytotable' WHERE otype='$myfromtable' AND status='Credit'";
				$result = mysql_query($sql);				
				$msg="Table Transfer Successfull.<br />"; //.$sql;
				}
				else
				{
				$msg="Table Transfer failed!.";
				}
      }
				
header("Location: resttransfertable.php?mymsg=$msg");
}
?>