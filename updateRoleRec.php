<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('update Role Rec');
  
  $id = $_REQUEST['id'] ;
  $value = mysql_real_escape_string($_REQUEST['value']) ;
  $column = $_REQUEST['columnName'] ;
//  $columnPosition = $_REQUEST['columnPosition'] ;
//  $columnId = $_REQUEST['columnId'] ;
//  $rowId = $_REQUEST['rowId'] ;

fb($column);
//fb($columnPosition);
//fb($columnid);

$sql= "UPDATE roles
SET `$column`='$value'
WHERE rid='$id'"; 
fb($sql);
mysql_query($sql) or die("Dead updating");

  /* Update a record using information about id, columnName (property
     of the object or column in the table) and value that should be
     set */ 
  echo $value;

?>