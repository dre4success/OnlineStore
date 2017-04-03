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