
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

		authenticate();


		if(isset($_GET['category_id'])) {

			delCat($conn, $_GET['category_id']);
		
		}

?>