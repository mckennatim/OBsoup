<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
require_once('auth.php');
ob_start(); //gotta have this
fb('now in soup-editProject');
$organizer=$_SESSION['SESS_NAME'];
$id=$_SESSION['SESS_ID'];
fb('id is '.$id);
fb('the volid is '.$organizer);
$oid=$_GET['oid'];


$trying ="get roles for oid "; //fb($trying);
$sql = "SELECT * FROM proutlines WHERE oid=".$oid;
fb($sql);
$result = mysql_query($sql) or die($trying);
$r = mysql_fetch_assoc($result);
	$oid = $r['oid'];
	$title = $r['title'];
	$desc = $r['description'];
	$info = $r['info'];
	$sitecontacts = $r['sitecontacts'];
	$link = $r['link'];
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">

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
					"sAjaxSource": "getTemplate.php?oid=<?php echo $oid; ?>",
					aoColumns: [ { "bVisible": false}, {"bVisible": false}, null, null]
						 })
						 .makeEditable({
							sUpdateURL: "updateRoleRec.php",
							sAddURL: "addRoleRec.php",
							sAddHttpMethod: "GET", 
							sDeleteURL: "deleteRoleRec.php",
							sDeleteHttpMethod: "GET"
				});
			});

		</script>
	</head>
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
			<div id="eform">
<form id="form1" name="Update" method="get" action="template-save.php">
	<h1>Edit this <input name="title" size="8" maxlength="8" value="<?php echo substr($title,0,8)?>"/>	template</h1>
	<input type="hidden" name="oid"  value="<?=$oid?>" />
	<label>link:</label>
	<input name="link" size="40" value="<?=$link?>"/><br/>
	<label>occupy contacts:</label>
	<input name="sitecontacts" value="<?=$sitecontacts?>"/>oid: <?php echo $oid; ?>		<br/>
	<br />
	Change any of the following text to make a general template.<br/>
	<label>description:</label><br/>
	<textarea name="desc" cols="50" rows="3"><?=$desc?></textarea>
	<br />
	<label>info:</label><br/>
	<textarea name="info" cols="50" rows="3"><?=$info?></textarea>
	<br />
	<input class="notify_button round" type="submit" value="Save your edited template" title
	="this saves your editied project"/><br/>
		<div id="eproj"><a href="template-delete.php?oid=<?php echo $oid; ?>" id="aeproj" class="notify_button round"
		title="only click here if you want to delete this project template">
		Delete this Template</a></div><br />
</form>
<form id="formAddNewRow" action="#" title="Add new record">
        <input type="hidden" name="rid" id="id" rel="0" value="DATAROWID" />
        <input type="hidden" name="oid" id="oid" rel="1" value="<?php echo $oid; ?>" />
        <label for="name">role</label><br />
	<input type="text" name="role" id="role" rel="2" />
        <br />
        <label for="name">roledesc</label><br />
	<textarea name="roledesc" id="roledesc" rel="3"></textarea>
</form>
<div class="container">
<section class="round">
Edit cells by double clicking, plus you can add or delete roles for your project.
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<div class="add_delete_toolbar" />
	<thead>
		<tr>
			<th>rid</th>
			<th>oid</th>
			<th>role</th>
			<th>roledesc</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>rid</th>
			<th>oid</th>
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

</body>
</html>
<strong></strong>