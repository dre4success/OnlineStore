<?php
		
    //session_start();
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

    include '../includes/class.Pagination.php';

    $uid = $_SESSION['id'];

    $paginate = new Pagination();

    


    //$start = 0;

    

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
      </ul>
    </div>
  </div>
  <!-- main content starts here -->
  <div class="main">
    <div class="main-book-list horizontal-book-list">
      <ul class="book-list">
        

        		<?php 
            if(isset($_GET['cat_id'])) {
              $catID = $_GET['cat_id'];
            } else {
              echo " i got here";
              $catID = firstPreview($conn);
            }

            if(isset($_GET['p'])) {

              $page = $_GET['p'];
            }

            else{
              $page = $paginate->all($conn, $catID);
            }

              if(isset($_GET['s'])) {

                $start = $_GET['s'];
                
              } 
              else {
                $start = 0;
                
              }
        			$stmt = $conn->prepare("SELECT * FROM books WHERE category_id=:id LIMIT :start, 2");
					    $stmt->bindParam(':id', $catID); 
              $j = (int)$start;
              $stmt->bindParam(':start', $j, PDO::PARAM_INT);
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

      </ul>
      <div class="actions">
          <?php
            $curpage = ceil($start / 2) + 1;
            $start = ($curpage - 1) * 2;
            $next = $start + 2;
            $prev = $start - 2;
            echo $curpage;
            if($start > 0 ) {
              echo '<a href="catalogue.php?p='.$page.'&s='.$prev.'&cat_id='.$catID.'"><button class="def-button next">Prev</button></a>';
            }
            
            if($curpage != $page) {
              echo '<a href="catalogue.php?p='.$page.'&s='.$next.'&cat_id='.$catID.'"><button class="def-button next">Next</button></a>';
            }
          ?>
        <!-- <button class="def-button previous">Previous</button>
        <button class="def-button next">Next</button> -->
      </div>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">&nbsp;&nbsp;&nbsp;&nbsp; Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>

        <?php 
          if(!$_SESSION){
             $stmt = $conn->prepare("SELECT * FROM recentlyViewed WHERE user_id=:ui");
             $stmt->bindParam(':ui', $sid);
             $stmt->execute(); 
                
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  

               $stamt = $conn->prepare("SELECT * FROM books WHERE book_id=:bi");
               $stamt->bindParam(':bi', $row['book_id']);
               $stamt->execute(); 
               $rowb = $stamt->fetch(PDO::FETCH_ASSOC); ?>
               
              <li class="book">        
          <a href="<?php echo "preview.php?book_id=".$rowb['book_id']?>"><div class="book-cover" style="background: url('../<?php echo $rowb['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $rowb['price']; ?></p></div>
              

        </li>
          <?php } } else { ?>
          
          <?php

             $stmt = $conn->prepare("SELECT * FROM recentlyViewed WHERE user_id=:ui");
             $stmt->bindParam(':ui', $uid);
             $stmt->execute(); 
                
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  

               $stamt = $conn->prepare("SELECT * FROM books WHERE book_id=:bi");
               $stamt->bindParam(':bi', $row['book_id']);
               $stamt->execute(); 
               $rowb = $stamt->fetch(PDO::FETCH_ASSOC); ?>

              <li class="book">        
          <a href="<?php echo "preview.php?book_id=".$rowb['book_id']?>"><div class="book-cover" style="background: url('../<?php echo $rowb['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $rowb['price']; ?></p></div>
              

        </li>
        <?php } }?>
       
      </ul>
    </div>
    
  </div>

  <?php
  		include '../includes/front_footer.php';
  ?>