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

$sql= "DELETE FROM roles 
WHERE rid = '$id'";
mysql_query($sql) or die("Dead inserting");

  echo "ok";