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

					if($chk[0]){

						$_SESSION['id'] = $chk[1]['admin_id'];
						$_SESSION['email'] = $chk[1]['email'];
						//print_r($_SESSION); exit();
						redirect("home.php");
					} else
					{
						redirect("login.php?msg=invalid email or password");
					}
				}
			}
?>

<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<?php
					//if(isset($errors['email'])) {echo '<span class="err">'. $errors['email']. '</span>';}
						$display = displayErrors($errors, 'email');
						echo $display;

				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
					//if(isset($errors['password'])) {echo '<span class="err">'. $errors['password']. '</span>';}
					$display = displayErrors($errors, 'password');
					echo $display;
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