<?php 
		session_start();

		$page_title = "Login";
		include 'includes/header.php';

		include 'includes/db.php';

		include 'includes/functions.php';

			if(array_key_exists('register', $_POST)) {
				# error caching
				$errors = [];

				if(empty($_POST['email'])) {
					$errors['email'] = "please enter your email";
				}

				if(empty($_POST['password'])) {
					$errors['password'] = "please enter your password";
				}

				if(empty($errors)) {
					# select from database

					#clean unwanted values in the $_POST ARRAY
					$clean = array_map('trim', $_POST);

					adminLogin($conn, $clean);
				}
			}
?>

<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<?php
					if(isset($errors['email'])) {echo '<span class="err">'. $errors['email']. '</span>';}
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
					if(isset($errors['password'])) {echo '<span class="err">'. $errors['password']. '</span>';}
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>

<?php
		include 'includes/footer.php';
?>