<?php
session_start();

$qstr='?pg='.$pg.'&pid='.$pid;
fb('in auth with qstr='.$qstr);
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
	header("location: access-denied.php".$qstr);
	exit();
}
?>