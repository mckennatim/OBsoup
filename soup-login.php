<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
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
			</section>
		</header>
		<section class="round">
			<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
			<table width="200" border="0" align="center" cellpadding="2" cellspacing="0">
			<tr>
			<td width="80"><b></b></td>
			<td width="40">Email:</td><td>     <input name="email" size="30" type="text" class="textfield" id="email" /></td>
			</tr>
			<tr>
			<td><b></b></td>
			<td>Password:</td><td>  <input name="password" type="password" class="textfield" id="password" /></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td><input type="submit" class="button" name="Submit" value="Login" /></td>
			</tr>
			</table>
			</form>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />


</div>
</section>
</div>
<html>


<?
/*
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Form</title>
<link href="stylesheets/loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<p>&nbsp;</p>
<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td width="112"><b>Email</b></td>
      <td width="188"><input name="email" type="text" class="textfield" id="email" /></td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><input name="password" type="password" class="textfield" id="password" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html>
*/
?>
