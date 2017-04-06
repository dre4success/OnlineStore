<?php


	session_start();
		# title
		$page_title = "Edit Category";

		# load db connection
		include 'includes/db.php';

		# load function
		include 'includes/functions.php';

		# include header
		include 'includes/view.php';

		authenticate();

		
					if(isset($_GET['category_id'])){

						$cat = getCategoryByID($conn, $_GET['category_id']);
					}
				


				$errors = [];
			if(array_key_exists('edit', $_POST)){
				if(empty($_POST['cat'])) {
					$errors['cat'] = "Please enter a category name to change";
				}	

			$clean = array_map('trim', $_POST);
			editCat($conn, $clean);
		}

?>
		<div class="wrapper">
		<h1 id="register-label">View Category</h1>
		<hr>
		<div id="stream">
			
				
			<h3>Edit Category</h3>

				<form id="register" action ="<?php echo "edit_cate.php?category_id=".$_GET['category_id']; ?>" method ="POST">

				<input type="text" name="cat" placeholder="Category Name" value="<?php echo $cat['category_name']; ?>">
				<input type="hidden" name="cid" value="<?php echo $cat['category_id']; ?>">
				<input type="submit" name="edit" value="edit">

				</form>
					
	
		
				