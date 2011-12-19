<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('how are you today');

$pid= $_GET['pid'];
$vid= $_GET['vid'];
$oid= $_GET['oid'];
$projdate= mdate($_GET['projdate']);
$leadtime= mysql_real_escape_string($_GET['leadtime']);
$location= mysql_real_escape_string($_GET['location']);
$organizer= mysql_real_escape_string($_GET['organizer']);
$desc= mysql_real_escape_string($_GET['desc']);
$info= mysql_real_escape_string($_GET['info']);
$sitecontacts= mysql_real_escape_string($_GET['sitecontacts']);
$link= mysql_real_escape_string($_GET['link']);
$zipcode= mysql_real_escape_string($_GET['zipcode']);
$title= mysql_real_escape_string($_GET['title']);

isTeamComplete($pid);
ontime($pid);

//mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't connect");
//mysql_select_db (DB_DATABASE) or die("db unavailable");

$sql= "INSERT INTO `projects`
(`pid`, `projdate`, `leadtime`, `location`, `organizer`, `description`, `sitecontacts`,
`link`, `vid`, `oid`, `zipcode`, `title`, `info` ) VALUES
('$pid', '$projdate', '$leadtime', '$location', '$organizer', '$desc', '$sitecontacts',
'$link', '$vid', '$oid', '$zipcode', '$title', '$info')";
fb($sql);
mysql_query($sql) or die("Dead inserting new project");
header("location: notify-yesno.php?pid=".$pid);
?>
