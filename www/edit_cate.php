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

		LoginCheck();

		
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
		<h1 id="register-label">Edit Category</h1>
		<hr>
		<div id="stream">
			
				
			

				<form id="register" action ="<?php echo "edit_cate.php?category_id=".$_GET['category_id']; ?>" method ="POST">

				<div>
				<label>Category Name</label>
				<input type="text" name="cat" placeholder="Category Name" value="<?php echo $cat['category_name']; ?>">
				</div>
				<input type="hidden" name="cid" value="<?php echo $cat['category_id']; ?>">
				<input type="submit" name="edit" value="edit">

				</form>

		</div>
		</div>
					
	
	<?php

		include 'includes/footer.php';
	?>	
				