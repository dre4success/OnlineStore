<?php
		
		session_start();
		# title
		$page_title = "Add Category";

		# load db connection
		include 'includes/db.php';

		# load function
		include 'includes/functions.php';

		# include header
		include 'includes/view.php';

		authenticate();

		# caching error
		$errors = [];

		if(array_key_exists('enter', $_POST)){

			if(empty($_POST['cat'])) {
				$errors['cat'] = "Enter Product Category Here";
			}

			if(empty($errors)) {
				//do database stuff

				# eliminate unwanted spaces from values in the $_POST array
				$clean = array_map('trim', $_POST);

				insertCategory($conn, $clean);
			}
		}

		
?>

<div class="wrapper">
<h1 id="register-label">Add Category</h1>
<hr>
		<div id="stream">

				<form id="register" action ="add_category.php" method ="POST">

						<?php 
							$display = displayErrors($errors, 'cat'); 
							echo $display;
						?>
					<label>Category: </label>
					<input type="text" name="cat" placeholder="Enter Product Category">
					

					<input type="submit" name="enter" value="Enter">
				</form>
				</div>
				</div>

	<?php
		# inlude footer
		include 'includes/footer.php';
	?>