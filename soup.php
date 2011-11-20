<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('in soup.php');
fb($_SESSION['SESS_NAME']);
$vol=$_SESSION['SESS_NAME'];
fb($vol);
$fname = explode(" ",$vol);
fb('the volid is '.$organizer);
function loginHeader(){
    global $vol;
	global $fname;
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
		//header("location: access-denied.php");
		//exit();
		$h= '<p align="right">Welcome '.$vol;
		$h.='Click here to <a href="soup-login.php">Login</a><p>';
	} else {
		$h='<p align="right">'.$vol.'  <a href="member-profile.php">My Profile</a> | 
		<a href="logout.php">Logout</a></p>';
	}
	return $h;
}
updateStatus();
fb("back from updateStatus");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />		
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />	
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
				<img src="images/soupbanner.jpg" class="stretch" alt="soup banner" /> 
				<?echo loginHeader();
				if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
					echo '<ul class="err">';
					foreach($_SESSION['ERRMSG_ARR'] as $msg) {
					    $nicemessage = "You can only edit project on which you are the organizer.
						You can organize your own project or Join a Team working on a project.";
						echo '<li>',$nicemessage,'</li>'; 
					}
					echo '</ul>';
					unset($_SESSION['ERRMSG_ARR']);
				}								
				?>
				
			</section>
		</header>
		<section class="round" id="border">

		<big><a href="soup-createProject.php">Create a new project</a></big><br/>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar"/>

<?=listProjects();?>
</div>
</section>
</div>

<!DOCTYPE html>
<html>

