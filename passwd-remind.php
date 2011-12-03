<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
$pid=$_REQUEST['pid'];
$pg=$_REQUEST['pg'];
$qstr = '?pg='.$pg.'&pid='.$pid;
fb($qstr);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />		

<body> 
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
				<a href="soup.php"><img src="images/soupbanner.jpg" class="stretch" alt="soup banner" /></a>
			</section>
		</header>
<section class="round">
<?
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
<p>&nbsp;</p>

<form id="loginForm" name="loginForm" method="get" action="passwd-send.php">
	<input type="hidden" name="pg" id="pg" value="<?=$pg?>"/>	
	<input type="hidden" name="pid" id="pid" value="<?=$pid?>"/>
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td width="112"></td>
      <td width="188"><b>Email: </b><input name="email" size="35" type="text" class="textfield" id="email" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="button" name="Submit" value="get new password" /></td>
    </tr>
  </table>
</form>			
</section>
	</div>

<div class="container">
<section class="round">

</section>
</div>

