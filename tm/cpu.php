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
    $trying ="udpading ".$pid." iscomplete"; fb($trying);	
	$iql = "UPDATE projects SET `teamcomplete`='$ic' WHERE pid='".$pid."'";
	fb($iql);
	mysql_query($iql) or die($trying);
}
function listProjects(){
	$ht = '<div STYLE=" height: 600px; font-size: 14px; overflow: auto;">';
	$ht.='<div id="border">';
///recruiting projects	
    $trying ="listing projects"; fb($trying);
	$sql = "Select * FROM projects WHERE status = 'recruiting'";
	$result = mysql_query($sql) or die($trying);	

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects in need of volunteers</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    fb($arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		fb($ica[0]);    	
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		fb($need);
	///who has joined
		$trying ="who so far"; fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";	
		fb($sql);
		$who = mysql_query($sql) or die($trying);
		$wh = "Volunteers so far include ";
		while ($whom = mysql_fetch_assoc($who)){
			foreach ($whom as $key=>$val){
				if ($key =="name"){
					$vv = explode(" ",$val);
					$val = $vv[0];
					$wh.= $val." & ";
				}
			}
		}	
		$wh=substr($wh,0,-2);
		$wh .= ". ";
		fb($wh);    	
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';	
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><center>projectID:<br/> '.$pid.'</center></td>
		<td>project date:<br/> '.$arow["projdate"].'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'</td>		
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>zipcode: <br/>'.$arow["zipcode"].'</td>
		<td>status: <br/>'.$arow["status"].'</td></tr>
		<tr><td></td>
		<td colspan="6">'.$wh.$need.'<a href="soup-joinTeam.php?pid='.$pid.'">Join a Team</a></td></tr>
		<tr><td></td><td colspan="6">Something come up? Need to 
		<a href="soup-joinTeamMod.php?pid='.$pid.'">unvolunteer</a>? </td></tr>';
		$ht.='</div></table>';
	}
	$ht .='</div>';
	
///ready projects	
    $trying ="listing projects"; fb($trying);
	$sql = "Select * FROM projects WHERE status = 'ready'";
	$result = mysql_query($sql) or die($trying);	

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects ready to go</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    fb($arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		fb($ica[0]);    	
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		fb($need);
	///who has joined
		$trying ="who so far"; fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";	
		fb($sql);
		$who = mysql_query($sql) or die($trying);
		$wh = "This team includes ";
		while ($whom = mysql_fetch_assoc($who)){
			foreach ($whom as $key=>$val){
				if ($key =="name"){
					$vv = explode(" ",$val);
					$val = $vv[0];
					$wh.= $val." & ";
				}
			}
		}	
		$wh=substr($wh,0,-2);
		$wh .= ". ";
		fb($wh);    	
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';	
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><center>projectID:<br/> '.$pid.'</center></td>
		<td>project date:<br/> '.$arow["projdate"].'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'</td>		
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>zipcode: <br/>'.$arow["zipcode"].'</td>
		<td>status: <br/>'.$arow["status"].'</td></tr>
		<tr><td></td>
		<td colspan="6">'.$wh.'</tr>
		<tr><td></td><td colspan="6">Something come up? Need to 
		<a href="soup-joinTeamMod.php?pid='.$pid.'">unvolunteer</a>? 
		Let the project organizer know.</td></tr>';
		$ht.='</div></table>';
	}
	//$ht .='</div>';
/// projectsi n process
    $trying ="listing projects"; fb($trying);
	$sql = "Select * FROM projects WHERE status = 'in process'";
	$result = mysql_query($sql) or die($trying);	

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects in process.</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    fb($arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		fb($ica[0]);    	
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		fb($need);
	///who has joined
		$trying ="who so far"; fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";	
		fb($sql);
		$who = mysql_query($sql) or die($trying);
		$wh = "This team includes ";
		while ($whom = mysql_fetch_assoc($who)){
			foreach ($whom as $key=>$val){
				if ($key =="name"){
					$vv = explode(" ",$val);
					$val = $vv[0];
					$wh.= $val." & ";
				}
			}
		}	
		$wh=substr($wh,0,-2);
		$wh .= ". ";
		fb($wh);    	
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';	
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><center>projectID:<br/> '.$pid.'</center></td>
		<td>project date:<br/> '.$arow["projdate"].'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'</td>		
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>zipcode: <br/>'.$arow["zipcode"].'</td>
		<td>status: <br/>'.$arow["status"].'</td></tr>
		<tr><td></td>
		<td colspan="6">'.$wh.'</tr>
		<tr><td></td><td colspan="6">Something come up? Need to 
		<a href="soup-joinTeamMod.php?pid='.$pid.'">unvolunteer</a>? 
		Let the project organizer know.</td></tr>';
		$ht.='</div></table>';
	}
		//$ht .='</div>';
/// projects done
    $trying ="listing projects"; fb($trying);
	$sql = "Select * FROM projects WHERE status = 'done'";
	$result = mysql_query($sql) or die($trying);	

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects done.</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    fb($arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		fb($ica[0]);    	
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		fb($need);
	///who has joined
		$trying ="who so far"; fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";	
		fb($sql);
		$who = mysql_query($sql) or die($trying);
		$wh = "This team included ";
		while ($whom = mysql_fetch_assoc($who)){
			foreach ($whom as $key=>$val){
				if ($key =="name"){
					$vv = explode(" ",$val);
					$val = $vv[0];
					$wh.= $val." & ";
				}
			}
		}	
		$wh=substr($wh,0,-2);
		$wh .= ". ";
		fb($wh);    	
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';	
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><center>projectID:<br/> '.$pid.'</center></td>
		<td>project date:<br/> '.$arow["projdate"].'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'</td>		
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>zipcode: <br/>'.$arow["zipcode"].'</td>
		<td>status: <br/>'.$arow["status"].'</td></tr>
		<tr><td></td>
		<td colspan="6">'.$wh.'</tr>
		<tr><td></td><td colspan="6">Something come up? Need to 
		<a href="soup-joinTeamMod.php?pid='.$pid.'">unvolunteer</a>? 
		Let the project organizer know.</td></tr>';
		$ht.='</div></table>';
	}
	$ht .='</div></div>';	
	echo $ht;
}	
function ontime($pid){
    $trying ="ontime"; fb($trying);
	$sql = "Select * FROM projects WHERE pid='".$pid."'";
	$result = mysql_query($sql) or die($trying);
	$arow = mysql_fetch_assoc($result);
	fb(date("m/d/Y").$arow["projdate"]);
	fb((strtotime($arow["projdate"]) - strtotime(date("m/d/Y")))/86400);	
	$dp=strtotime($arow["projdate"]);
	$dn=strtotime(date("m/d/Y"));
	$dif =($dp-$dn)/86400;
	fb($dif);
	$lead = $arow["leadtime"];
	$tcompl = $arow["teamcomplete"];
	if ($dif-$lead>=0 and $tcompl ==0){
		$stat = "recruiting";
	} elseif ($dif-$lead>=0 and $tcompl ==1){
		$stat = "ready";
	} elseif ($dif-$lead<0 and $tcompl ==1){
		$stat = "in process";
	} elseif ($dif-$lead<0 and $tcompl ==0){
		$stat = "late";
	} 
	if ($dif<0 and $tcompl ==0){
		$stat = "dead";
	} elseif ($dif<0 and $tcompl ==1){	
		$stat = "done";
	}
    $trying ="udpading ".$pid." status to ". $stat; fb($trying);	
	$iql = "UPDATE projects SET `status`='$stat' WHERE pid='".$pid."'";
	fb($iql);
	mysql_query($iql) or die($trying);
}
function updateStatus(){
	$trying ="listing projects not done or dead"; fb($trying);
	$sql = "Select * FROM projects WHERE 
	status ='recruiting' OR 
	status ='ready' OR 
	status ='in process' OR 
	status ='late'";
	fb($sql);
	$result = mysql_query($sql) or die($trying);
	while ($arow = mysql_fetch_assoc($result)) {
	    fb($arow);
		$pid = $arow["pid"];	
		ontime($pid);
	}
}
