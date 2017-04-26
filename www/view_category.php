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

		LoginCheck();

	

?>
		<div class="wrapper">
		<h1 id="register-label">View Category</h1>
		<hr>
		<div id="stream">
				
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