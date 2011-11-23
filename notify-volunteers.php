<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in notify-volunteers');
fb($_POST);
$pid=$_POST[pid];
$emails=$_POST[emails];
$from=$_POST[from];
$friend=$_POST[friend];
$subject=$_POST[subject];
$everyone=$_POST[everyone];
$frev = $friend.$everyone;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from. "\r\n";
if (strlen($emails)>5){
	mail($emails, $subject, $frev, $headers);
}

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

fb( "some project named ".$pid. " just got created, time to notify the volunteers");
//who to notify
//notify the organizer

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from. "\r\n";

$trying ="get team emails"; //fb($trying);	
$sql = "SELECT `email` FROM volunteers
WHERE newpremail = 'on'";	
fb($sql);
$result = mysql_query($sql) or die($trying);


while ($trow = mysql_fetch_assoc($result)) {
	fb($trow['email']);
	mail($trow['email'], $subject, $everyone, $headers);
}
fb("done");
fb("location: soup.php");

header("location: soup.php");
?>