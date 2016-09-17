<?php
include("../connect/connectdb.php");
// Unescape the string values in the JSON array
$tabledelid = ($_POST['mycode']);

if($_POST['mycode']=="YES")
{
$msg=null;
$query=null;
////////////storing AI values///////////of tables
$tadifoodbill=null;
$tadikotdet=null;
$tadirestbilldet=null;
$treasonstable=null;
$treceipt_records=null;
$tstore_log=null;
$tvoucher_records=null;
$autoincval=null;
$tadirestbill=null;
				/////////adikotnum  STARTS/////////////////
				//SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'yc' AND TABLE_NAME = 'adikotnum'
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'adikotnum'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$autoincval=(int)($r['AUTO_INCREMENT']);
				////echo $autoincval;
				/////exit();
				/////////adikotnum ENDS/////////////////
				/////////adifoodbill STARTS/////////////////
				//SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'yc' AND TABLE_NAME = 'adikotnum'
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'adifoodbill'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$tadifoodbill=(int)($r['AUTO_INCREMENT']);
				////echo $autoincval;
				/////exit();
				/////////adifoodbill ENDS/////////////////
				/////////adikotdet STARTS/////////////////
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'adikotdet'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$tadikotdet=(int)($r['AUTO_INCREMENT']);
				/////////adikotdet ENDS/////////////////
				/////////adirestbilldet STARTS/////////////////
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'adirestbilldet'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$tadirestbilldet=(int)($r['AUTO_INCREMENT']);
				/////////adirestbilldet ENDS/////////////////
				/////////reasonstable STARTS/////////////////
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'reasonstable'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$treasonstable=(int)($r['AUTO_INCREMENT']);
				/////////reasonstable ENDS/////////////////
				/////////receipt_records STARTS/////////////////
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'receipt_records'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$treceipt_records=(int)($r['AUTO_INCREMENT']);
				/////////receipt_records ENDS/////////////////
				/////////store_log STARTS/////////////////
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'store_log'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$tstore_log=(int)($r['AUTO_INCREMENT']);
				/////////store_log ENDS/////////////////
				/////////voucher_records STARTS/////////////////
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'voucher_records'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$tvoucher_records=(int)($r['AUTO_INCREMENT']);
				/////////voucher_records ENDS/////////////////
				/////////adirestbill STARTS/////////////////
				$query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$condbname."' AND TABLE_NAME = 'adirestbill'";
				$result = mysql_query($query) or die(mysql_error());
				$r=mysql_fetch_array($result);
				$tadirestbill=(int)($r['AUTO_INCREMENT']);
				/////////adirestbill ENDS/////////////////
				
					///////////ALTER TABLE table_name AUTO_INCREMENT = 1;
				$query="TRUNCATE `adifoodbill`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `adifoodbill` AUTO_INCREMENT=".$tadifoodbill;
				$result = mysql_query($query) or die(mysql_error());
				
				$query="DROP table `adikotdet`";
				$result = mysql_query($query) or die(mysql_error());
				
				$query="TRUNCATE `adirestbilldet`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `adirestbilldet` AUTO_INCREMENT=".$tadirestbilldet;
				$result = mysql_query($query) or die(mysql_error());
				
				$query="TRUNCATE `reasonstable`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `reasonstable` AUTO_INCREMENT=".$treasonstable;
				$result = mysql_query($query) or die(mysql_error());
				
				$query="TRUNCATE `receipt_records`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `receipt_records` AUTO_INCREMENT=".$treceipt_records;
				$result = mysql_query($query) or die(mysql_error());
				
				$query="TRUNCATE `store_log`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `store_log` AUTO_INCREMENT=".$tstore_log;
				$result = mysql_query($query) or die(mysql_error());
				
				$query="TRUNCATE `voucher_records`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `voucher_records` AUTO_INCREMENT=".$tvoucher_records;
				$result = mysql_query($query) or die(mysql_error());
				
				
				mysql_close();
			
				include("../connect/connectdb.php");
				$msg=null;
				$query=null;
				
				$query="TRUNCATE `adifoodbill`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `adifoodbill` AUTO_INCREMENT=".$tadifoodbill;
				$result = mysql_query($query) or die(mysql_error());
				
				
				$query="DROP table `adikotnum`";
				$result = mysql_query($query) or die(mysql_error());
				$query="CREATE TABLE IF NOT EXISTS `adikotnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kotdate` datetime NOT NULL,
  `bokinum` varchar(10) DEFAULT NULL,
  `billtype` varchar(30) NOT NULL,
  `otype` varchar(20) NOT NULL,
  `waitrname` varchar(50) NOT NULL,
  `loguser` varchar(100) NOT NULL,
  `custto` varchar(200) NOT NULL,
  `custaddrs` text NOT NULL,
  `custphno` varchar(15) NOT NULL,
  `totalitems` int(10) NOT NULL,
  `totaldisper` decimal(10,2) NOT NULL,
  `totaldiscount` decimal(10,2) NOT NULL,
  `totalgrand` decimal(10,2) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=".$autoincval;
//echo $query;
//exit();
				$result = mysql_query($query) or die(mysql_error());
				
				$query="ALTER TABLE `adikotnum` AUTO_INCREMENT=".$autoincval;
				$result = mysql_query($query) or die(mysql_error());
				
				
				$query="CREATE TABLE IF NOT EXISTS `adikotdet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(11) NOT NULL,
  `itemtype` varchar(30) NOT NULL,
  `itemid` int(10) NOT NULL,
  `icode` varchar(10) NOT NULL,
  `itemname` varchar(200) NOT NULL,
  `uiprice` decimal(10,2) NOT NULL,
  `hiprice` decimal(10,2) NOT NULL,
  `uiquan` decimal(10,2) NOT NULL,
  `hiquan` decimal(10,2) NOT NULL,
  `icharge` decimal(10,2) NOT NULL,
  `idisper` decimal(10,2) NOT NULL,
  `idiscount` decimal(10,2) NOT NULL,
  `ktotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=".$tadikotdet;
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `adikotdet` AUTO_INCREMENT=".$tadikotdet;
				$result = mysql_query($query) or die(mysql_error());
				
				$query="TRUNCATE `adirestbill`";
				$result = mysql_query($query) or die(mysql_error());
				$query="ALTER TABLE `adirestbill` AUTO_INCREMENT=".$tadirestbill;
				$result = mysql_query($query) or die(mysql_error());
				
				$query="TRUNCATE `dis_updatebills`";
				$result = mysql_query($query) or die(mysql_error());
				
				
				$msg="Database Successfully Emptied";
				header("Location: backups.php?mymsg=$msg");
		

}


?>
