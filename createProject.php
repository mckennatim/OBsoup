<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
$errmsg_arr = array();
$errflag = false;

$title=$_GET[title];
$title = "soup";

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$qry = "SELECT *
FROM prOutlines  
WHERE title='$title' limit 1";
fb($qry);
$result = $db->query($qry) or die("Dead finding units uid");
$row = $result->fetch_assoc();
$desc = $row['description'];
$info = $row['info'];
$oid = $row['oid'];
$qry = "SELECT *
FROM roles  
WHERE oid='$oid'";
fb($qry);
$roler = $db->query($qry) or die("Dead finding units uid");
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
				<label>description:</label><br/>
				<textarea name="desc" cols="50" rows="3"> <?=$desc?></textarea>
				<br />
				<label>info:</label><br/>
				<textarea name="info" cols="50" rows="3"> <?=$info?></textarea>
				<br />
				<?=displayRoles($roler)?>
				<br />
				<input class="signup_button round" type="submit" value="send your info" />
			</form>		
		</section>
	</div>
</body>
</html>
<?
function displayRoles($resset){
	echo '<TABLE BORDER="1">
	  <TR>
	    <TH>num</TH>
	    <TH>role</TH>
		<TH>description</TH>
	  </TR>';
	while ($row = $resset->fetch_object()) {
			echo '<TR>';
	    echo '<TD><INPUT TYPE="TEXT" NAME="num" SIZE="4" value='.$row->num.'></TD>';
	    echo '<TD><INPUT TYPE="TEXT" NAME="role" SIZE="8" value='.$row->role.'></TD>';
	    echo '<TD><textarea name="roledesc" cols="30" rows="2">'.$row->roledesc.'</textarea>';
		echo '</TR>';
	}
	echo '</TABLE>';
}
?>