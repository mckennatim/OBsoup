<?php 
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');

$pid= $_GET[pid];
$projdate= $_GET[projdate];
$leadtime= $_GET[leadtime];
$location= $_GET[location];
$organizer= $_GET[organizer];
$desc= $_GET[desc];
$info= $_GET[info];

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");

$sql= "UPDATE projects
SET `projdate`= '$projdate',
`leadtime`= '$leadtime',
`location`= '$location',
`organizer`= '$organizer',
`description`= '$desc',
`info`='$info'
WHERE pid='$pid'"; 
fb($sql);
mysql_query($sql) or die("Dead updating");
?>
