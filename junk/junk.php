<?
//echo header("Content-type: text/plain");
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$name=$_GET[name];
$email=$_GET[email];

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$sql = "INSERT INTO `OBsoupVolunteers` (`name`, `email`) VALUES('$name','$email')";
$db->query($sql);
fb($sql);

?>