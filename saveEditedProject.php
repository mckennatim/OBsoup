<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('how are you today');

if (isset($_GET['pid'])) $pid= $_GET['pid'];
if (isset($_GET['vid'])) $vid= $_GET['vid'];
$oid= $_GET['oid'];
if (isset($_GET['projdate'])) $projdate= mdate($_GET['projdate']);
if (isset($_GET['pid'])) $leadtime= $_GET['leadtime'];
$location= mysql_real_escape_string($_GET['location']);
$organizer= mysql_real_escape_string($_GET['organizer']);
$desc= mysql_real_escape_string($_GET['desc']);
$info= mysql_real_escape_string($_GET['info']);
$sitecontacts= mysql_real_escape_string($_GET['sitecontacts']);
$link= mysql_real_escape_string($_GET['link']);
$zipcode= $_GET['zipcode'];
$title= mysql_real_escape_string($_GET['title']);

isTeamComplete($pid);
ontime($pid);

//mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't connect");
//mysql_select_db (DB_DATABASE) or die("db unavailable");

$sql= "UPDATE projects
SET `projdate`= '$projdate',
`leadtime`= '$leadtime',
`location`= '$location',
`organizer`= '$organizer',
`description`= '$desc',
`sitecontacts`= '$sitecontacts',
`link`= '$link',
`vid`= '$vid',
`oid`= '$oid',
`zipcode`= '$zipcode',
`title`= '$title',
`info`='$info'
WHERE pid='$pid'";
fb($sql);
mysql_query($sql) or die("Dead inserting");
header("location: notify-yesno.php?pid=".$pid);
?>
