<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('how are you today');
$vol=$_SESSION['SESS_NAME'];
fb('the volid is '.$organizer);
function loginHeader(){
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
		//header("location: access-denied.php");
		//exit();
		$h= '<p align="right">Welcome '.$vol;
		$h.='Click here to <a href="soup-login.php">Login</a><p>';
	} else {
		$h='<p align="right"><a href="member-profile.php">My Profile</a> | 
		<a href="logout.php">Logout</a></p>';
	}
	return $h;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />		
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">
		<title>OB Soup</title>
        <script src="media/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.jeditable.js" type="text/javascript"></script>
        <script src="media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="media/js/jquery.validate.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.editable.js" type="text/javascript"></script>


<body> 
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
				<img src="images/soupbanner.jpg" alt="soup banner" /> 
				<?echo loginHeader();?>
			</section>
		</header>
		<section class="round">

		<big><a href="soup-createProject.php">Create a new project</a></big><br/>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />

<?=listProjects();?>
</div>
</section>
</div>

<!DOCTYPE html>
<html>

