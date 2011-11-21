<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in cpu');

exec(notify-saveProject.php);
$pid=$_GET[pid];

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

fb( "some project named ".$pid. " just got created, time to notify the volunteers");
//who to notify
//notify the organizer


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: mckenna.tim@gmail.com' . "\r\n";
$thisurl = curPageURL();

$purl = parse_url($thisurl);
//fb($purl);
$host = $purl['host'];
$whpath = $purl['path'];
//fb($whpath);
$pinfo = pathinfo($whpath);
//fb($pinfo);
$path = $pinfo['dirname'];
//fb($path);
$joinurl = "http://".$host.$path."/soup-joinTeam.php?pid=".$pid;
$homeurl = "http://".$host.$path."/soup.php";


$trying ="get team emails"; //fb($trying);	
$sql = "SELECT `email` FROM volunteers
WHERE newpremail = 'on'";	
fb($sql);
$result = mysql_query($sql) or die($trying);

$tmessage = "There is a new Soup project starting. \r\n If you are interested in
perhaps volunteering check it out here at ".$joinurl.". The listing of all projects is 
on the home page: ".$homeurl  ;
while ($trow = mysql_fetch_assoc($result)) {
	fb($trow['email']);
	mail($trow['email'], 'new soup project starting', $tmessage, $headers);
}
	
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}	
header("location: soup.php");
?>