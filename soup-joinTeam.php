<?php
session_start();
//require_once('auth.php');
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$pid = $_GET['pid'];
fb('how are you today');
function loginHeader(){
    global $vol;
	global $fname;
	global $pid;
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
		//header("location: access-denied.php");
		//exit();
		$h= '<p align="right">Welcome! '.$vol.' You can volunteer for this project if you are logged in. ';
	$h.='You can <a href="soup-login.php?pg=soup-joinTeam&pid='.$pid.'">Login</a>
	if you\'ve <a href="launch.php?pg=soup-joinTeam&pid='.$pid.'">Register</a>ed
	<a href="http://wiki.occupyboston.org/wiki/user:soupTeam">| About SoupTeam</a></p>';
	} else {
		$volunteerID=$_SESSION['SESS_ID'];
		$vol=$_SESSION['SESS_NAME'];
		$h='<p align="right">Hi <b>'.$vol.'</b>. Setup how SoupTeam contacts you by editing your
		<a href="member-profile.php?pg=soup-joinTeam&pid='.$pid.'">Profile</a> |
		<a href="logout.php">Logout</a>
		<a href="http://wiki.occupyboston.org/wiki/user:soupTeam">| About SoupTeam</a></p>';
	}
	return $h;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">

		<title>Using DataTable with Editable plugin - Getting the data source via ajax request</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/demo_validation.css";
			@import "media/css/themes/base/jquery-ui.css";
			@import "media/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		</style>

        <script src="media/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.jeditable.js" type="text/javascript"></script>
        <script src="media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="media/js/jquery.validate.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.editable.js" type="text/javascript"></script>
	</head>
<?


mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");

//$oid =145;
//$pid = copyOutline($oid);
//copyRoles($$pid);

//displayProject($pid);


$qry = "SELECT *
FROM projects
WHERE pid='$pid' limit 1";
fb($qry);
$result = mysql_query($qry) or die("Dead finding units uid");
$row = 	$arow = mysql_fetch_assoc($result);
$projdate = $row['projdate'];
$projdate = $row['projdate'];
$leadtime = $row['leadtime'];
$location = $row['location'];
$title = $row['title'];
$desc = $row['description'];
$info = $row['info'];
$sitecontacts = $row['sitecontacts'];
$link = $row['link'];
$zipcode = $row['zipcode'];
$organizer = $row['organizer'];
$status = $row['status'];

$sprojdate= strtotime($projdate);
$timestr = $sprojdate-$leadtime*86400;
//fb($timestr);
$teamby = date("l\, m/d/Y",$timestr);
$projdate = date("l\, m/d/Y",$sprojdate);
//fb($teamby);

$sql = "SELECT `trid`, `willdothis`, `role`, `roledesc`, `name`
FROM team
LEFT JOIN volunteers
USING ( id )
WHERE pid='$pid'";
fb($sql);
$roler = mysql_query($sql) or die("Dead finding units uid");

$rarr = mkTbl($roler);

function mkTbl($r){
	global $volunteerID;
	global $pid;
	$js = '<form method=post action="postTeam.php">
	<input type="hidden" name="vid" id="vid" value="'.$volunteerID.'"/>
	<input type="hidden" name="pid" id="pid" value="'.$pid.'"/>
	<input type="hidden" name="pg" id="pg" value="soup-joinTeam"/>
	<table>	<thead>
		<tr>
			<th>willdothis</th>
			<th>role</th>
			<th>role description</th>
			<th>team members</th>
		</tr>
	</thead><tbody>';
	while ($arow = mysql_fetch_assoc($r)){
		$rowid=$arow['trid'];
		fb($rowid);
		$js.='<tr>';
		foreach($arow as $key=>$val){
			if ($key=="name"){
				$vv = explode(" ",$val);
				$val = $vv[0];
			}
			if ($key=="willdothis" and $val==0){
				$js.='<td><input type=checkbox name=box[] value="'.$rowid.'"></td>';
			}elseif ($key=="willdothis" and $val==1){
				$js.='<td></td>';
			}elseif ($key=="trid"){
				$js=$js; //do nothing
			}else{
				$js.='<td>'.$val.'</td>';
			}
		}
		$js.='</tr>';
	}
	$js.='<tr><td colspan =6 align=center><input type=submit
	value="Check off your role and click here"></form></td></tr></tbody></table></section>';
	//fb($js);
	return $js;
}
?>
<body>
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
				<a href="soup.php"><img src="images/soupbanner.jpg" class="stretch" alt="soup banner" /></a>
				<?echo loginHeader();
				if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
					echo '<ul class="err">';
					foreach($_SESSION['ERRMSG_ARR'] as $msg) {
					    $nicemessage = "You can only edit project on which you are the organizer.
						You can organize your own project or Join a Team working on a project.";
						echo '<li>',$nicemessage,'</li>';
					}
					echo '</ul>';
					unset($_SESSION['ERRMSG_ARR']);
				}
				?>
			</section>
		</header>
		<section class="round">
		<table><tbody>
		<tr><th colspan="3">
			<h3>Volunteer for the <big><b><?echo $title ?></b></big> project</h3>
		</th></tr><tr><td>
			Project date: <big><b><?=$projdate?></b></big>
		</td><td colspan="2">
				location:
				<big><b><?=$location?>, <?=$zipcode?></b></big>
		</td>
		</tr><tr><td>
				organizer:
				<big><b><?=$organizer?></b></big></td><td>
				status:
				<big><b><?=$status?></b></big></td><td>
				projID:
				<?=$pid?></td><td>
		</tr><tr><td colspan="3">
				Team needs to be in place by
				<big><b><?=$teamby?>, <?=$leadtime?></b></big>
				days before project date of
				<big><b><?=$projdate?></b></big> <br/>
		</td></tr><tr><td colspan="2">
				<label>link: </label>
				<a href=<?=$link?> class="wrapped"><?=$link?></a></td><td>
				ocupy site contact(s):
				<?=$sitecontacts?></td><td>
				</tr>
		<tr><td align="top">
				<label>description:</label><br/>
				<p align="justify"><?=$desc?></p>
		</td><td align="top" colspan="2">
				<label>info:</label><br/>
				<p align="justify"><?=$info?></p>
		<td>
		</tbody>
		</table>
		</section>
	</div>
<div class="container">
<section class="round">
<i>If you would like to be on this SoupTeam, select a role for yourself and click below. The organizer will contact
you when the SoupTeam is complete</i>
<?
echo $rarr;
fb($rarr);
?>
</section>
