<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('addYeamRec');
  
 
  $role = mysql_real_escape_string($_REQUEST['role']) ;
  $roledesc = mysql_real_escape_string($_REQUEST['roledesc']) ;
  $pid = mysql_real_escape_string($_REQUEST['pid']) ;


//fb($role);
//fb($roledesc);

$sql= "INSERT INTO team (`pid`, `role`, `roledesc`)
VALUES ('$pid', '$role', '$roledesc')"; 
//fb($sql);

mysql_query($sql) or die("Dead inserting");

echo mysql_insert_id();
?>