<?
echo header("Content-type: text/plain");
session_start();
include_once('dbinfo.php');
require_once('FirePHP.class.php');
require_once('fb.php');
ob_start(); //gotta have this
fb('how are you today');

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	


function createUpdateTable($table){
	$sql="SELECT * FROM ".$table ;
	$res = mysql_query('$sql');
	$field_names = array_keys( mysql_fetch_array( mysql_query($sql), MYSQL_ASSOC)); 
	fb($field_names);
	$fn="";
	$gn="";
	$vn="";
	$eq="";
	$sq="";
	foreach ($field_names as $row){
		$fn.= $row."\n";
		$gn.= "\$_GET('".$row."')\n";
		$vn.= "$".$row."\n";
		$en.= "$".$row."$_GET('".$row."')\n";
		//$fn.= $row."\n";
		//$fn.= $row."\n";		
		}
	echo $fn;
	echo $gn;
	//echo $vn;
	//echo $eq;
	//echo $sq;	
}
createUpdateTable('volunteers');
?>
