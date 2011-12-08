<?php
session_start();
include_once('dbinfo.php');
require_once('FirePHP.class.php');
require_once('fb.php');
ob_start(); //gotta have this
fb('in zcompl');

$zip=$_GET['zip'];

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");


$trying ="LOOKING UP Z IPCODE"; fb($trying);
$sql = "SELECT *
FROM zip_codes
WHERE zip = ".$zip ;
fb($sql);
$result = mysql_query($sql) or die($trying);


$row = mysql_fetch_assoc($result);
$ret['zip'] = $row['zip'];
$ret['value'] = $row['zip'];
$ret['city'] = $row['city'];
$ret['state'] = $row['state'];


/* Free connection resources. */
mysql_close();
fb(json_encode($ret));
echo json_encode($ret);
?>
