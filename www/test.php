<?php # test.php sandbox

/*define('DBNAME', 't_online');
define('DBUSER', 'root');
define('DBPASS', 'dre');

try {
	# prepare a pdo instance
	$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	#set verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

} catch(PDOException $e) {
	echo $e->getMessage();
} */
		include 'includes/functions.php';

		
 			$errors = [];
 	if(array_key_exists('save', $_POST)) {

		fileUpload($_FILES, $errors, 'pic');
}

?>


		<form id="register" method="POST" enctype="multipart/form-data">

	<p>please upload a file</p>
	<input type="file" name="pic">

	<input type="submit" name="save">

</form> 