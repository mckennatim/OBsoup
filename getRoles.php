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


$sql = "SELECT * FROM currentdata WHERE cdid=1";
fb($sql);
$result = mysql_query($sql) or die("Dead finding last project id");
$pida = mysql_fetch_assoc($result);
$pid = $pida['pid'];
$oid = $pida['oid'];
//get roles asociated with project outline oid
$qry = "SELECT `role`, `roledesc`, `num`
FROM roles 
WHERE oid='$oid'";
fb($qry);
$roler = mysql_query($qry) or die("Dead copying roles");

//copy roles associated with project outline oid 
//to team associated with project pid
while ($row = mysql_fetch_assoc($roler)) {	
	$role =$row['role'];
	$roledesc= $row['roledesc'];
	$num=$row['num'];
	for ($i=1;$i<=$num;$i++){
		$sql="INSERT INTO team (`pid`, `role`, `roledesc`) 
		VALUES ('$pid', '$role', '$roledesc')";
		fb($sql);
		mysql_query($sql)or die("Dead pasting roles into team");
	}
}

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