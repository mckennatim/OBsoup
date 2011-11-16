<?
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: mckenna.tim@gmail.com' . "\r\n";

$email="mckenna.tim@gmail.com";


$message = "I don't really know how to send youhhhr password. Sorry";
mail($email, 'jjSorry buddy', $message, $headers);
?>