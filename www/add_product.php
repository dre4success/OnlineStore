<?php
		
		session_start();
		# title
		$page_title = "Add Product";

		# load db connection
		include 'includes/db.php';

		# load function
		include 'includes/functions.php';

		# include header
		include 'includes/view.php';

		# to showcase which level each book is
		$flag = ['Trending', 'Top-Selling', 'Recently-Viewed-Items'];

		# To check if admin is logged in
		LoginCheck();

		# file destination in db
		$destination = "";

		# caching errors
		$errors = [];

		# maximum file size
		define("MAX_FILE_SIZE", "2097152");

		# file extensions allowed
		$ext = ["image/jpg", "image/jpeg", "image/png"];


		if(array_key_exists('save', $_POST)) {

			if(empty($_FILES['book']['name'])) {
			$errors[] = "please choose a file";
			}

			#  check file size..
			if($_FILES['book']['size'] > MAX_FILE_SIZE) {
			$errors[] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
			}

			if(!in_array($_FILES['book']['type'], $ext)) {
			$errors[] = "invalid file type";
			}

		
			if(empty($_POST['title'])) {
				$errors['title'] = "Enter Book's Title";
			}

			if(empty($_POST['author'])) {
				$errors['author'] = "Enter Book's Author";
			}

			if(empty($_POST['price'])) {
				$errors['price'] = "Enter Book's Price";
			}

			if(empty($_POST['year'])) {
				$errors['year'] = "Enter Year Of Publication";
			}

			if(empty($_POST['isbn'])) {
				$errors['isbn'] = "Enter Book's ISBN";
 			}

 			if(empty($_POST['category'])) {
 				$errors['category'] = "Select Category";
 			}

 			if(empty($_POST['flag'])) {
 				$errors['flag'] = "Select either trending or top-selling for the book";
  			}

 			$chk = UploadFile($_FILES, 'book', 'uploads/');

 			if($chk[0]) {
 				$destination = $chk[1];
 			} else{
 				$errors['book'] = "file uploaded failed";
 			}

 			if(empty($errors)) {

 				$clean = array_map('trim', $_POST);

				forProduct($conn, $clean, $destination);

 			}
		} 
?>


<div class="wrapper">
<h1 id="register-label">Add Product</h1>
<hr>
		<div id="stream">

				<form id="register" method="POST" enctype="multipart/form-data">

				<div>
						<?php
							$display = displayErrors($errors, 'book');
							echo $display;
						?>

					<label>Choose book</label>
					
				<input type="file" name="book">
				</div>
					
				<div>
				<?php
					$display = displayErrors($errors, 'title');
					echo $display;
				?>
				<label>Book Title</label>
					<input type="text" name="title" placeholder="Enter Book's Title">
				</div>

				<div>
				<?php
					$display = displayErrors($errors, 'author');
					echo $display;
				?>
				<label>Author</label>
					<input type="text" name="author" placeholder="Enter Book's Author">
				</div>

				<div>
				<?php
					$display = displayErrors($errors, 'price');
					echo $display;
				?>
				<label>Price</label>
					<input type="text" name="price" placeholder="Enter Price for book">
				</div>

				<div>
				<?php
					$display = displayErrors($errors, 'year');
					echo $display;
				?>
				<label>Year Of Publication</label>
					<input type="text" name="year" placeholder="Enter Year of Publication">
				</div>

				<div>
				<?php
					$display = displayErrors($errors, 'isbn');
					echo $display;
				?>
				<label>ISBN</label>
					<input type="text" name="isbn" placeholder="Enter Book's ISBN">
				</div>

				<div>
				<?php
					$display = displayErrors($errors, 'category');
					echo $display;
				?>
				<label>Select Category</label>
					<select name="category">
						<option>Select Category</option>
						<?php 
							$statement = $conn->prepare("SELECT * FROM category");
							$statement->execute();
						while($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
						<option value="<?php echo $row['category_name'] ?>"> <?php echo $row['category_name'] ?> </option>
							<?php } ?>
					</select>
				</div>

				<div>
							<?php
								$display = displayErrors($errors, 'flag');
								echo $display;
							?>

							<label>Types</label>
							<select name="flag">
									<option>Types</option>
									<?php foreach ($flag as $fl) { ?>
									<option value="<?php echo $fl; ?>"> <?php echo $fl; ?> </option>
									<?php } ?>
							</select>
				</div>

					<input type="submit" name="save" value="upload">

				</form>

				</div>
				</div>

	<?php
		# inlude footer
		include 'includes/footer.php';
	?>