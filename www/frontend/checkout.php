<?php
		
   
    # title
		$page_title = "Checkout";

		# body id for css
		$body_id = "checkout";

		# load db connection
		include '../includes/db.php';

		# load function
		include '../includes/functions.php';

		# include header
		include '../includes/user_header.php'; 

		# user ID
		$id = $_SESSION['id'];

		# populating errors array
		$errors = [];

		if(array_key_exists('chkt', $_POST)) {

			if(empty($_POST['phoneNumber'])) {
				$errors['phoneNumber'] = "Please Enter Your Phone Number";
			}
			if(empty($_POST['addy'])) {
				$errors['addy'] = "Please Enter the address want it to be shipped to";
			}
			if(empty($_POST['code'])) {
				$errors['code'] = "Please Enter Post Code";
			}

			if(empty($errors)) {

				$clean = array_map('trip', $_POST);
			}
		}

?>

	<!-- main content starts here -->
  <div class="main">
    <div class="checkout-form">
      <form class="def-modal-form" action="checkout.php" method="POST">
        <div class="total-cost">
        	
        	<?php 

					$checkout = new Checkout();
				
        	?>
          <h3>	<?php echo '$'.$checkout->getTotal($conn, $id); ?> Total Purchase</h3>

        </div>

        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Checkout</h3></label>
        <input type="number" maxlength="11" name="phoneNumber" class="text-field phone" placeholder="Phone Number">

        <input type="text" name="addy" class="text-field address" placeholder="Address">

        <input type="text" name="code" class="text-field post-code" placeholder="Post Code">

        <input type="submit" name="chkt" class="def-button checkout" value="Checkout">
      </form>
    </div>
  </div>

   <?php
  		#footer
  		include '../includes/front_footer.php';
  ?>