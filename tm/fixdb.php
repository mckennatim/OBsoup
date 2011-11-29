<?php 
session_start();
include_once('dbinfo.php');
require_once('FirePHP.class.php');
require_once('fb.php');
ob_start(); //gotta have this
fb('in cpu');

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

$trying ="getting new volunteers"; //fb($trying);
$sql = "Select * FROM  OBsoupVolunteers";
fb($sql);
$result = mysql_query($sql) or die($trying);	

while ($arow = mysql_fetch_assoc($result)) {
	$email = $arow['email'];
	$name = $arow['name'];
	$password = md5($arow['password']);
	$trying ="add  volunteers"; //fb($trying);
	$sql =" INSERT INTO `volunteers` (`email`, `name`, `passwd`) 
	VALUES ('$email', '$name', '$password')";
	fb($sql);
	mysql_query($sql) or die($trying);	
}

?>