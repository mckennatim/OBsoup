<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in notify-volunteers');
include('/tm/WikiBot.php');
$sourceurl=$_POST[sourceurl]; //pathboston.com/hum310 
$desturl=$_POST[desturl]; //pathboston.com or localhost:8888/hosted
$wikipage=$_POST[wikipage];
$descr=$_POST[descr];
$course=$_POST[course];
$schyr=$_POST[schyr];
$update=$_POST[update];
$user="tim";
$pword="nji9ol";

$sourcepage = "User:".$course."/".$wikipage;//User:hum2/economics
//http://tim:nj@sitebuilt.net/wuff/index.php?title=Economics&action=raw&ctype=text/javascript
//http://pathboston.com/hum310/index.php?title=Economics&action=raw&ctype=text/javascript
$url="http://".$user.":".$pword."@".$sourceurl."/index.php?title=".$sourcepage."&action=raw&ctype=text/javascript";
fb($url);
$gotpage = file_get_contents($url) or die ("ERROR: Unable to read file");
echo($gotpage);
//get password
$fhpw = fopen("password.txt", 'r') or die("Can't open password file");
$password = fgets($fhpw);
fclose($fhpw);
$pagelink = "==".$descr." [[/".$wikipage."]]==
";
//create bot
$botname = "TimBot"; //A registered username
//$wiki = "http://localhost:8888/hosted/hum211/";
$wiki = "http://".$desturl."/".$course.$schyr."/";
$sourcewiki = "http://".$sourceurl."/"; //http://pathboston.com/hum310/
fb($wiki);
$uquery="api.php?action=query&list=allusers&aulimit=100";
echo("about to new");
$MyBot = new Wikibot($botname, $password, $wiki);
echo("MyBot is in");
echo($sourcewiki);
//$getBot = new Wikibot($username, $password, $sourcewiki);
//$gotpage = $getBot->get_page($sourcepage);
$users = $MyBot->get_users();
fb($users);
print_r($users['query']['allusers']);
foreach ($users['query']['allusers'] as $userarray){
	foreach($userarray as $key =>$value){
		$userName="User:".$value;
		$newpage=$userName."/".$wikipage;
		$expage = $MyBot->get_page($userName);
		$expage = $pagelink . $expage;
		if ($update==1){
			$MyBot->edit_page($userName,$expage,"adding link to user page");			
			$MyBot->create_page($newpage,$gotpage,"adding subpage to user page");		
		}elseif ($update==2){			
			$MyBot->create_page($newpage,$gotpage,"adding subpage to user page");	
		}else{
			$MyBot->edit_page($newpage,$gotpage,"editing subpage of user page");			
		}
	}	
}
?>
