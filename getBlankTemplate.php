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

$trying = "clear oid=2 of roles";
$qry="DELETE FROM roles WHERE oid=2";
mysql_query($qry) or die($trying);

//get roles asociated with project outline oid
$qry = "SELECT `role`, `roledesc`, `num`
FROM roles 
WHERE oid=1";
//fb($qry);
$roler = mysql_query($qry) or die("Dead copying roles");

//copy default roles associated with project outline oid 1
//to new roles with temporary oid =2
while ($row = mysql_fetch_assoc($roler)) {	
	$role =$row['role'];
	$roledesc= $row['roledesc'];
	$num=$row['num'];
	for ($i=1;$i<=$num;$i++){
		$sql="INSERT INTO roles (`oid`, `role`, `roledesc`) 
		VALUES ('2', '$role', '$roledesc')";
		fb($sql);
		mysql_query($sql)or die("Dead pasting roles into team");
	}
}

$qry = "SELECT `rid`, `oid`, `role`, `roledesc`
FROM roles
WHERE oid=2";
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