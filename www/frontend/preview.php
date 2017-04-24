<?php
		//session_start();
		# title
		$page_title = "Book Preview";

		# body id for css
		$body_id = "bookpreview";

		# load db connection
		include '../includes/db.php';

		# load function
		include '../includes/functions.php';

		# include header
		include '../includes/user_header.php';

		
		$id = $_SESSION['id'];
	

		if(isset($_GET['book_id'])){
			$item = getBookByID($conn, $_GET['book_id']);

			if(!$_SESSION) {
				insertIntoRecentlyViewed($conn, $sid, $item['book_id']);
			} else
			{
				insertIntoRecentlyViewed($conn, $id, $item['book_id']);
			}
		}

		# Validating Review Form
		if(array_key_exists('submit', $_POST)) {
			$clean = array_map('trim', $_POST);

			insertIntoReview($conn, $id, $item['book_id'], $clean);
		}

				$errors = [];
		# Validating Add To Cart Form			
		if(array_key_exists('enter', $_POST)) {

			if(empty($_POST['quantity'])) {

				$errors['quantity'] = "You have not chosen any amount!";
				}

			if(empty($errors)){

			$clean = array_map('trim', $_POST);

				if(!$_SESSION['id']){

				# add to temporary cart if user is not logged in	
				addToCart($conn, $sid, $item['book_id'], $clean);
					} 

				else {

				# add to cart if user is logged in
				addToCart($conn, $id, $item['book_id'], $clean);
					}

			redirect("preview.php?book_id=".$item['book_id']);
		}
	}
?>

 <div class="main">
    <p class="global-error"> <?php if(isset($errors['quantity'])) { echo $errors['quantity']; } ?> </p>
    <div class="book-display">
      <div class="display-book" style="background: url('../<?php echo $item['file_path']; ?>');
  										background-size: cover;
  										background-position: center;
  										background-repeat: no-repeat;"></div>
     <div class="info">
        <h2 class="book-title"><?php echo $item['title']; ?></h2>
        <h3 class="book-author"><?php echo $item['author']; ?></h3>
        <h3 class="book-price"><?php echo $item['price']; ?></h3>
        
        <form action="<?php echo "preview.php?book_id=".$item['book_id']; ?>" method="POST">
          <label for="book-amout">Quantity</label>
          <input type="number" class="book-amount text-field" name="quantity" >
          <input class="def-button add-to-cart" type="submit" name="enter" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="book-reviews">
      <h3 class="header">Reviews</h3>
      <ul class="review-list">

      		<?php
      				# assigning function to view review to variable com

      				$com = comment($conn, $item['book_id']);
      				echo $com;
      		 ?>
       
      </ul>
      <div class="add-comment">
        <h3 class="header">Add your comment</h3>

        <!-- Review Form -->
        <form class="comment" action="<?php echo "preview.php?book_id=".$item['book_id']; ?>" method="POST">
          <textarea class="text-field" name="review" placeholder="write something"></textarea>

          <button class="def-button post-comment" type="submit" name="submit">Upload comment</button>

         <!--<input type="submit" class="def-button post-comment" name="submit" value="Upload comment"> -->
        </form>
      </div>
    </div>
  </div>

   <?php
  		include '../includes/front_footer.php';
  ?>