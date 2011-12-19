<?php 
/*
copy default roles associated with project outline oid 1
to new roles with temporary oid =2
*/
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('getBlank template');

$oid=$_REQUEST['oid'];

$qry = "SELECT `rid`, `oid`, `role`, `roledesc`
FROM roles
WHERE oid=$oid";
//fb($qry);
$roler = mysql_query($qry) or die("Dead finding units uid");


echo jsonJQ($roler);

function jsonJQ($r){
$js = '{ "aaData": [';
while ($arow = mysql_fetch_assoc($r)) 
{
	$js.=' [';
	foreach($arow as $key=>$val){
		$js.='"'.$val.'",';
		fb($val);
	}
	$js = substr($js,0,-1);
	$js.='], ';		
}	
$js=substr($js,0,-2).'] }';
return $js;
}
?>