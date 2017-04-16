<?php

	# load db connection
		include '../includes/db.php';

		# load function
		include '../includes/functions.php';

			
			

			delTempCart($conn, $_GET['cart_id']);
		
?>