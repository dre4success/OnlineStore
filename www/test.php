<?php # test.php sandbox

define('DBNAME', 't_online');
define('DBUSER', 'root');
define('DBPASS', 'dre');

$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);