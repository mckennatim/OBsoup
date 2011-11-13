<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
  

  //DeleteData.php
  $id = $_REQUEST['id'] ;

  /* Delete a record by id */ 
mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");

$sql= "DELETE FROM roles 
WHERE rid = '$id'";
mysql_query($sql) or die("Dead inserting");

  echo "ok";