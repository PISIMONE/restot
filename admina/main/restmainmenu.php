<?php

if($_SESSION['user']=="admin")
{
$customers = "customers.php";
$addcustomers = "addcustomers.php";
$viewcustomers = "viewcustomers.php";
$deletecustomers = "deletecustomers.php";
///////////////////


$staffs = "staffs.php";
$addstaffs = "addstaffs.php";
$viewstaffs = "viewstaffs.php";
$deletestaffs = "deletestaffs.php";
$companyinfo = "companyinfo.php";
$backups = "backups.php";
/////////////////////////////

$accounts = "accounts.php";
        	
$salesreports = "salesreports.php";
$itemwisesales = "itemwisesales.php";
$tablewisesales = "tablewisesales.php";
$paymentwisesales = "paymentwisesales.php";
$menutypewisesales = "menutypewisesales.php";
$vegnvegwisesales = "vegnvegwisesales.php";
$groupwisesales = "groupwisesales.php";
$itemwisesales = "itemwisesales.php";
$nvegtypewisesales = "nvegtypewisesales.php";


////////////////////////
$posreported = "posreported.php";
$discountedbills = "discountedbills.php";


$createledger = "createledger.php";
$viewledgers = "viewledgers.php";
$vouchers = "vouchers.php";
$receipts = "receipts.php";
$journalentry = "journalentry.php";
$daybook = "daybook.php";
$trialbalance = "trialbalance.php";
$balancesheet = "balancesheet.php";
$placcounts = "placcounts.php";
            
}
else{
	$customers = "customers.php";
	$addcustomers = "addcustomers.php";
	$viewcustomers = "viewcustomers.php";
	$posreported = "posreported.php";
	$tablewisesales = "tablewisesales.php";
	$itemwisesales = "itemwisesales.php";
	$paymentwisesales = "paymentwisesales.php";
	}

?>

<div id="topnav">
      <ul>
        <li><a href="mainpage.php">HOME</a></li>
        <li><a href="restaurant.php">RESTAURANT</a>
        	
            
            <ul>
            	<li><a href="restorderlist.php">KOT</a>
                    <ul>
                    	<li><a href="restorderplaceme.php">PLACE KOT</a></li>
                        <li><a href="restorderview.php">VIEW KOT</a></li>
                        <li><a href="restorderdelivery.php">DELIVERY</a></li>
                    </ul>
                </li>
           
            	<li><a href="restbillingmain.php">BILLING</a>
                    <ul>
                    	<li><a href="restbilling.php">CREATE BILL</a></li>
                        <li><a href="restviewbill.php">VIEW BILL</a></li>
                        <li><a href="restpaybill.php">PAY BILL</a></li>
                    </ul>
                </li>
           
            	<li><a href="resttransfertable.php">TRANSFER TABLE</a></li>
           
            	<li><a href="fooditems.php">FOOD MENU</a>
                    <ul>
                    	<li><a href="additems.php">ADD ITEM</a></li>
                        <li><a href="viewitems.php">VIEW ITEM</a></li>
                        <li><a href="updateitems.php">UPDATE ITEM</a></li>
                        <li><a href="delitems.php">DELETE ITEM</a></li>
                    </ul>
                </li>
            </ul>
        
        
        </li>
        <li><a href="#">SETTINGS</a>
        	
            
            <ul>
            	<li><a href="<?php if(isset($customers)) echo "$customers";?>">CUTOMERS</a>
                	<ul>
                    	<li><a href="<?php if(isset($addcustomers)) echo "$addcustomers"; ?>">ADD</a></li>
                        <li><a href="<?php if(isset($viewcustomers)) echo "$viewcustomers";?>">VIEW / UPDATE</a></li>
                        <li><a href="<?php if(isset($deletecustomers)) echo "$deletecustomers";?>">DELETE</a></li>
                    </ul>
                </li>
                
                <li><a href="<?php if(isset($staffs)) echo "$staffs";?>">STAFFS</a>
                	<ul>
                    	<li><a href="<?php if(isset($addstaffs)) echo "$addstaffs";?>">ADD</a></li>
                        <li><a href="<?php if(isset($viewstaffs)) echo "$viewstaffs";?>">VIEW</a></li>
                        <li><a href="<?php if(isset($deletestaffs)) echo "$deletestaffs";?>">DELETE</a></li>
                    </ul>
                </li>
                
                <li><a href="<?php if(isset($companyinfo)) echo "$companyinfo";?>">COMPANY INFO</a></li>
                
                <li><a href="<?php if(isset($backups)) echo "$backups";?>">BACKUP</a></li>
            
            </ul>   
        
        
        </li>
		<li><a href="<?php if(isset($accounts)) echo "$accounts";?>">ACCOUNTS</a>
        	
            
            <ul>
            	<li><a href="<?php if(isset($salesreports)) echo "$salesreports";?>">SALES REPORTS</a>
                	<ul>
                    	<li><a href="billwisesales.php">BILL WISE</a></li>
                        <li><a href="<?php if(isset($itemwisesales)) echo "$itemwisesales";?>">ITEM WISE</a></li>
                        <li><a href="<?php if(isset($tablewisesales)) echo "$tablewisesales";?>">TABLE/ORDER WISE</a></li>
                        <li><a href="<?php if(isset($paymentwisesales)) echo "$paymentwisesales";?>">PAYMENT WISE</a></li>
                        <li><a href="<?php if(isset($menutypewisesales)) echo "$menutypewisesales";?>">MENUTYPE WISE</a></li>
                        <li><a href="<?php if(isset($vegnvegwisesales)) echo "$vegnvegwisesales";?>">VEG/NON-VEG WISE</a></li>
                        <li><a href="<?php if(isset($groupwisesales)) echo "$groupwisesales";?>">GROUP WISE</a></li>
                       <li><a href="<?php if(isset($nvegtypewisesales)) echo "$nvegtypewisesales";?>">NON-VEG TYPE WISE</a></li>
                    </ul>
                </li>
		
		<li><a href="<?php if(isset($posreported)) echo "$posreported";?>">POS REPORT</a></li>
                
                <li><a href="<?php if(isset($discountedbills)) echo "$discountedbills";?>">DISCOUNTED BILLS</a></li>
                
                <li><a href="#">LEDGERS</a>
                	<ul>
                    	<li><a href="<?php if(isset($createledger)) echo "$createledger";?>">CREATE LEDGER</a></li>
                        <li><a href="<?php if(isset($viewledgers)) echo "$viewledgers";?>">VIEW LEDGER</a></li>
                    </ul>
                </li>
                
                <li><a href="<?php if(isset($vouchers)) echo "$vouchers";?>">VOUCHERS</a></li>
                
                <li><a href="<?php if(isset($receipts)) echo "$receipts";?>">RECEIPTS</a></li>
                
                <li><a href="<?php if(isset($journalentry)) echo "$journalentry";?>">JOURNAL</a></li>
                
                <li><a href="<?php if(isset($daybook)) echo "$daybook";?>">DAYBOOK</a></li>
                
                <li><a href="<?php if(isset($trialbalance)) echo "$trialbalance";?>">TRIAL BALANCE</a></li>
                
                <li><a href="<?php if(isset($balancesheet)) echo "$balancesheet";?>">BALANCE SHEET</a></li>
                
                <li><a href="<?php if(isset($placcounts)) echo "$placcounts";?>">P/L ACCOUNT</a></li>
            
            </ul>
            
            	
        </li>
        <li><a href="logout.php">LOG-OUT</a></li>


      </ul>
    </div>  