<?php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($email == '') {
		$errmsg_arr[] = 'Email missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM volunteers WHERE email='$email' AND passwd='".md5($_POST['password'])."'";
	fb($qry);
	$result=mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_ID'] = $member['id'];
			$_SESSION['SESS_EMAIL'] = $member['email'];
			$_SESSION['SESS_NAME'] = $member['name'];
			fb($_SESSION['SESS_ID']);
			session_write_close();
			header("location: member-index.php");
			exit();
		}else {
			fb("Login failed");
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>