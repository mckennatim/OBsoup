<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
//require_once('tm/cpu.php');

ob_start(); //gotta have this
fb('how are you today');

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

//$oid =145;
//$pid = copyOutl ine($oid);
//copyRoles($$pid);

//displayProject($pid);
$pid = 1;

$qry = "SELECT *
FROM projects  
WHERE pid='$pid' limit 1";
fb($qry);
$result = mysql_query($qry) or die("Dead finding units uid");
$row = 	$arow = mysql_fetch_assoc($result);
$projdate = $row['projdate'];
$leadtime = $row['leadtime'];
$location = $row['location'];
$organizer = "Fred Flintstone";
$desc = $row['description'];
$info = $row['info'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />	
</head>
<body>
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
				<img src="images/soupbanner.jpg" alt="soup banner" /> 
			</section>
		</header>
		<section class="round">
			<h1>Create a <?echo $title ?> project</h1>
			<form id="form1" name="Update" method="get" action="saveProject.php">			
				<label>project date:</label>
				<input name="projdate" value="<?=$projdate?>"/>
				
				<label>lead time:</label>
				<input name="leadtime" value="<?=$leadtime?>"/>
				<br />
				
				<label>location:</label><br/>
				<textarea name="location" cols="40" rows="3"> <?=$location?></textarea>
				<label>organizer:</label>
				<input name="organizer" value="<?=$organizer?>"/>
			

				<br />
				<label>description:</label><br/>
				<textarea name="desc" cols="50" rows="3"> <?=$desc?></textarea>
				<br />
				<label>info:</label><br/>
				<textarea name="info" cols="50" rows="3"> <?=$info?></textarea>
				<br />
				<?="duck"?>
				<br />
				<input class="signup_button round" type="submit" value="send your info" />
			</form>		
		</section>
	</div>
</body>
</html>
