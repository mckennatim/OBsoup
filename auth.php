<?php
$qstr='';
if (isset($pid)) $qstr='?pid='.$pid;
if (isset($pg)) $qstr.='&pg='.$pg;

fb('in auth with qstr='.$qstr);
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
	header("location: access-denied.php".$qstr);
	exit();
}?>
