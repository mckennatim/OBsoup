<?php 
session_start();
include_once('dbinfo.php');
require_once('FirePHP.class.php');
require_once('fb.php');
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
function copyRoles($projid){
	$sql="SELECT * FROM roles WHERE oid=145"; 
	$od = mysql_query($sql) or die("Dead getting outline");
	$r = mysql_query($sql) or die("Dead outlid");
	while ($arow = mysql_fetch_row($r)) {
		foreach($arow as $key=>$val){
		print_r($arow);
		}
	}
}
function isTeamComplete($pid){
    $trying ="checking whether team ".$pid." is complete"; fb($trying);
	$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
	fb($sql);
	$result = mysql_query($sql) or die($trying);
	fb($result);
	if ($result==0){
		$trying ="team is complete"; fb($trying);
	}	
}
function listProjects(){
    $trying ="listing projects"; fb($trying);
	$sql = "Select * FROM projects";
	$result = mysql_query($sql) or die($trying);
	$ht = '<div STYLE=" height: 600px; width: 600px; font-size: 
	12px; overflow: auto;"><table bgcolor="green">';
	while ($arow = mysql_fetch_row($result)) {
		foreach($arow as $key=>$val){
		$ht .= '<tr><td>'.$title.' project</td><td>'.$projdate.'</td>
		<td>zip :'.$zipcode.'</td></tr>
		<tr><td>organizer: '.$organizer.'</td>';
		}
	}
}	

isTeamComplete(27);

/*
<div STYLE=" height: 600px; width: 600px; font-size: 12px; overflow: auto;">
<table bgcolor="green">
<tr><td bgcolor="blue">testing </td></tr>
<tr><td>free php scripts;/td></tr>
<tr><td bgcolor="blue">free php scripts</td></tr>
<tr><td>free php scripts</td></tr>
<tr><td bgcolor="blue">free php scripts</td></tr>
</table>
</div>
*/	
?>