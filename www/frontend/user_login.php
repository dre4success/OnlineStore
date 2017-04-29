<?php
			//session_start();
		# title
		$page_title = "Login";

		# body id for css
		$body_id = "login";

		# load db connection
		include_once '../includes/db.php';

		# load function
		include '../includes/functions.php';

		# include header
		include '../includes/user_header.php';

		$errors = [];
		if(array_key_exists('login', $_POST)) {

			if(empty($_POST['email'])) {
				$errors['email'] = "Please Enter Your Email";
			}

			if(empty($_POST['password'])) {
				$errors['password'] = "Please Enter Your Password";
			}

			if(empty($errors)) {

				# select from database

					#clean unwanted values in the $_POST ARRAY
					$clean = array_map('trim', $_POST);

					$chk = UserLogin($conn, $clean);


						$_SESSION['logged'] = true;
						$_SESSION['username'] = $chk[1]['username'];
						$_SESSION['id'] = 	 $chk[1]['user_id'];
						$_SESSION['email'] = $chk[1]['email'];
						$_SESSION['fname'] = $chk[1]['firstname'];
						$_SESSION['lname'] = $chk[1]['lastname'];

						
						redirect("index.php");
				
			}
		}


?>
	

 <!-- main content starts here -->
  <div class="main">
    <div class="login-form">
      <form class="def-modal-form" action="user_login.php" method="POST">
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Login</h3></label>
        <?php
		if(isset($_GET['msg'])) {
			echo '<p class="form-error">'.$_GET['msg'].'</p>';
		}
		?>

        <input type="text" name="email" class="text-field email" placeholder="Email">
        <?php $display =  displayErrorsUser($errors, 'email'); echo $display; ?>
        
        <input type="password" name="password" class="text-field password" placeholder="Password">
        <?php $display =  displayErrorsUser($errors, 'password'); echo $display; ?>
       
        <input type="submit" name="login" class="def-button login" value="Login">
      </form>
    </div>
  </div>

  <?php
  		include '../includes/front_footer.php';
  ?>