<?php 
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('how are you today');

$pid= $_GET[pid];
$vid= $_GET[vid];
$projdate= $_GET[projdate];
$leadtime= $_GET[leadtime];
$location= $_GET[location];
$organizer= $_GET[organizer];
$desc= $_GET[desc];
$info= $_GET[info];
$sitecontacts= $_GET[sitecontacts];
$link= $_GET[link];
$zipcode= $_GET[zipcode];
$title= $_GET[title];

isTeamComplete($pid);
ontime($pid);

//mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't connect");
//mysql_select_db (DB_DATABASE) or die("db unavailable");

$sql= "INSERT INTO `projects`  
(`pid`, `projdate`, `leadtime`, `location`, `organizer`, `description`, `sitecontacts`,
`link`, `vid`, `zipcode`, `title`, `info` ) VALUES
('$pid', '$projdate', '$leadtime', '$location', '$organizer', '$desc', '$sitecontacts', 
'$link', '$vid', '$zipcode', '$title', '$info')"; 
fb($sql);
mysql_query($sql) or die("Dead inserting new project");
header("location: notify-yesno.php?pid=".$pid);
?>
