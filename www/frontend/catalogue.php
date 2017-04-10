<?php
		
    session_start();
    # title
		$page_title = "Catalogue";

		# body id for css
		$body_id = "catalogue";

		# load db connection
		include '../includes/db.php';

		# load function
		include '../includes/functions.php';

		# include header
		include '../includes/user_header.php'; 



?>

  <div class="side-bar">
    <div class="categories">
      <h3 class="header">Categories</h3>
      <ul class="category-list">

      			<?php 
      					$stmt = $conn->prepare("SELECT * FROM category");
      					$stmt->execute();

      					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      					$id = $row['category_id'];
      					$cat = $row['category_name'];
      			 ?>

        			<a href="catalogue.php?cat_id=<?php echo $id; ?>&cat_name=<?php echo $cat; ?>"><li class="category"><?php echo $cat; ?></li></a>

        			<?php } ?>
       <!-- <a href="#"><li class="category">HTML</li></a>
        <a href="#"><li class="category">History</li></a>
        <a href="#"><li class="category">Literature</li></a>
        <a href="#"><li class="category">Mathematics</li></a>
        <a href="#"><li class="category">Engineering</li></a>
        <a href="#"><li class="category">Politics</li></a>
        <a href="#"><li class="category">Music</li></a>
        <a href="#"><li class="category">Literature</li></a>
        <a href="#"><li class="category">Mathematics</li></a>
        <a href="#"><li class="category">Engineering</li></a>
        <a href="#"><li class="category">Politics</li></a>
        <a href="#"><li class="category">Music</li></a> -->
      </ul>
    </div>
  </div>
  <!-- main content starts here -->
  <div class="main">
    <div class="main-book-list horizontal-book-list">
      <ul class="book-list">
        

        		<?php 
        			$stmt = $conn->prepare("SELECT * FROM books WHERE category_id=:id");
					$stmt->bindParam(':id', $_GET['cat_id']);

					$stmt->execute();
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>

				<li class="book">

          <a href="<?php echo "preview.php?book_id=".$row['book_id'] ?>"><div class="book-cover"  style="background: url('../<?php echo $row['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $row['price']; ?></p></div>

        </li>
        	<?php } ?>
      <!--  <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$90</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$250</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$50</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$250</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$50</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$125</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$90</p></div>
        </li> -->
      </ul>
      <div class="actions">
        <button class="def-button previous">Previous</button>
        <button class="def-button next">Next</button>
      </div>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$250</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$50</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$125</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$90</p></div>
        </li>
      </ul>
    </div>
    
  </div>

  <?php
  		include '../includes/front_footer.php';
  ?>