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

?>

	<!-- main content starts here -->
  <div class="main">
    <div class="checkout-form">
      <form class="def-modal-form">
        <div class="total-cost">
          <h3>$2000 Total Purchase</h3>
        </div>
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Checkout</h3></label>
        <input type="text"  class="text-field phone" placeholder="Phone Number">
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