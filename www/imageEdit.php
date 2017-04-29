<?php
		
		session_start();
		# title
		$page_title = "Edit Product";

		# load db connection
		include 'includes/db.php';

		# load function
		include 'includes/functions.php';

		# include header
		include 'includes/view.php';

		# check if user is logged in
		LoginCheck();


		if(isset($_GET['book_id'])){
			$bkid = $_GET['book_id'];
			}
			
		# error caching
		$errors = [];

		define("MAX_FILE_SIZE", "2097152");

		$ext = ["image/jpg", "image/jpeg", "image/png"];

		if(array_key_exists('save', $_POST)) {

			# check a file is choosing
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

			$chk = UploadFile($_FILES, 'book', 'uploads/');

 			if($chk[0]) {
 				$destination = $chk[1];
 			} else{
 				$errors['book'] = "file uploaded failed";
 			}

 			if(empty($errors)){
 				$clean = array_map('trim', $_POST);
				$clean['bk'] = $bkid;

 				editProImage($conn, $clean, $destination);
 				redirect("view_product.php");
 			}

 			
	}
?>		
		<div class="wrapper">
		<div id="stream">	
		
			<form id="register" action = "" method ="POST" enctype="multipart/form-data">
				
				<div>
				<?php
						$display = displayErrors($errors, 'book');
						echo $display;
				?>
				<label>Choose book</label>
					
				<input type="file" name="book">
				</div>

				<input type="submit" name="save" value="Edit">
			</form>

			</div>
			</div>

<?php
		# inlude footer
		include 'includes/footer.php';
?>

