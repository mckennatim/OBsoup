<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in notify-volunteers');
fb($_POST);
$pid=$_POST[pid];
$emails=$_POST[emails];
$from=$_POST[from];
$friend=$_POST[friend];
$subject=$_POST[subject];
$everyone=$_POST[everyone];
$pzip=$_POST[zip]; 
$frev = $friend."<br/><br/>".$everyone;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from. "\r\n";
if (strlen($emails)>5){
	mail($emails, $subject, $frev, $headers);
}

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

fb( "some project named ".$pid. " just got created, time to notify the volunteers");
//who to notify
//notify the organizer

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from. "\r\n";

$trying ="get volunteers who newpremail = on"; //fb($trying);	
$sql = "SELECT `email`, `zipcode`, `within` FROM volunteers
WHERE newpremail = 'on'";	
fb($sql);
$result = mysql_query($sql) or die($trying);

$trying ="get lat long of proj"; //fb($trying);	
$sql = "SELECT `zip`, `latitude`, `longitude` FROM zip_codes
WHERE  zip ='".$pzip."'";	
fb($sql);
$presult = mysql_query($sql) or die($trying);
$prow = mysql_fetch_assoc($presult);
$plat = $prow['latitude'];
$plong = $prow['longitude'];

while ($trow = mysql_fetch_assoc($result)) {
	$zip = $trow['zipcode'];
	$within = $trow['within'];
	if (strlen($zip)==5 and $within>0){ //calculate distance
		$trying ="get lat long of volunteer"; //fb($trying);	
		$sql = "SELECT `zip`, `latitude`, `longitude` FROM zip_codes
		WHERE  zip ='".$zip."'";	
		fb($sql);
		$vresult = mysql_query($sql) or die($trying);
		$vrow = mysql_fetch_assoc($vresult);
		$vlat = $vrow['latitude'];
		$vlong = $vrow['longitude'];
		$dist = distance($plat, $plong, $vlat, $vlong, "M" );
		fb($trow['email']. ' is ' . $dist. ' miles from proj, within '.$within.' miles' );		
		if ($dist<=$within){ 
			fb('EMAILING');
			mail($trow['email'], $subject, $everyone, $headers);
		} else{
			FB('NOT EMAILING');
		}//else do nothing 
	} else { //email anyway
		fb($trow['email']);
		FB('EMAILING');
		mail($trow['email'], $subject, $everyone, $headers);
	}
}
fb("done");
fb("location: soup.php");

header("location: soup.php");

function distance($lat1, $lon1, $lat2, $lon2, $unit) { 

  $theta = $lon1 - $lon2; 
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  $dist = acos($dist); 
  $dist = rad2deg($dist); 
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344); 
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
?>