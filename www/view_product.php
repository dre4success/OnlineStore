<?php
		
		session_start();
		# title
		$page_title = "View Product";

		# load db connection
		include 'includes/db.php';

		# load function
		include 'includes/functions.php';

		# include header
		include 'includes/view.php';

		authenticate();

	/*	if(isset($_GET['del'])) {

			if($_GET['del'] = "delete") {
				delPro($conn, $_GET['book_id']);
			}
		} */

		/*if(array_key_exists('edit', $_POST)){
			$clean = array_map('trim', $_POST);
			editPro($conn, $clean);
		}
?>
		

				
				<?php
					if(isset($_GET['action'])){

						if($_GET['action'] = "edit"){

				?>

			<h3>Edit Product</h3>

				<form id="register" action ="view_product.php" method ="POST">

				<input type="text" name="til" placeholder="Book Title" value="<?php echo $_GET['title']; ?>">
				<input type="text" name="auth" placeholder="Book Author" value="<?php echo $_GET['author']; ?>">
				<input type="text" name="pri" placeholder="Price" value="<?php echo $_GET['price']; ?>">
				<input type="text" name="yer" placeholder="Year" value="<?php echo $_GET['year_of_publication']; ?>">
				<input type="text" name="bn" placeholder="ISBN" value="<?php echo $_GET['isbn']; ?>">
				<input type="hidden" name="bk" value="<?php echo $_GET['book_id']; ?>">
				<input type="submit" name="edit" value="edit">

				</form>
					<?php
				}
			} */
			?>
				<div class="wrapper">
				<h1 id="register-label">View Product</h1>
				<hr>
				<div id="stream">

			<table id="tab">
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>price</th>
						<th>Year</th>
						<th>Isbn</th>
						<th>Book</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
				
						<?php
								$view = viewProduct($conn);
								echo $view;
						?>

          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	<?php
		# inlude footer
		include 'includes/footer.php';
	?>