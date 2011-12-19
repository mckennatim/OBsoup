<?
session_start();

include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('in post team');
  
$pid=$_REQUEST['pid'];
$pg=$_REQUEST['pg'];

require_once('auth.php');

$vid=$_SESSION['SESS_ID'];
$box=$_REQUEST['box'];
fb("pid is ".$pid);

fb($box);
while (list ($key,$val) = @each ($box)) {
	$qry = "UPDATE team
	SET `willdothis`=1, `id`='$vid'	WHERE trid='$val'"; 
	fb($qry);
	$roler = mysql_query($qry) or die("Dead finding units uid");
}
isTeamComplete($pid);
//ontime($pid); its called by soup anyway
header("location: soup.php");
?>