<?php 
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');

$pid =7;

$qry = "SELECT `trid`, `role`, `roledesc`, `id`
FROM team  
WHERE pid='$pid'";
fb($qry);
$roler = mysql_query($qry) or die("Dead finding units uid");

echo jsonJQ($roler);

function jsonJQ($r){
$js = '{ "aaData": [';
while ($arow = mysql_fetch_row($r)) 
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