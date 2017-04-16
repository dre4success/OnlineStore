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

		$id = $_SESSION['id'];

?>

	<!-- main content starts here -->
  <div class="main">
    <div class="checkout-form">
      <form class="def-modal-form">
        <div class="total-cost">
        	<?php 

        		/*$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id=:id");
				$stmt->bindParam(':id', $id);

				$stmt->execute();

				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

				$statement = $conn->prepare("SELECT * FROM books WHERE book_id=:bi");
				$statement->bindParam(':bi', $row['book_id']);
				$statement->execute();

				$rowBook = $statement->fetch(PDO::FETCH_ASSOC);
				
					$sub = substr($rowBook['price'], 1);
					$to = $sub * $row['quantity']; */

					$checkout = new Checkout();
				
        	?>
          <h3>	<?php echo $checkout->getTotal($conn, $id) ?> Total Purchase</h3>
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