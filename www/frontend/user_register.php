<?php
		# title
		$page_title = "Register";

		# body id for css
		$body_id = "registration";

		# load db connection
		include '../includes/db.php';

		# load function
		include '../includes/functions.php';

		# include header
		include '../includes/user_header.php';

			$errors = [];

			if(array_key_exists('register', $_POST)) {

				if(empty($_POST['firstname'])) {
					$errors['firstname'] = "Please Enter Your Firstname";
				}

				if(empty($_POST['lastname'])) {
					$errors['lastname'] = "Please Enter Your Lastname";
				}

				if(empty($_POST['email'])) {
					$errors['email'] = "Please Enter Your Email";
 				}

 				if(doesUserEmailExist($conn, $_POST['email'])) {
 					$errors['email'] = "Email Already Exist";
 				}

 				if(empty($_POST['username'])) {
 					$errors['username'] = "Please Enter Username Of Your Choice";
 				}

 				if(empty($_POST['password'])) {
 					$errors['password'] = "Please Enter Your Password";
 				}

 				if($_POST['pword'] != $_POST['password']) {
				$errors['pword'] = "passwords do not match";
				}

				if(empty($errors)) {

					//do database stuff

				# eliminate unwanted spaces from values in the $_POST array
				$clean = array_map('trim', $_POST);

				doUserRegister($conn, $clean);

				}
			}

?>

	 <!-- main content starts here -->
  <div class="main">
    <div class="registration-form">
      <form class="def-modal-form" action="user_register.php" method="POST">
        <div class="cancel-icon close-form"></div>
        <label for="registration-from" class="header"><h3>User Registration</h3></label>

        <?php
		if(isset($_GET['msg'])) {
			echo '<p class="form-error">'.$_GET['msg'].'</p>';
		}
		?>
        <input type="text" name="firstname" class="text-field first-name" placeholder="Firstname">
        <?php $display =  displayErrorsUser($errors, 'firstname'); echo $display; ?>

        <input type="text" name="lastname" class="text-field last-name" placeholder="Lastname">
        <?php $display =  displayErrorsUser($errors, 'lastname'); echo $display; ?>

        <input type="email" name="email" class="text-field email" placeholder="Email">
        <?php $display =  displayErrorsUser($errors, 'email'); echo $display; ?>

        <input type="text" name="username" class="text-field username" placeholder="Username">
        <?php $display =  displayErrorsUser($errors, 'username'); echo $display; ?>

        <input type="password" name="password" class="text-field password" placeholder="Password">
        <?php $display =  displayErrorsUser($errors, 'password'); echo $display; ?>

        <input type="password" name="pword" class="text-field confirm-password" placeholder="Confirm Password">
        <?php $display =  displayErrorsUser($errors, 'pword'); echo $display; ?>

        <input type="submit" name="register" class="def-button" value="Register">
        <p class="login-option">Have an account already? Login</p>
      </form>
    </div>
  </div>

  <?php
  		#footer
  		include '../includes/front_footer.php';
  ?>