<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
  
// This is to collect box array value as global_variables is set off in PHP5 by default
$vid=$_REQUEST['vid'];
$box=$_REQUEST['box'];

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

while (list ($key,$val) = @each ($box)) {
	$qry = "UPDATE team
	SET `willdothis`=1, `id`='$vid'	WHERE trid='$val'"; 
	fb($qry);
	$roler = mysql_query($qry) or die("Dead finding units uid");
}
echo "OK";
?>