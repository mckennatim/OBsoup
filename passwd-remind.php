<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email Reminder</title>
<link href="stylesheets/loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<p>&nbsp;</p>
<form id="loginForm" name="loginForm" method="post" action="passwd-send.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td width="112"><b>Email</b></td>
      <td width="188"><input name="email" size="35" type="text" class="textfield" id="email" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Get Password Reminder" /></td>
    </tr>
  </table>
</form>
</body>
</html>
