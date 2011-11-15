<?php 
/*
getRoles gest the roles associated with this project outl;ine and copies
them into some new team records associated with the new project
*/
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

$sql = "SELECT * FROM currentdata WHERE cdid=1";
fb($sql);
$result = mysql_query($sql) or die("Dead finding last project id");
$pida = mysql_fetch_assoc($result);
$pid = $pida['pid'];

//get roles asociated with project outline oid

$qry = "SELECT `trid`, `pid`, `role`, `roledesc`
FROM team
WHERE pid='$pid'";
fb($qry);
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