<?
session_start();

include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('auth.php');
ob_start(); //gotta have this

if (isset($_GET['pid'])) $pid = $_GET['pid'];
fb('in soup-joinTeamMod');
$volunteerID=$_SESSION['SESS_ID'];
fb('the volid is '.$volunteerID);
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

$sql = "SELECT `trid`, `id`, `willdothis`, `role`, `roledesc`, `name`
FROM team
LEFT JOIN volunteers
USING ( id )
WHERE pid='$pid'";
fb($sql);
$roler = mysql_query($sql) or die("Dead finding units uid");

$rarr = mkTbl($roler);
fb('pid is now '.$pid);
function mkTbl($r){
	global $volunteerID;
	global $pid;
	$js = '<form method=post action="postTeamMod.php">
	<input type="hidden" name="vid" id="vid" value="'.$volunteerID.'"/>
	<input type="hidden" name="pid" id="pid" value="'.$pid.'"/>
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
			if ($key=="id"){
				fb('volunteerid is '. $volunteerID.' and name val is '.$val);
				if ($val==$volunteerID){
					$itsme = TRUE;
					fb('its em is '.$itsme);
				} else $itsme=FALSE;
			}
			if ($key=="name"){
				$vv = explode(" ",$val);
				$val = $vv[0];
			}
			if ($key=="willdothis" and $itsme==TRUE){
				$js.='<td><input type=checkbox name=box[] checked="checked" value="'.$rowid.'"></td>';
			}elseif ($key=="willdothis" and $val==1){
				$js.='<td></td>';
			}elseif ($key=="willdothis" and $val==0){
				$js.='<td><input type=checkbox name=box[] value="'.$rowid.'"></td>';
			}elseif ($key=="trid" or $key=="id"){
				$js=$js; //do nothing
			}else{
				$js.='<td>'.$val.'</td>';
			}
		}
		$js.='</tr>';
	}
	$js.='<tr><td colspan =6 align=center><input type=submit
	value="Modify your commitment & click here"></form></td></tr></tbody></table></section>';
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
		</td></tr><tr><td>
				<label>link: </label>
				<a href=<?=$link?>><?=$link?></a></td><td>
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
<i>You can modify your role on the project. If you reconsider, you can re-check a role to volunteer</i>
<?
echo $rarr;
fb($rarr);
?>
</section>
