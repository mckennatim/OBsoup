<?
$errmsg_arr = array();
$errflag = false;

$email="mckenna.tim@gmail.com";

$message = "I don't really know how to send your password. Sorry";
mail($email, 'Sorry buddy', $message);
?>