
<?php

session_start();
		# title
		$page_title = "Delete Product";

		# load db connection
		include 'includes/db.php';

		# load function
		include 'includes/functions.php';

		# include header
		include 'includes/view.php';

		LoginCheck();


		if(isset($_GET['book_id'])) {

			delPro($conn, $_GET['book_id']);
		
		}

?>