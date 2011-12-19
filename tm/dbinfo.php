<?php
// defines database connection data
define('DB_HOST', 'localhost');
define('DB_USER', 'soupteam_user');
define('DB_PASSWORD', 'user');
define('DB_DATABASE', 'soupteam_ob'); 
define('URL_BASE', 'http://soupteam.com/OBsoup');
// defines the number of visible rows in grid
mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");
?>
