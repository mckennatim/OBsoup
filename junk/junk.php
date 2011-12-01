<?
echo header("Content-type: text/plain");
include_once('../tm/dbinfo.php');
require_once('../tm/FirePHP.class.php');
require_once('../tm/fb.php');
require_once('../tm/cpu.php');
ob_start(); //gotta have this

$trying ="changing date ".$pid." is complete"; //fb($trying);
$sql = "SELECT projdate, projdat, pid FROM projects WHERE projdate<='2011-11-30'";
//fb($sql);
$result = mysql_query($sql) or die($trying);
while ($ica = mysql_fetch_assoc($result)){

	$prdate= mdate($ica['projdat']);
	//$trying ="update date "; //fb($trying);
	//$sql = "UPDATE projects SET `projdate`='$prdate' WHERE pid='".$ica['pid']."'";
	//fb($sql);
	//mysql_query($sql) or die($trying);
	echo $prdate .'  '. date("d",strtotime($ica['projdate'])).'  '. fdate($prdate).'  '. mdate($prdate). "\n";
}



echo "dog";
$dt= date();
$month = date("m");
$year = date("Y");
echo ($month.'   ' .$year.'  hjiddddd ' .$dt ) ;



?>