<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
  
 
  $role = $_REQUEST['role'] ;
  $roledesc = $_REQUEST['roledesc'] ;
  $pid = $_REQUEST['pid'] ;


fb($role);
fb($roledesc);

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");
$sql= "INSERT INTO team (`pid`, `role`, `roledesc`)
VALUES ('$pid', '$role', '$roledesc')"; 
fb($sql);

mysql_query($sql) or die("Dead inserting");

echo mysql_insert_id();
?>