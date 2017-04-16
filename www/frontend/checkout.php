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

		# instantiating new Object Checkout if user is logged in
		if(isset($_SESSION['id'])) {
		$checkout = new Checkout();

		$totalPurchase = '$'.$checkout->getTotal($conn, $id);

		} else # if user is not logged in, instantiating object to get total

			{
				$checkout = new Checkout();

				$totalPurchase = '$'.$checkout->getTotalTempCart($conn);
			}


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

				$clean = array_map('trim', $_POST);

				$checkout->insertIntoCheckout($conn, $id, $clean, $totalPurchase);
			}
		}

?>

	<!-- main content starts here -->
  <div class="main">
    <div class="checkout-form">
      <form class="def-modal-form" action="checkout.php" method="POST">
        <div class="total-cost">
        	
          <h3>	<?php echo $totalPurchase; ?> Total Purchase</h3>

        </div>

        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Checkout</h3></label>
        <input type="number" maxlength="11" name="phoneNumber" class="text-field phone" placeholder="Phone Number">
        <?php $display =  displayErrorsUser($errors, 'phoneNumber'); echo $display; ?>

        <input type="text" name="addy" class="text-field address" placeholder="Address">
        <?php $display =  displayErrorsUser($errors, 'addy'); echo $display; ?>

        <input type="text" name="code" class="text-field post-code" placeholder="Post Code">
        <?php $display =  displayErrorsUser($errors, 'code'); echo $display; ?>

        <input type="submit" name="chkt" class="def-button checkout" value="Checkout">
      </form>
    </div>
  </div>

   <?php
  		#footer
  		include '../includes/front_footer.php';
  ?>