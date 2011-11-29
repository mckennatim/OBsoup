<?php
require_once("includes/config.php");

if(isset($installed))
{
	echo 'You have already installed the Calendar, Please delete the install.php file.';
	exit;
}

$errors = array();

IF(!is_writable('includes/config.php'))
{
	$errors[] = 'CHMOD includes/config.php to 0777';
}

if(count($errors)>0)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>PHPCalendar - Install</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style4 {color: #FF0000}
-->
</style>
</head>

<body>
<div align="center">
  <br>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><span class="style3"><span class="style4">Please correct the following problems:</span> <br>
<?
foreach ($errors as $value) 
{
?>
		<br>- <?=$value;?>
<?
}
?>
		</span></td>
    </tr>
  </table>
  <span class="footer style1"><br>
  <br>
  <br>
  &copy; 2006 <a href="http://www.kubelabs.com/php_calendar.php">Kubelabs.com</a></span>
</div>
</body>
</html>
<?
	exit;
}

if(isset($_POST['Submit']))
{
	IF(@mysql_connect($_POST['DBHost'], $_POST['DBUser'], $_POST['DBPass']))
	{
		if(@mysql_select_db($_POST['DBName']))
		{
			mysql_query("CREATE TABLE `calendar_admins` ( `admin_id` mediumint(8) unsigned NOT NULL auto_increment,  `admin_username` varchar(40) NOT NULL default '',  `admin_password` varchar(40) NOT NULL default '',  PRIMARY KEY  (`admin_id`)) TYPE=MyISAM AUTO_INCREMENT=1 ;");
			mysql_query("CREATE TABLE `calendar_events` ( `event_id` int(5) unsigned NOT NULL auto_increment,  `event_day` int(2) NOT NULL default '0',  `event_month` int(2) NOT NULL default '0',  `event_year` int(4) NOT NULL default '0',  `event_time` varchar(5) NOT NULL default '',  `event_title` varchar(200) NOT NULL default '',  `event_desc` text NOT NULL,  PRIMARY KEY  (`event_id`)) TYPE=MyISAM AUTO_INCREMENT=1 ;");
			mysql_query("INSERT INTO `calendar_admins` ( `admin_id` , `admin_username` , `admin_password` ) VALUES ('', '".addslashes($_POST['adminuser'])."', '".addslashes(md5($_POST['adminpass']))."');");

			$content = '<?';
			$content.= "\n";
			$content.= "\$version = \"2.0\";\n";
			$content.= "\$installed = 1;\n";
			$content.= "\$use_auth = ".addslashes($_POST['auth']).";\n";
			$content.= "\n";
			$content.= "// MYSQL DB INFO\n";
			$content.= "\$DBHost = \"".addslashes($_POST['DBHost'])."\";\n";
			$content.= "\$DBName = \"".addslashes($_POST['DBName'])."\";\n";
			$content.= "\$DBUser = \"".addslashes($_POST['DBUser'])."\";\n";
			$content.= "\$DBPass = \"".addslashes($_POST['DBPass'])."\";\n";
			$content.= "\$TBL_PR = \"calendar_\";\n";
			$content.= '?>';

			$handle = @fopen('includes/config.php', 'w');
			@fwrite($handle, $content);
			@fclose($handle);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>PHPCalendar - Install</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style17 {font-size: 12px}
-->
</style>
</head>

<body>
<div align="center">
  <span class="style16"><br>
  Please delete install.php and <a href="index.php">click here</a> to continue.
  </span><span class="footer style1 style17"></span><span class="footer style1"><br>
  <br>
  <br>
  &copy; 2006 <a href="http://www.kubelabs.com/php_calendar.php">Kubelabs.com</a></span>
</div>
</body>
</html>
<?
			exit;
		}
		else
		{
			echo '<script>alert(\'Could not find database '.$_POST['DBName'].'\r\n\r\n'.addslashes(mysql_error()).'\');</script>';
		}
	}
	else
	{
			echo '<script>alert(\'Could not connect to MySQL using these details.\r\n\r\n'.addslashes(mysql_error()).'\');</script>';
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>PHPCalendar - Install</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<body>
<div align="center">
  <br>
  <form name="form1" method="post" action="">
    <table border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td colspan="3"><span class="style15">MySQL Details</span></td>
      </tr>
      <tr>
        <td><span class="style12">MySQL Host: </span></td>
        <td><input style="width:150px;" name="DBHost" type="text" id="DBHost" value="<? if(isset($_POST['DBHost'])){ echo $_POST['DBHost']; } ELSE { echo 'localhost'; } ?>"></td>
        <td><span class="style12">&nbsp;<a href="javascript:alert('The host address of your MySQL database, usually localhost');">(?)</a> </span></td>
      </tr>
      <tr>
        <td><span class="style12">MySQL Username:</span></td>
        <td><input style="width:150px;" name="DBUser" type="text" id="DBUser" value="<? if(isset($_POST['DBUser'])){ echo $_POST['DBUser']; } ?>"></td>
        <td><span class="style12">&nbsp;<a href="javascript:alert('The username used to access your MySQL database');">(?)</a> </span></td>
      </tr>
      <tr>
        <td><span class="style12">MySQL Password:</span></td>
        <td><input style="width:150px;" name="DBPass" type="password" id="DBPass" value="<? if(isset($_POST['DBPass'])){ echo $_POST['DBPass']; } ?>"></td>
        <td><span class="style12">&nbsp;<a href="javascript:alert('The password used to access your MySQL database');">(?)</a> </span></td>
      </tr>
      <tr>
        <td><span class="style12">MySQL Database Name: </span></td>
        <td><input style="width:150px;" name="DBName" type="text" id="DBName" value="<? if(isset($_POST['DBName'])){ echo $_POST['DBName']; } ?>"></td>
        <td><span class="style12">&nbsp;<a href="javascript:alert('The name of your database, you must have first created this.');">(?)</a> </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><span class="style15">Admin Details </span></td>
      </tr>
      <tr>
        <td><span class="style12">Allow anyone to Add Events: </span></td>
        <td><select name="auth" style="width:150px;">
          <option value="0" selected>Yes</option>
          <option value="1">No</option>
        </select></td>
        <td><span class="style12">&nbsp;<a href="javascript:alert('Can anyone post new events?');">(?)</a> </span></td>
      </tr>
      <tr>
        <td><span class="style12">Admin Username: </span></td>
        <td><input style="width:150px;" name="adminuser" type="text" id="adminuser" value="<? if(isset($_POST['adminuser'])){ echo $_POST['adminuser']; } ?>"></td>
        <td><span class="style12">&nbsp;<a href="javascript:alert('The username that will be used when adding and deleting events');">(?)</a> </span></td>
      </tr>
      <tr>
        <td><span class="style12">Admin Password: </span></td>
        <td><input style="width:150px;" name="adminpass" type="password" id="adminpass" value="<? if(isset($_POST['adminpass'])){ echo $_POST['adminpass']; } ?>"></td>
        <td><span class="style12">&nbsp;<a href="javascript:alert('The password that will be used when adding and deleting events');">(?)</a> </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input style="width:150px;" name="Submit" type="submit" value="Install"></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
  <span class="footer style1"><br>
  <br>
  <br>
  &copy; 2006 <a href="http://www.kubelabs.com/php_calendar.php">Kubelabs.com</a></span>
</div>
</body>
</html>