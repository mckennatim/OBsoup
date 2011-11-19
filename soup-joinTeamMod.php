<?
session_start();
require_once('auth.php');
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$pid = $_GET[pid];
fb('how are you today');
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
				<img src="images/soupbanner.jpg" class="stretch" alt="soup banner" />
			</section>
		</header>
		<section class="round">
			<h1>Volunteer for this <?echo $title ?> project</h1>
				<label>status:</label>
				<?=$status?><br/>				
				<label>project date:</label>
				<?=$projdate?>
				<label>lead time: </label>
				<?=$leadtime?>
				<label>organizer: </label>
				<?=$organizer?>
				<br />
				<label>site contacts: </label>
				<?=$sitecontacts?>
				<label>link: </label>
				<a href=<?=$link?>><?=$link?></a>
				<label>zip: </label>
				<?=$zipcode?>
				<br />				
				<label>location:</label>
				<?=$location?>
				<br />
				<label>description:</label><br/>
				<?=$desc?>
				<br />
				<label>info:</label><br/>
				<?=$info?>
			</form>		
		</section>
	</div>
<div class="container">
<section class="round">
<? 
echo $rarr; 
fb($rarr);
?>
</section>

