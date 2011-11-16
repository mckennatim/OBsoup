<?php
	//Start session
session_start();
function lginHeader(){
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
		//header("location: access-denied.php");
		//exit();
		$h= '<p align="center">Click here to <a href="soup-login.php">Login</a></p>';
	} else {
		$h='<a href="member-profile.php">My Profile</a> | <a href="logout.php">Logout</a>';
	}
	return $h;
}
echo lginHeader();
?>