<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('how are you today');

$pid=$_GET[pid];

$trying ="kill project pid"; //fb($trying);
$sql = "DELETE FROM projects WHERE pid='".$pid."'";
$result = mysql_query($sql) or die($trying);
mysql_fetch_assoc($result);

$trying ="kill team pid"; //fb($trying);
$sql = "DELETE FROM team WHERE pid='".$pid."'";
$result = mysql_query($sql) or die($trying);
mysql_fetch_assoc($result);
header("location: soup.php");
?>