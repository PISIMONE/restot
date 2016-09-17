<?php
	
$querycompvars=NULL;

$querycompvars = "SELECT * FROM `thecompinfo` WHERE `id` = 1";
$stmtcompvars = mysql_query($querycompvars);
$rcompvars=mysql_fetch_array($stmtcompvars);

$compvarsid=$rcompvars['id'];
if(($compvarsid=="")||($compvarsid==NULL))
{
	$compvarsid="1";
	}

$compvarscname=$rcompvars['cname'];
if(($compvarscname=="")||($compvarscname==NULL))
{
	$compvarscname="NONE";
	}

$compvarscaddrs=$rcompvars['caddrs'];
if(($compvarscaddrs=="")||($compvarscaddrs==NULL))
{
	$compvarscaddrs="NONE";
	}

$compvarscphno=$rcompvars['cphno'];
if(($compvarscphno=="")||($compvarscphno==NULL))
{
	$compvarscphno="NONE";
	}

$compvarscemail=$rcompvars['cemail'];
if(($compvarscemail=="")||($compvarscemail==NULL))
{
	$compvarscemail="NONE";
	}

$compvarscweb=$rcompvars['cweb'];
if(($compvarscweb=="")||($compvarscweb==NULL))
{
	$compvarscweb="NONE";
	}

$compvarsclogo=$rcompvars['clogo'];
if(($compvarsclogo=="")||($compvarsclogo==NULL))
{
	$compvarsclogo="NONE";
	}

$compvarscptitle=$rcompvars['cptitle'];
if(($compvarscptitle=="")||($compvarscptitle==NULL))
{
	$compvarscptitle="NONE";
	}

$compvarscslog=$rcompvars['cslog'];
if(($compvarscslog=="")||($compvarscslog==NULL))
{
	$compvarscslog="NONE";
	}

$compvarscregno=$rcompvars['cregno'];
if(($compvarscregno=="")||($compvarscregno==NULL))
{
	$compvarscregno="NONE";
	}

$compvarsctinno=$rcompvars['ctinno'];
if(($compvarsctinno=="")||($compvarsctinno==NULL))
{
	$compvarsctinno="NONE";
	}

$compvarscstno=$rcompvars['cstno'];
if(($compvarscstno=="")||($compvarscstno==NULL))
{
	$compvarscstno="NONE";
	}

$compvarscvatno=$rcompvars['cvatno'];
if(($compvarscvatno=="")||($compvarscvatno==NULL))
{
	$compvarscvatno="NONE";
	}
	
$compvarssbtno=$rcompvars['sbtno'];
if(($compvarssbtno=="")||($compvarssbtno==NULL))
{
	$compvarssbtno="NONE";
	}	

$compvarscstaxper=$rcompvars['cstaxper'];
if(($compvarscstaxper=="")||($compvarscstaxper==NULL))
{
	$compvarscstaxper="0.00";
	}

$compvarscvatper=$rcompvars['cvatper'];
if(($compvarscvatper=="")||($compvarscvatper==NULL))
{
	$compvarscvatper="0.00";
	}
	
$compvarscsbtaxper=$rcompvars['csbtaxper'];
if(($compvarscsbtaxper=="")||($compvarscsbtaxper==NULL))
{
	$compvarscsbtaxper="0.00";
	}

$compvarssercharge=$rcompvars['sercharge'];
if(($compvarssercharge=="")||($compvarssercharge==NULL))
{
	$compvarssercharge="0.00";
	}

$compvarscparcel=$rcompvars['cparcel'];
if(($compvarscparcel=="")||($compvarscparcel==NULL))
{
	$compvarscparcel="0.00";
	}

$compvarscreatedon=$rcompvars['createdon'];
if(($compvarscreatedon=="")||($compvarscreatedon==NULL))
{
	$compvarscreatedon="NONE";
	}

$compvarsupdatedon=$rcompvars['updatedon'];
if(($compvarsupdatedon=="")||($compvarsupdatedon==NULL))
{
	$compvarsupdatedon="NONE";
	}
?>