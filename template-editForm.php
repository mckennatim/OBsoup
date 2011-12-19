<?php
$pid = $_REQUEST['pid'];
$title = $_REQUEST['title'];
$desc = $_REQUEST['desc'];
$info = $_REQUEST['info'];
$sitecontacts = $_REQUEST['sitecontacts'];
$link = $_REQUEST['link'];


?>

<form id="form1" name="Update" method="get" action="template-save.php">
	<h1>Edit this <input name="title" size="8" maxlength="8" value="<?php echo substr($title,0,8)?>"/>	template</h1>
	<input type="hidden" name="pid"  value="<?=$pid?>" />
	<label>link:</label>
	<input name="link" size="40" value="<?=$link?>"/><br/>
	<label>occupy contacts:</label>
	<input name="sitecontacts" value="<?=$sitecontacts?>"/>		<br/>
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
</form>


