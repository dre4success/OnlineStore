<?php
		$page_title = "Register";

		# include header
		include 'includes/header.php';

		if(array_key_exists('register', $_POST)) {
			# cache errors
			$errors = [];

			# validate first name
			if(empty($_POST['fname'])) {
				$errors[] = "please enter a first name";
			}

			if(empty($_POST['lname'])) {
				$errors[] = "please enter a last name";
			}

			if(empty($_POST['email'])) {
				$errors[] = "please enter an email";
			}

			if(empty($_POST['password'])) {
				$errors[] = "please enter password";
			}

			if(empty($_POST['pword']) || $_POST['pword'] != $_POST['password']) {
				$errors[] = "please confirm password";
			}

			if(empty($errors)) {
				//do database stuff
			} else {
				foreach ($errors as $err) {
					echo "<p>$err</p>";
				}
			}
		}
?>
	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
				</label>
			</div>
			<div>
				<label>last name:</label>
				<input type="text" name="lname" placeholder="last name">
				</label>
			</div>

			<div>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
				</label>
			</div>
			<div>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
				
			</div>
 
			<div>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
				
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

	<?php
		# inlude footer
		include 'includes/footer.php';
	?>