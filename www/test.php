<?php # test.php sandbox

define('DBNAME', 't_online');
define('DBUSER', 'root');
define('DBPASS', 'dre');

try {
	# prepare a pdo instance
	$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	#set verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

} catch(PDOException $e) {
	echo $e->getMessage();
}