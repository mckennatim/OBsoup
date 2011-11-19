<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('how are you today');
  
// This is to collect box array value as global_variables is set off in PHP5 by default
$pid=$_REQUEST['pid'];
$vid=$_REQUEST['vid'];
$box=$_REQUEST['box'];
mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

$trying="remove vod as a volunteer";
$qry = "UPDATE team
SET `willdothis`=0, `id`=null	WHERE id='$vid' AND pid='$pid' "; 
fb($qry);
$roler = mysql_query($qry) or die($trying);

$trying= "re-add vid as a volunteer"; // for just the following:
fb($box);
while (list ($key,$val) = @each ($box)) {
	$qry = "UPDATE team
	SET `willdothis`=1, `id`='$vid'	WHERE trid='$val'"; 
	fb($qry);
	$roler = mysql_query($qry) or die($trying);
}
isTeamComplete($pid);
//ontime($pid); called by soup anyway
header("location: soup.php");
?>