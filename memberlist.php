<?php
//header("Content-type: text/plain");
session_start();
//require_once('auth.php');
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb("in memberlist");
	

	
	$qry="SELECT * FROM volunteers WHERE id>9";
	fb($qry);
	$result=mysql_query($qry);
	
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
				<a href"soup.php"><img src="images/soupbanner.jpg" alt="soup banner" /></a>
			</section>
		</header>
		<section class="round">
			
		</section>
	</div>

<div class="container">
<section class="round">
<table>
<tbody>
<?php
while ($row=mysql_fetch_assoc($result)){
	echo "<tr><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td></tr>";
}
?>
</tbody
</table
</section>
</div>

<!DOCTYPE html>
<html>
