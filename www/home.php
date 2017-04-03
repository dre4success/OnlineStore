<?php
		
		session_start();
		# title
		$page_title = "Home";

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
<h1 id="register-label">Home</h1>
<hr>
		<div id="stream">

				<form id="register"  action ="home.php" method ="POST">

						<?php 
							$display = displayErrors($errors, 'cat'); 
							echo $display;
						?>
					<label>Category: </label>
					<input type="text" name="cat" placeholder="Enter Product Category">
					

					<input type="submit" name="enter" value="Enter">
				</form>

			<table id="tab">
				<thead>
					<tr>
						<th>post title</th>
						<th>post author</th>
						<th>date created</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
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