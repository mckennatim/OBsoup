<?
session_start();
require_once('auth.php');
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('now in soup-editProject');
$organizer=$_SESSION['SESS_NAME'];
$id=$_SESSION['SESS_ID'];
fb('id is '.$id);
fb('the volid is '.$organizer);
$pid = $_GET[pid];
$vid = $_GET[vid];
fb('vid is '.$vid);
/*$errmsg_arr = array();

if ($id!==$vid){
    $errmsg_arr[] = "not the organizer";   
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	fb("id dosn't equal");
    header("location: soup.php");
}
fb($id . 'is id. '.$vid.' is vid. past error message');*/

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

		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
           $('#example').dataTable({
                                      "bProcessing": true,
                                      "sAjaxSource": "getTeamforProj.php",
					aoColumns: [ { "bVisible": false}, {"bVisible": false}, null, null]
                                 }
                                    ).makeEditable({
									sUpdateURL: "updateTeamRec.php",
                    				sAddURL: "addTeamRec.php",
									sAddHttpMethod: "GET", //Used only on google.code live example because google.code server do not support POST request
                    				sDeleteURL: "deleteTeamRec.php",
									sDeleteHttpMethod: "GET", //Used only on google.code live example because google.code server do not support POST request
										});
			} );
			$(function() {
				$( "#projdate" ).datepicker();
			});			
		</script>
	</head>
<?


mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

$qry = "UPDATE currentdata SET `pid`=$pid";
fb($qry);
mysql_query($qry) or die("Dead writing currentdata");

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
$vid = $row['vid'];
$status = $row['status'];
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
			<form id="form1" name="Update" method="get" action="saveProject.php">			
				<h1>Edit this <input name="title" value="<?=$title?>"/>	project</h1>
				<input type="hidden" name="pid"  value="<?=$pid?>" />
				<input type="hidden" name="vid"  value="<?=$vid?>" />				
				<label>project status:</label>
				<big><?=$status?></big><br/>
				<label>project date: </label>
				<input name="projdate" size="12" id="projdate" value="<?=$projdate?>"/>
				<label>lead time:</label>
				<input name="leadtime" size="2" value="<?=$leadtime?>"/>days
				<label>project id:</label>
				<big><?=$pid?></big><br/>
				<label>organizer:</label>
				<input name="organizer" value="<?=$organizer?>"/>
				<label>link:</label>
				<input name="link" size="40" value="<?=$link?>"/>			
				<br />
				<label>location:..</label>
				<label>zipcode: </label>
				<input name="zipcode" size="9" value="<?=$zipcode?>"/>
				<label>site contacts:</label>
				<input name="sitecontacts" value="<?=$sitecontacts?>"/>					
				<br/>
				<textarea name="location" cols="30" rows="2"><?=$location?></textarea>
				<br />
				<label>description:</label><br/>
				<textarea name="desc" cols="50" rows="3"><?=$desc?></textarea>
				<br />
				<label>info:</label><br/>
				<textarea name="info" cols="50" rows="3"><?=$info?></textarea>
				<br />
				<input class="notify_button round" type="submit" value="Save your edited soup project" /><br />
				<a href="notify-volunteers.php?pid=<?=$pid?>" class="notify_button round">notify volunteers</a>				
			</form>		
		</section>
	</div>
 <form id="formAddNewRow" action="#" title="Add new record">
        <input type="hidden" name="trid" id="id" rel="0" value="DATAROWID" />
        <input type="hidden" name="pid" id="pid" rel="1" value="<?=$pid?>" />
        <label for="name">role</label><br />
	<input type="text" name="role" id="role" rel="2" />
        <br />
        <label for="name">roledesc</label><br />
	<textarea name="roledesc" id="roledesc" rel="3"></textarea>
</form>
<div class="container">
<section class="round">
<div class="add_delete_toolbar" />

<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>trid</th>
			<th>pid</th>
			<th>role</th>
			<th>roledesc</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>trid</th>
			<th>pid</th>
			<th>role</th>
			<th>roledesc</th>
		</tr>

	</tfoot>
	<tbody>

	</tbody>
</table>
</div>
</section>
</div>

<!DOCTYPE html>
<html>

