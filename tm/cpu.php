<?php
include_once('dbinfo.php');
require_once('FirePHP.class.php');
require_once('fb.php');
ob_start(); //gotta have this
fb('in cpu');

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
    $trying ="checking whether team ".$pid." is complete"; //fb($trying);
	$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
	//fb($sql);
	$result = mysql_query($sql) or die($trying);
	$ica = mysql_fetch_row($result);
	//fb($ica[0]);
	if ($ica[0]==0){
		$trying ="team is complete"; //fb($trying);
		$ic=1;
	}else $ic=0;
    $trying ="udpading ".$pid." iscomplete"; //fb($trying);
	$iql = "UPDATE projects SET `teamcomplete`='$ic' WHERE pid='".$pid."'";
	//fb($iql);
	mysql_query($iql) or die($trying);
}
function listProjects(){
    cleanup();
	$ht = '<div STYLE=" height: 600px; font-size: 14px; overflow: auto;">';
	$ht.='<div id="border">';
///recruiting projects
    $trying ="listing projects"; //fb($trying);
	$sql = "Select * FROM projects WHERE status = 'recruiting' ORDER BY projdate";
	$result = mysql_query($sql) or die($trying);

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects in need of volunteers</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    //fb($arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; //fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		//fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		//fb($ica[0]);
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		//fb($need);
	///who has joined
		$trying ="who so far"; //fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";
		//fb($sql);
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
		$wh=substr($wh,0,-1);
		$wh .= ". ";
		//fb($wh);
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'&vid='.$arow["vid"].'">Edit</a></td>
		<td><small><center>projectID:<br/> '.$pid.'</center></small></td>
		<td>project date:<br/> '.fdate($arow["projdate"]).'</td>
		<td>lead time:<br/> '.$arow["leadtime"].' days</td>
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>location: <br/>'.$arow["location"].'</td>
		<td>status: <br/>'.$arow["status"].'</td></tr>
		<tr><td></td>
		<td colspan="6">'.$wh.$need.'<a href="soup-joinTeam.php?pid='.$pid.'">Join a Team</a></td></tr>
		<tr><td></td><td colspan="6">Something come up? Need to
		<a href="soup-joinTeamMod.php?pid='.$pid.'">unvolunteer</a>? </td></tr>';
		$ht.='</div></table>';
		//fb('soup-editProject.php?pid='.$pid.'&vid='.$arow["vid"]);
	}
	$ht .='</div>';
/// projects late
    $trying ="listing projects"; //fb($trying);
	$sql = "Select * FROM projects WHERE status = 'late' ORDER BY projdate";
	$result = mysql_query($sql) or die($trying);

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects late.</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    //fb("in late " .$arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; //fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		//fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		//fb($ica[0]);
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		//fb($need);
	///who has joined
		$trying ="who so far"; //fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";
		//fb($sql);
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
		//fb($wh);
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><small><center>projectID:<br/> '.$pid.'</center></small></td>
		<td>project date:<br/> '.fdate($arow["projdate"]).'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'days</td>
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>location: <br/>'.$arow["location"].'</td>
		<td>status: <br/>'.$arow["status"].'</td></tr>
		<tr><td></td>
		<td colspan="6">'.$wh.$need.'<a href="soup-joinTeam.php?pid='.$pid.'">Join a Team</a></td></tr>
		<tr><td></td><td colspan="6">Something come up? Need to
		<a href="soup-joinTeamMod.php?pid='.$pid.'">unvolunteer</a>?
		Let the project organizer know.</td></tr>';
		$ht.='</div></table>';
	}
///ready projects
    $trying ="listing projects"; //fb($trying);
	$sql = "Select * FROM projects WHERE status = 'ready' ORDER BY projdate";
	$result = mysql_query($sql) or die($trying);

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects ready to go</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    //fb($arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; //fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		//fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		//fb($ica[0]);
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		//fb($need);
	///who has joined
		$trying ="who so far"; //fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";
		//fb($sql);
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
		//fb($wh);
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><small><center>projectID:<br/> '.$pid.'</center></small></td>
		<td>project date:<br/> '.fdate($arow["projdate"]).'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'days</td>
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>location: <br/>'.$arow["location"].'</td>
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
    $trying ="listing projects"; //fb($trying);
	$sql = "Select * FROM projects WHERE status = 'in process' ORDER BY projdate";
	$result = mysql_query($sql) or die($trying);

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects in process.</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    //fb($arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; //fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		//fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		//fb($ica[0]);
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		//fb($need);
	///who has joined
		$trying ="who so far"; //fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";
		//fb($sql);
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
		//fb($wh);
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><small><center>projectID:<br/> '.$pid.'</center></small></td>
		<td>project date:<br/> '.fdate($arow["projdate"]).'</td>
		<td>lead time:<br/> '.$arow["leadtime"].' days</td>
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>location: <br/>'.$arow["location"].'</td>
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
    $trying ="listing projects"; //fb($trying);
	$sql = "Select * FROM projects WHERE status = 'done' ORDER BY projdate";
	$result = mysql_query($sql) or die($trying);

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects done.</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    //fb("in done " .$arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; //fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		//fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		//fb($ica[0]);
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		//fb($need);
	///who has joined
		$trying ="who so far"; //fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";
		//fb($sql);
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
		//fb($wh);
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><small><center>projectID:<br/> '.$pid.'</center></small></td>
		<td>project date:<br/> '.fdate($arow["projdate"]).'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'days</td>
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>location: <br/>'.$arow["location"].'</td>
		<td>status: <br/>'.$arow["status"].'</td></tr>
		<tr><td></td>
		<td colspan="6">'.$wh.'</tr>
		<tr><td></td><td colspan="6">Something come up? Need to
		<a href="soup-joinTeamMod.php?pid='.$pid.'">unvolunteer</a>?
		Let the project organizer know.</td></tr>';
		$ht.='</div></table>';
	}

/// projects dead
    $trying ="listing projects"; //fb($trying);
	$sql = "Select * FROM projects WHERE status = 'dead' ORDER BY projdate";
	$result = mysql_query($sql) or die($trying);

	$ht .= '<table><thead class="plabels"><td colspan="4">Projects dead.</td>
	</thead></table>';
	while ($arow = mysql_fetch_assoc($result)) {
	    //fb("in dead " .$arow);
		$pid = $arow["pid"];
		///how many needed
		$trying ="how many needed ".$pid." is complete"; //fb($trying);
		$sql = "SELECT COUNT(*) FROM team WHERE pid = ".$pid." AND willdothis=0";
		//fb($sql);
		$hm = mysql_query($sql) or die($trying);
		$ica = mysql_fetch_row($hm);
		//fb($ica[0]);
		$need = 'We still need '.$ica[0]. ' volunteer(s). ';
		//fb($need);
	///who has joined
		$trying ="who so far"; //fb($trying);
		$sql = "SELECT `id` , `name` FROM team LEFT JOIN volunteers
		USING ( id )	WHERE pid = '$pid'
		AND name IS NOT NULL";
		//fb($sql);
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
		//fb($wh);
		$ht .= '<table bgcolor="#D7D7FF" border="1" cellpadding="10">';
		$ht .= '<div id="border"><tr><td></td><td class="topp">
		<a href="soup-joinTeam.php?pid='.$pid.'">'.$arow["title"].' project</td>
		<td><a class="proj_button round" href="soup-editProject.php?pid='.$pid.'">Edit</a></td>
		<td><small><center>projectID:<br/> '.$pid.'</center></small></td>
		<td>project date:<br/> '.fdate($arow["projdate"]).'</td>
		<td>lead time:<br/> '.$arow["leadtime"].'days</td>
		<tr><td></td><td colspan="2">organizer: '.$arow["organizer"].'</td>
		<td>location: <br/>'.$arow["location"].'</td>
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
    $trying ="ontime"; //fb($trying);
	$sql = "Select * FROM projects WHERE pid='".$pid."'";
	$result = mysql_query($sql) or die($trying);
	$arow = mysql_fetch_assoc($result);
	//fb(date("m/d/Y").$arow["projdate"]);
	//fb((strtotime($arow["projdate"]) - strtotime(date("m/d/Y")))/86400);
	$dp=strtotime($arow["projdate"]);
	$dn=strtotime(date("m/d/Y"));
	$dif =($dp-$dn)/86400;
	//fb($dif);
	$oldstatus = $arow["status"];
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


    $trying ="udpading ".$pid." status to ". $stat; //fb($trying);
	$iql = "UPDATE projects SET `status`='$stat' , `priorstatus` = '$oldstatus' WHERE pid='".$pid."'";
	//fb($iql);
	mysql_query($iql) or die($trying);
	if ($stat=="ready" and $stat!=$oldstatus){
		notifyReady($arow);
	}

	//shouldNotify($oldstatus, $stat);
}
//called from soup.php, calls ontime() from here
function updateStatus(){
	$trying ="listing projects not done or dead"; //fb($trying);
	$sql = "Select * FROM projects WHERE
	status ='recruiting' OR
	status ='ready' OR
	status ='dead' OR
	status ='done' OR
	status ='in process' OR
	status ='late'";
	//fb($sql);
	$result = mysql_query($sql) or die($trying);
	while ($arow = mysql_fetch_assoc($result)) {
	    //fb($arow);
		$pid = $arow["pid"];
		ontime($pid);
	}
}
function notifyReady($arow){
    fb( "some project named ".$arow['pid']. " just got ready, time to notify the team");
	//who to notify
	//notify the organizer
	$orgid = $arow['vid'];
	$pid = $arow['pid'];
	$trying ="get org email"; //fb($trying);
	$iql = "SELECT * FROM volunteers WHERE id = '$orgid' LIMIT 1" ;
	//fb($iql);
	$result = mysql_query($iql) or die($trying);
	$orow = mysql_fetch_assoc($result);

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: OBsoup@soupteam.com' . "\r\n";
	$thisurl = curPageURL();

	$purl = parse_url($thisurl);
	//fb($purl);
	$host = $purl['host'];
	$whpath = $purl['path'];
	//fb($whpath);
	$pinfo = pathinfo($whpath);
	//fb($pinfo);
	$path = $pinfo['dirname'];
	//fb($path);
	$orgurl = "http://".$host.$path."/soup-teamContacts.php?pid=".$arow['pid'];
	$projurl = "http://".$host.$path."/soup-teamContacts.php?pid=".$arow['pid'];

	//fb($loginurl);

	//$email="mckenna.tim@gmail.com";
	$omessage = "Everybody has signed up for your ". $arow['projdate']. " ".$arow['title'] ."project.
		your teams contact information is at " .$orgurl.
		" (You may see a warning; sorry I'll try to fix that)";
	$tmessage = "The soup project you volunteered for on ". $arow['projdate']. "
	is ready to go. The volunteers hava all signed up. The
	organizer, ". $arow['organizer']. " will be in touch soon. (You may see a
	warning; sorry I'll try to fix that)";
	$email= $orow['email'];
	fb('about to email organizer '.$email. ' with '.$omessage);
	mail($email, 'Soup team ready', $omessage, $headers);
	$trying ="get team emails"; //fb($trying);
	$sql = "SELECT `email` FROM projects
	LEFT JOIN team
	USING ( pid )
	LEFT JOIN volunteers
	USING ( id )
	WHERE pid = '".$pid."' AND readyemail = 'on'
	GROUP BY email";
	fb($sql);
	$result = mysql_query($sql) or die($trying);
	while ($trow = mysql_fetch_assoc($result)) {
		fb($trow['email']);
		mail($trow['email'], 'Soup project ready', $tmessage, $headers);
	}
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function cleanup(){
	$qry="SELECT pid
	FROM projects
	ORDER BY pid
	DESC LIMIT 1";
	//fb($qry);
	$pir = mysql_query($qry) or die("Dead inserting blank project");
	$prow = mysql_fetch_assoc($pir);

	//fb('last row was '. $prow['pid']);
	$lastpid = $prow['pid'];

	$sql = "DELETE FROM team WHERE pid > ".$lastpid;
	mysql_query($sql) or die("Dead inserting cleaning teams");
}
function fdate($date){
	return date("m/d/Y",strtotime($date));
}
function mdate($date){
	return date("Y-m-d",strtotime($date));
}
