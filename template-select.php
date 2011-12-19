<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
require_once('auth.php');
ob_start(); //gotta have this
fb('now in select template Project');
$organizer = $_SESSION['SESS_NAME'];
$id = $_SESSION['SESS_ID'];
fb('id is '.$id);
fb('the volid is '.$organizer);

if (isset($_GET['pid'])) $pid = $_GET['pid'];

if (isset($_GET['vid'])) $vid = $_GET['vid'];

//fb('vid is '.$vid);
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

<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">

<title>hover change</title>

<script src="media/js/jquery-1.4.4.min.js" type = "text/javascript"> </script>

<script type="text/javascript" charset = "utf-8">
$(document).ready( function ()
{
    $(".prolist").mouseover(function() {
      $("#prodesc").html(this.id);
    });

});
</script>
</head>
<?php
$pros = array();
$prod = array();
$proid = array();
$trying = "listing proutlines"; //fb($trying);
$sql = "Select * FROM proutlines ORDER BY title";
$result = mysql_query($sql) or die($trying);

while ($arow = mysql_fetch_assoc($result))
{
    $pros[] = $arow['title'];
    $prod[] = $arow['description'];
    $proid[] = $arow['oid'];
}
fb($prod);
fb($prod[0]);
?>
<section class="round" >
<p><i>Select the type of project you would like to create, edit that template,  or create a new type</i></p>
<table width="50%" cellpadding="0" cellspacing="0" border="0" class="display" id="example" >
<thead>
<tr>
<th align="left">type</th>
<th>description </th>
</thead>
<tr><td>
<table>
<tbody>
<?php
for ($i=0;$i<sizeof($pros) ;$i++)
{
    echo '<tr><td title="hover for description, click to create project" id="'.$prod[$i].
    '" class="prolist" ><a href="soup-createProject.php?type='.$pros[$i].'&oid='.$proid[$i].
        '">'.$pros[$i].'</a></td><td><a class="edit_button round" href="template-edit.php?oid='.$proid[$i].'">Edit</a></td></tr>';
}
?>
</tbody>
</table>
</td><td id="prodesc" width="65%">do</td></tr>
<tr><td colspan="2"> or <a href="template-create.php">create a new project template</a></td></tr>
</tbody>
</table>

</section>
</div>
</body>
<html>
