<?php
		session_start();

		$page_title = "Login";
		include 'includes/header.php';

		include 'includes/db.php';

		include 'includes/functions.php';

					# error caching
					$errors = [];

			if(array_key_exists('register', $_POST)) {
				

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

					$chk = adminLogin($conn, $clean);

						$_SESSION['id'] = $chk[1]['admin_id'];
						$_SESSION['email'] = $chk[1]['email'];
						
						redirect("home.php");
					
				}
			}
?>

<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
				<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<?php
					if(isset($_GET['msg']))
					echo '<span class="err">'. $_GET['msg']. '</span>';
					
						$display = displayErrors($errors, 'email');
						echo $display;

				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
					if(isset($_GET['msg']))
					echo '<span class="err">'. $_GET['msg']. '</span>';
					
					$display = displayErrors($errors, 'password');
					echo $display;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
		</div>
<?php
		include 'includes/footer.php';
?>