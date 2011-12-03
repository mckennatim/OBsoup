<?
session_start();
//require_once('auth.php');
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');

$id=$_SESSION['SESS_ID'];
$pid=$_REQUEST['pid'];
$pg=$_REQUEST['pg'];

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

$trying ="get profile"; fb($trying);
$sql="SELECT * FROM volunteers WHERE id = '".$id."' LIMIT 1";
fb($sql);
$result = mysql_query($sql) or die($trying);
$r = mysql_fetch_assoc($result);
$id = $r['id'];
$email = $r['email'];
$name = $r['name'];
$passwd = $r['passwd'];
$zipcode = $r['zipcode'];
$within = $r['within'];
$mobile = $r['mobile'];
$phone = $r['phone'];
$otheremail = $r['otheremail'];
$useemail = $r['useemail'];
$useoemail = $r['useoemail'];
$newpremail = $r['newpremail'];
$newprtxt = $r['newprtxt'];
$readyemail = $r['readyemail'];
$readytxt = $r['readytxt'];
$cancemail = $r['cancemail'];
$canctxt = $r['canctxt'];
$orgeachemail = $r['orgeachemail'];
$orgeachtxt = $r['orgeachtxt'];
$everytxt = $r['everytxt'];
$everyemail = $r['everyemail'];
$orgcancall = $r['orgcancall'];
$teamcancall = $r['teamcancall'];
$twitter = $r['twitter'];
$facebook = $r['facebook'];
//<tr><td></td><td></td><td></td><td><input type="submit" class="button" name="Submit" value="Save Profile" /></td></tr>

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
				<p align="right">
				
				<a href="soup.php">Home</a> | <a href="logout.php">Logout</a></p>
			</section>
		</header>
		<section class="round">
			<h1>My Profile </h1>
			<p>Hi <?=$_SESSION['SESS_NAME']?>. You can modify your information here. </p>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />

<form id="loginForm" name="loginForm" method="get" action="member-profile-exec.php">
<input type="hidden" name="pid" id="pid" value="<?=$pid?>"/>
<input type="hidden" name="pg" id="pg" value="<?=$pg?>"/>
<input type="hidden" name="id" id="id" rel="1" value="<?=$id?>" />
<input type="hidden" name="passwd" id="passwd" rel="1" value="<?=$passwd?>" />
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="0">


<tr><td><label>name: </label></td>
<td colspan="3"><input name="name" id="name" size="28" value="<?=$name?>"/>
</td><td><label>id: </label><?=$id?></td></tr>

<tr><td><label>email: </label></td>
<td colspan="3"><input name="email" id="email" size="28" value="<?=$email?>" /></td><td>
<!--<input type=checkbox name="useemail" id="useemail" size="1" 
<?//if ($useemail=='on') echo "checked=\"checked\"";?></>(use this)</td></tr>
<!--
<tr><td><label>other email: </label></td>
<td colspan="3"><input name="otheremail" id="otheremail" size="28" value="<?=$otheremail?>"/>
</td><td>
<input type=checkbox name="useoemail" id="useoemail" size="1" 
<?//if ($useoemail=='on') echo "checked=\"checked\"";?></>(use this)</td></tr>
-->
<tr><td colspan="5">check to
<input type=checkbox name="changepwd" id="changepwd" size="1" </>
change password to 
<input name="newpwd" id="newpwd" size="14"/>
</td>
</tr>

<tr><td colspan="5">Let me know about new projects within
<input name="within" id="within" size="1" class="cen" value="<?=$within?>"/> 
miles of my zipcode:<input name="zipcode" id="zipcode" size="5" class="cen" value="<?=$zipcode?>"/></td></tr>
<tr><td colspan="5">Contact me by...(actually only email works right now)</td></tr>

<tr><td align="right"><label>text</label></td><td><label>email</label></td><td><label>when</label></td></tr>
<tr><td align="right">
<input type=checkbox name="newprtxt" id="newprtxt" size="1" <?if ($newprtxt=='on') echo "checked=\"checked\"";?></>
</td><td>
<input type=checkbox name="newpremail" id="newpremail" size="1" <?if ($newpremail=='on') echo "checked=\"checked\"";?></>
</td><td>
new project starts
</td></tr>

<tr><td>
<input type=checkbox name="readytxt" id="readytxt" size="1" <?if ($readytxt=='on') echo "checked=\"checked\"";?></>
</td><td>
<input type=checkbox name="readyemail" id="readyemail" size="1" <?if ($readyemail=='on') echo "checked=\"checked\"";?></>
</td><td>
project is ready to start
</td></tr>

<tr><td>
<input type=checkbox name="canctxt" id="canctxt" size="1" <?if ($canctxt=='on') echo "checked=\"checked\"";?></>
</td><td>
<input type=checkbox name="cancemail" id="cancemail" size="1" <?if ($cancemail=='on') echo "checked=\"checked\"";?></>
</td><td>
project is cancelled
</td></tr>

<tr><td colspan="5">When I organize a project contact me when...</td></tr>

<tr><td>
<input type=checkbox name="orgeachtxt" id="orgeachtxt" size="1" <?if ($orgeachtxt=='on') echo "checked=\"checked\"";?></>
</td><td>
<input type=checkbox name="orgeachemail" id="orgeachemail" size="1" <?if ($orgeachemail=='on') echo "checked=\"checked\"";?></>
</td><td>
someone signs on to project
</td></tr>

<tr><td>
<input type=checkbox name="everytxt" id="everytxt" size="1" <?if ($everytxt=='on') echo "checked=\"checked\"";?></>
</td><td>
<input type=checkbox name="everyemail" id="everyemail" size="1" <?if ($everyemail=='on') echo "checked=\"checked\"";?></>
</td><td>
once everyone has signed up
</td></tr>


<tr><td><label>phone: </label></td>
<td colspan="3"><input name="phone" id="phone" size="14" value="<?=$phone?>"/></td></tr>

<tr>
<td><label>mobile: </label></td>
<td colspan="3"><input name="mobile" id="mobile" size="14" value="<?=$mobile?>"/></td>
</tr>

<td></td><td>
<input type=checkbox name="orgcancall" id="orgcancall" size="1" <?if ($orgcancall=='on') echo "checked=\"checked\"";?></>
</td><td colspan="2">
organizer can call me for project I'm on
</td></tr>

<td></td><td>
<input type=checkbox name="orgcancall" id="orgcancall" size="1" <?if ($orgcancall=='on') echo "checked=\"checked\"";?></>
</td><td colspan="2">
organizer can call me for project I'm on
</td></tr>
<tr><td colspan="4"><input type="submit" class="button" name="Submit" value="Save Profile" /></td></tr>
</table><table>
</form>
</div>
</section>
</div>
<html>


