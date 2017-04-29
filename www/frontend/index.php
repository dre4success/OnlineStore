<?php
		
   
    # title
		$page_title = "Home";

		# body id for css
		$body_id = "home";

		# load db connection
		include '../includes/db.php';

		# load function
		include '../includes/functions.php';

		# include header
		include '../includes/user_header.php'; 

    # include RecentlyViewed Class
    include '../includes/class.RecentlyViewed.php';

    # instantiating object for recently viewed
    $recent = new RecentlyViewed();

    if(isset($_SESSION['id'])){
      $uid = $_SESSION['id'];
    }
?>

	 <!-- main content starts here -->
  <div class="main">      
    <div class="book-display">         

    			   <?php 
                  topSelling($conn, function($data) {
             ?>

      <a href="<?php echo "preview.php?book_id=".$data['book_id']?>"><div class="display-book" 
               style="background: url('../<?php echo $data['file_path']; ?>');
  										background-size: cover;
  										background-position: center;
  										background-repeat: no-repeat;"></div></a>
     <div class="info">
        <h2 class="book-title"><?php echo $data['title']; ?></h2>
        <h3 class="book-author"><?php echo $data['author']; ?></h3>
        <h3 class="book-price"><?php echo $data['price']; ?></h3>
        			<?php });?>

        	<!--<form>
          <label for="book-amout">Quantity</label>
          <input type="number" class="book-amount text-field">
          <input class="def-button add-to-cart" type="submit" name="" value="Add to cart">
        </form> -->
      </div>
    </div>
    <div class="trending-books horizontal-book-list">
      <h3 class="header">Trending</h3>
      <ul class="book-list">
        
      <?php 

              trending($conn, function($data){
                      
              while($row = $data->fetch(PDO::FETCH_ASSOC)) { ?>  

          <li class="book">        
          <a href="<?php echo "preview.php?book_id=".$row['book_id']?>"><div class="book-cover" 
               style="background: url('../<?php echo $row['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $row['price']; ?></p></div>
              

        </li>
        
          <?php } });?>
      
      </ul>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>

            <?php
              # include recently viewed books
              include 'recentlyviewed.php';
            ?>
      </ul>
    </div>
    
  </div>

   <?php
  		include '../includes/front_footer.php';
  ?>