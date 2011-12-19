<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
require_once('auth.php');
ob_start(); //gotta have this
fb('now in template-delete');
$organizer=$_SESSION['SESS_NAME'];
$id=$_SESSION['SESS_ID'];
fb('id is '.$id);
fb('the volid is '.$organizer);
$oid=$_GET['oid'];

$trying = "delete proutline";
$sql="DELETE FROM proutlines WHERE oid ='".$oid."'";
fb($sql);
mysql_query($sql) or die($trying);

$trying = "delete roles for oid";
$sql="DELETE FROM roles WHERE oid ='".$oid."'";
fb($sql);
mysql_query($sql) or die($trying);

header("location: soup.php");
?>