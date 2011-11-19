<?php 
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('how are you today');

$id = $_GET[id];
$email = $_GET[email];
$name = $_GET[name];
$passwd = $_GET[passwd];
$zipcode = $_GET[zipcode];
$within = $_GET[within];
$mobile = $_GET[mobile];
$phone = $_GET[phone];
$otheremail = $_GET[otheremail];
$useemail = $_GET[useemail];
$useoemail = $_GET[useoemail];
$newpremail = $_GET[newpremail];
$newprtxt = $_GET[newprtxt];
$readyemail = $_GET[readyemail];
$readytxt = $_GET[readytxt];
$cancemail = $_GET[cancemail];
$canctxt = $_GET[canctxt];
$orgeachemail = $_GET[orgeachemail];
$orgeachtxt = $_GET[orgeachtxt];
$everytxt = $_GET[everytxt];
$everyemail = $_GET[everyemail];
$orgcancall = $_GET[orgcancall];
$teamcancall = $_GET[teamcancall];

$changepwd = $_GET[changepwd];
$newpwd = $_GET[newpwd];

if ($newpwd==1){
	$passwd=md5($newpwd);
}
mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

$trying ="update profile"; fb($trying);
$sql="UPDATE volunteers SET
`email` = '$email',
`name` = '$name',
`passwd` = '$passwd',
`zipcode` = '$zipcode',
`within` = '$within',
`mobile` = '$mobile',
`phone` = '$phone',
`otheremail` = '$otheremail',
`useemail` = '$useemail',
`useoemail` = '$useoemail',
`newpremail` = '$newpremail',
`newprtxt` = '$newprtxt',
`readyemail` = '$readyemail',
`readytxt` = '$readytxt',
`cancemail` = '$cancemail',
`canctxt` = '$canctxt',
`orgeachemail` = '$orgeachemail',
`orgeachtxt` = '$orgeachtxt',
`everytxt` = '$everytxt',
`everyemail` = '$everyemail',
`orgcancall` = '$orgcancall',
`teamcancall` = '$teamcancall'
WHERE id = '$id'";
fb($sql);
$result = mysql_query($sql) or die($trying);
header("location: soup.php");