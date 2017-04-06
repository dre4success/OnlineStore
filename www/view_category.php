<?php
		
		session_start();
		# title
		$page_title = "View Category";

		# load db connection
		include 'includes/db.php';

		# load function
		include 'includes/functions.php';

		# include header
		include 'includes/view.php';

		authenticate();

	/*	if(isset($_GET['del'])) {

			if($_GET['del'] = "delete") {
				delCat($conn, $_GET['category_id']);
			}
		}

		if(array_key_exists('edit', $_POST)){
			$clean = array_map('trim', $_POST);
			editCat($conn, $clean);
		} */

?>
		<div class="wrapper">
		<h1 id="register-label">View Category</h1>
		<hr>
		<div id="stream">
			
				<?php
				/*	if(isset($_GET['action'])){

						if($_GET['action'] = "edit"){

				?>

			<h3>Edit Category</h3>

				<form id="register" action ="view_category.php" method ="POST">

				<input type="text" name="cat" placeholder="Category Name" value="<?php echo $_GET['category_name']; ?>">
				<input type="hidden" name="cid" value="<?php echo $_GET['category_id']; ?>">
				<input type="submit" name="edit" value="edit">

				</form>
					<?php
				}
			} */
			?> 
				

			<table id="tab">
				<thead>
					<tr>
						<th>Category ID</th>
						<th>Category Name</th>
						<th>Edit</th>
						<th>Delete</th>
						
					</tr>
				</thead>
				<tbody>
				<!--	<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr> -->

						<?php
								$select = $conn->prepare("SELECT * FROM category");
									$select->execute();



								$view =	viewCat($select);
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