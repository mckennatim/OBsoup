<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('isn killddead.php');



$trying ="kill project pid"; //fb($trying);
$sql = "SELECT `pid` FROM projects WHERE status='dead'";
$result = mysql_query($sql) or die($trying);
fb($sql);
while ($arow = mysql_fetch_assoc($result)){

	$pid = $arow['pid'];
	fb($pid);
	$trying ="kill project pid"; //fb($trying);
	$sql = "DELETE FROM projects WHERE pid='".$pid."'";
	$result = mysql_query($sql) or die($trying);
	mysql_fetch_assoc($result);
	fb($sql);
	$trying ="kill team pid"; //fb($trying);
	$sql = "DELETE FROM team WHERE pid='".$pid."'";
	$result = mysql_query($sql) or die($trying);
	mysql_fetch_assoc($result);
	header("location: soup.php");
}
//header("location: soup.php");
?>