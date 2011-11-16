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
	$ica = mysql_fetch_row($result);
	fb($ica[0]);
	if ($ica[0]==0){
		$trying ="team is complete"; fb($trying);
		$ic=1;
	}else $ic=0;
	$iql = "UPDATE teams SET `teamcomplet`='$ic' WHERE pid='".$pid;
	mysql_query($iql) or die($trying);
}
function listProjects(){
	$ht = '<div STYLE=" height: 600px; width: 600px; font-size: 14px; overflow: auto;">';
    $trying ="listing projects"; fb($trying);
	$sql = "Select * FROM projects";
	$result = mysql_query($sql) or die($trying);
	$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';
	while ($arow = mysql_fetch_assoc($result)) {
	    fb($arow);
		$pid = $arow["pid"];
		$ht .= '<tr><td><big><b>'.$arow["title"].'</b> project</big></td>
		<td><center>projectID:<br/> '.$pid.'</center></td>
		<td>project date:<br/> '.$arow["projdate"].'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'</td>		
		<tr><td>organizer: '.$arow["organizer"].'</td>
		<td></td>
		<td>zipcode: <br/>'.$arow["zipcode"].'</td></tr>
		<td><a href="soup-editProject.php?pid='.$pid.'">Edit a project</a></td>
		<td><a href="soup-joinTeam.php?pid='.$pid.'">Join a Team</a></td>
		<td><a href="soup-joinTeamMod.php?pid='.$pid.'">Edit a team</a></td></tr>';
		if ($arow["teamcomplete"]==1){
			$ht.='<tr><td>Team is complete</td></tr>';
		}
	}
	$ht.='</table></div>';
	echo $ht;
}	

//isTeamComplete(7);

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