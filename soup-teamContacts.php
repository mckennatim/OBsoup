<?
session_start();
require_once('auth.php');
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$pid = $_GET[pid];
fb('how are you today');
$volunteerID=$_SESSION['SESS_ID'];
fb('the volid is '.$volunteerID);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />		
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />	
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">
		
		<title>Using DataTable with Editable plugin - Getting the data source via ajax request</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/demo_validation.css";
			@import "media/css/themes/base/jquery-ui.css";
			@import "media/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		</style>

        <script src="media/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.jeditable.js" type="text/javascript"></script>
        <script src="media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="media/js/jquery.validate.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.editable.js" type="text/javascript"></script>
	</head>
<?


mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

//$oid =145;
//$pid = copyOutline($oid);
//copyRoles($$pid);

//displayProject($pid);


$qry = "SELECT *
FROM projects  
WHERE pid='$pid' limit 1";
fb($qry);
$result = mysql_query($qry) or die("Dead finding units uid");
$row = mysql_fetch_assoc($result);
$projdate = $row['projdate'];
$projdate = $row['projdate'];
$leadtime = $row['leadtime'];
$location = $row['location'];
$title = $row['title'];
$desc = $row['description'];
$info = $row['info'];
$sitecontacts = $row['sitecontacts'];
$link = $row['link'];
$zipcode = $row['zipcode'];
$organizer = $row['organizer'];
$vid = $row['vid'];
$status = $row['status'];

$vry = "SELECT *
FROM volunteers  
WHERE id='$vid' limit 1";
fb($vry);
$result = mysql_query($vry) or die("Dead finding units uid");
$vrow = mysql_fetch_assoc($result);
$gemails = $vrow['email'].", " .$vrow['otheremail'];
$gphone = $vrow['phone'];
$gmobile = $vrow['mobile'];
$gphones = str_replace(" ","-",$vrow['phone']).", ".str_replace(" ","-",$vrow['mobile']);	

$sql = "SELECT `role`, `roledesc`, `name`, `email`, `otheremail`, `useemail`, `useoemail`, `phone` , `mobile` , `orgcancall`
FROM team  
LEFT JOIN volunteers
USING ( id )
WHERE pid='$pid'";
fb($sql);
$roler = mysql_query($sql) or die("Dead finding units uid");

$rarr = mkTbl($roler);
	

function mkTbl($r){
	global $volunteerID;
	global $pid;
	$mule =array();
//	$js = '<form method=post action="contactTeam.php">
//	<input type="hidden" name="vid" id="vid" value="'.$volunteerID.'"/>
//	<input type="hidden" name="pid" id="pid" value="'.$pid.'"/>	
	$js = '<table>	<thead>
		<tr>
			<th>role</th>
			<th>role description</th>
			<th>teammate</th>
			<th>email</th>
			<th>phone</th>		
		</tr>
	</thead><tbody>';

	while ($arow = mysql_fetch_assoc($r)){
		$js.='<tr>';

		$mule[] = $arow['email'];
		fb('strlen is '.strlen($arow['otheremail']));
		if (strlen($arow['otheremail'])==0 or empty($arow['otheremail'])){
			;
		}else{
			$mule[] = $arow['otheremail'];
		}
		foreach($arow as $key=>$val){
			if ($arow['orgcancall'] == 'on'){
				$hphone = str_replace(" ","-",$arow['phone']);
				$mphone = str_replace(" ","-",$arow['mobile']);				
				$phones = "<td>".$hphone. "(h)<br/>".$mphone."(m)</td>";
			}	
			if ($arow['useemail'] == 'on'){
				$emails = "<td>".$arow['email']. "<br/>";
				
				if ($arow['useoemail'] == 'on'){
					$emails .= $arow['otheremail']."</td>";
					
				}else {
					$emails.= "</td>";
				}	
			}
			if ($key=='role' or $key=='roledesc' or $key=='name'){	
				$js.='<td>'.$val.'</td>';
			}
		}
		$js.=$emails.$phones.'</tr>';
	}
	$mule =array_unique($mule);//unique email addresses
	$ret['mule'] = $mule;
	fb($mule);
	//$js.='<tr><td colspan =6 align=center><input type=submit 
//	value="Check off your role and click here"></form></td></tr></tbody></table></section>';
	$js.='</tbody></table></section>';
	//fb($js);
	$ret['js'] = $js;
	return $ret;
}


?>	
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
					echo '<li>Sorry, The email didn\'t go through. Perhaps there were extra commas 
					between the email addresses or something. Try again or copy the email to your email program.</li>'; 
				}
				echo '</ul>';
				unset($_SESSION['ERRMSG_ARR']);
			}
			?>
	
			<h1>Team for this <?echo $title ?> project</h1>	
				<label>status: </label>
				<?=$status?>
				<label>projectID: </label>
				<?=$pid?>			
				<label>project date:</label>
				<?=$projdate?>
				<label>lead time: </label>
				<?=$leadtime?>
				<br/>
				<label>organizer: </label>
				<?=$organizer?>
				<br />
				<label>organizer's email: </label>
				<?=$gemails?>
				<br/>
				<label>organizer's phone: </label>
				<?=$gphones?>
				<br />
				<label>site contacts: </label>
				<?=$sitecontacts?>
				<label>link: </label>
				<a href=<?=$link?>><?=$link?></a>
				<label>zip: </label>
				<?=$zipcode?>
				<br />				
				<label>location:</label>
				<?=$location?>
				<br />
				<label>description:</label><br/>
				<?=$desc?>
				<br />
				<label>info:</label><br/>
				<?=$info?>
			</form>		
		</section>
	</div>
<div class="container">
<section class="round">
<? 
echo $rarr['js']; 
//fb($rarr['js']);
$ead = $rarr['mule'];
$estr = "";
foreach ($ead as $ad){
	$estr.=$ad.", ";
}
$estr = substr($estr,0,-2);
$estr = str_replace(", ,", ", ", $estr);
fb($estr);

?>
<form id="form1" name="Update" method="post" action="org-mail.php">
	<input type="hidden" name="cc" id="cc" value="<?=$vrow['email']?>" />
	<input type="hidden" name="pid" id="pid" value="<?=$pid?>" />	
  <label>
  to: <textarea name="emails" id="emails" cols="50" rows="2"><?=$estr?></textarea>
  </label>
  <br/>
  check that there are no extra commas between email addresses
  <br />
  <label>
  subject: <input type="text" name="subject" id="subject" size="25"/>
  </label>
  <br />
  <label>
  message: <textarea name="message" id="message" cols="50" rows="6"></textarea>
  </label>
<input class="signup_button round" type="submit" value="email your team" />
</form>

</section>
</body>
</html>