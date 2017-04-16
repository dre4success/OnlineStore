<?php
		
   
    # title
		$page_title = "Cart";

		# body id for css
		$body_id = "cart";

		# load db connection
		include '../includes/db.php';

		# load function
		include '../includes/functions.php';

		# include header
		include '../includes/user_header.php'; 

		$id = $_SESSION['id'];

?>

 <div class="main">
    <table class="cart-table">
      <thead>
        <tr>
          <th><h3>Item</h3></th>
          <th><h3>Price</h3></th>
          <th><h3>Quantity</h3></th>
          <th><h3>Total</h3></th>
          <th><h3>Update</h3></th>
          <th><h3>Remove</h3></th>
        </tr>
      </thead>
      <tbody>
        <tr>
        		<?php 
        		
        		# if user is not logged in, to insert into temporary cart table

				if(!isset($_SESSION['id'])) {
					$stmt = $conn->prepare("SELECT * FROM temp_cart");
					$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				
				$statement = $conn->prepare("SELECT * FROM books WHERE book_id=:bi");
				$statement->bindParam(':bi', $row['book_id']);
				$statement->execute();
				$rowBook = $statement->fetch(PDO::FETCH_ASSOC);
				
        		?>

          <td><div class="book-cover" style="background: url('../<?php echo $rowBook['file_path'] ?>');
  										background-size: cover;
  										background-position: center;
  										background-repeat: no-repeat;"></div></td>

          <td><p class="book-price"><?php echo $rowBook['price'] ?></p></td>
          <td><p class="quantity"><?php echo $row['quantity'] ?></p></td>

          			<?php $sub = substr($rowBook['price'], 1) ?>
          <td><p class="total"> <?php echo '$'.($sub * $row['quantity']) ?> </p></td>
          <td> 

            <?php include 'updatefortempcart.php'; ?>
          </td>
          <td>
            <a href="<?php echo "deletefortempcart.php?cart_id=".$row['tempCart_id']; ?>" class="def-button remove-item">Remove Item</a>
          </td>
        </tr>
        		<?php } } ?>


        		<?php

        			# if user is logged in, to insert into cart table

        			if(isset($_SESSION['id'])){

        				$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id=:id");
        				$stmt->bindParam(':id', $id);
						$stmt->execute();

						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				
						$statement = $conn->prepare("SELECT * FROM books WHERE book_id=:bi");
						$statement->bindParam(':bi', $row['book_id']);
						$statement->execute();

						$rowBook = $statement->fetch(PDO::FETCH_ASSOC);
        		?>

        		 <td><div class="book-cover" style="background: url('../<?php echo $rowBook['file_path'] ?>');
  										background-size: cover;
  										background-position: center;
  										background-repeat: no-repeat;"></div></td>

          <td><p class="book-price"><?php echo $rowBook['price'] ?></p></td>
          <td><p class="quantity"><?php echo $row['quantity'] ?></p></td>

          			<?php $sub = substr($rowBook['price'], 1) ?>
          <td><p class="total"> <?php echo '$'.($sub * $row['quantity']) ?> </p></td>
          <td> 

            <?php include 'update.php'; ?>
          </td>
          <td>
            <a href="<?php echo "delete.php?cart_id=".$row['cart_id']; ?>" class="def-button remove-item">Remove Item</a>
          </td>
        </tr>
        		<?php } } ?>
     
      </tbody>
    </table>
    <div class="cart-table-actions">
      <button class="def-button previous">previous</button>
      <button class="def-button next">next</button>
      <div class="index">
        <a href="#"><p>1</p></a>
        <a href="#"><p>2</p></a>
        <a href="#"><p>3</p></a>
      </div>
      <a href="checkout.php"><button class="def-button checkout">Checkout</button></a>
    </div>
    
  </div>

   <?php
  		#footer
  		include '../includes/front_footer.php';
  ?>