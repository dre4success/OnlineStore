<?php



		

		
					/*if(isset($_GET['cart_id'])){

						$cat = getCartByID($conn, $_GET['cart_id']);
					}*/
				


				$errors = [];
			if(array_key_exists('update', $_POST)){
				
			$clean = array_map('trim', $_POST);
			editCart($conn, $clean);
		}

?>
					

				<form class="update" action ="<?php echo "cart.php?cart_id=".$row['cart_id']; ?>" method ="POST">

              <input type="number" class="text-field qty" name="qty" value="<?php echo $row['quantity'] ?>">
              <input type="hidden" name="cartid" value="<?php echo $row['cart_id']; ?>">
              <input type="submit" class="def-button change-qty" name="update" value="Change Qty">
            
				</form>

					
	

				