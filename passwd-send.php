<?





$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: mckenna.tim@gmail.com' . "\r\n";
$loginurl = 


$email="mckenna.tim@gmail.com";

$message = "Hi, the system has reset your password to 'soup'. You can login 
at   ";
mail($email, 'Sorry buddy', $message, $headers);
?>