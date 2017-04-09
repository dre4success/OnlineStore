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

		

		$getit = topSelling($conn);

    
               // $view = trending($conn);
              

            
?>

	 <!-- main content starts here -->
  <div class="main">
    <div class="book-display">

                    
    			
      <div class="display-book" style="background: url('../<?php echo $getit['file_path']; ?>');
  										background-size: cover;
  										background-position: center;
  										background-repeat: no-repeat;"></div>
     <div class="info">
        <h2 class="book-title"><?php echo $getit['title']; ?></h2>
        <h3 class="book-author"><?php echo $getit['author']; ?></h3>
        <h3 class="book-price"><?php echo $getit['price']; ?></h3>
        			
        	<form>
          <label for="book-amout">Amount</label>
          <input type="number" class="book-amount text-field">
          <input class="def-button add-to-cart" type="submit" name="" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="trending-books horizontal-book-list">
      <h3 class="header">Trending</h3>
      <ul class="book-list">
        

      <?php 

      $trend = "Trending";

      $stmt = $conn->prepare("SELECT * FROM books WHERE flag=:tr");

      $stmt->bindParam(':tr', $trend);

      $stmt->execute();  

                      
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>  
              <li class="book">        
          <a href="#"><div class="book-cover" style="background: url('../<?php echo $row['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $row['price']; ?></p></div>
              

        </li>
          <?php } ?>
      
      </ul>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
       <?php 

      $recent = "Recently-Viewed-Items";

      $stmt = $conn->prepare("SELECT * FROM books WHERE flag=:tr");

      $stmt->bindParam(':tr', $recent);

      $stmt->execute();  

                      
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>  
              <li class="book">        
          <a href="#"><div class="book-cover" style="background: url('../<?php echo $row['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $row['price']; ?></p></div>
              

        </li>
          <?php } ?>
     
      </ul>
    </div>
    
  </div>

   <?php
  		include '../includes/front_footer.php';
  ?>