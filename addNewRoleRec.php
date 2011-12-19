<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('add role rec');
  
 
  $role = mysql_real_escape_string($_REQUEST['role']) ;
  $roledesc = mysql_real_escape_string($_REQUEST['roledesc']) ;
//  $oid = mysql_real_escape_string($_REQUEST['oid']) ;

//fb($oid);
//fb($role);
//fb($roledesc);

$sql= "INSERT INTO roles (`oid`, `role`, `roledesc`)
VALUES (2, '$role', '$roledesc')"; 
fb($sql);

mysql_query($sql) or die("Dead inserting");

echo mysql_insert_id();
?>