<?php 
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	



function copyOutline($outlid){
	$sql="SELECT * FROM prOutlines WHERE oid=145 LIMIT 1"; 
	$od = mysql_query($sql) or die("Dead getting outline");
	$r = mysql_query($sql) or die("Dead outlid");
	$arow = mysql_fetch_row($r);
	print_r($arow);
}
function copyRoles($$projid){
	$sql="SELECT * FROM roles WHERE oid=145"; 
	$od = mysql_query($sql) or die("Dead getting outline");
	$r = mysql_query($sql) or die("Dead outlid");
	while ($arow = mysql_fetch_row($r)) {
		foreach($arow as $key=>$val){
		print_r($arow);
		}
	}
}
?>