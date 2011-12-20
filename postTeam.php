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
fb("pid is " . $pid);

fb($box);
while (list ($key,$val) = @each ($box)) {
	$qry = "UPDATE team
	SET `willdothis`=1, `id`='$vid'	WHERE trid='$val'"; 
	fb($qry);
	$roler = mysql_query($qry) or die("Dead finding units uid");
}

$thisurl = curPageURL();//in cpu
$purl = parse_url($thisurl);
//fb($purl);
$host = $purl['host'];
$whpath = $purl['path'];
//fb($whpath);
$pinfo = pathinfo($whpath);
//fb($pinfo);
$path = $pinfo['dirname'];
//fb($path);
$baseurl = "http://" . $host . $path . "/";

$trying ="get organizer data"; //fb($trying);
$sql = "SELECT `pid`, `vid`,  `email`
FROM projects  
LEFT JOIN volunteers
ON volunteers. id = projects.vid
WHERE pid=". $pid . "  LIMIT 1";
fb($sql);
$result = mysql_query($sql) or die($trying);
$vinfo = mysql_fetch_assoc($result);
$from =$vinfo['email'];

//who to notify
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' . $from . "\r\n";

//notify the organizer
$orgmessage="Someone just signed up for your project. You can see their contact info here: "
	  . $baseurl . "soup-teamContacts.php?pid=" . $pid ;

fb($from . $orgmessage);

mail($from, "new volunteer for your new project", $orgmessage, $headers);

isTeamComplete($pid);
//ontime($pid); its called by soup anyway
//header("location: soup.php");
?>