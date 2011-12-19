<?php
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in template-save');

$pid = mysql_real_escape_string($_REQUEST['pid']);
$title = mysql_real_escape_string($_REQUEST['title']);
$description = mysql_real_escape_string($_REQUEST['desc']);
$info = mysql_real_escape_string($_REQUEST['info']);
$sitecontacts = mysql_real_escape_string($_REQUEST['sitecontacts']);
$link = mysql_real_escape_string($_REQUEST['link']);

$trying ="new template "; //fb($trying);
$sql = "INSERT INTO proutlines (`title`, `description`, `info`, `sitecontacts`, `link`)
 VALUES ('$title', '$description', '$info', '$sitecontacts', '$link')";
//fb($sql);
mysql_query($sql) or die($trying);
$oid= mysql_insert_id();

$trying ="update oid "; //fb($trying);
$sql = "UPDATE `roles` SET `oid` = '$oid' WHERE `oid`=2"; 
mysql_query($sql) or die($trying);

header("location: soup.php");

?>