<?php 
      # Recently Viewed Page
    
       if(!isset($_SESSION['id'])){

              $statement = $recent->selectFromRecentlyViewed($conn, $sid);

              while($row = $statement->fetch(PDO::FETCH_ASSOC))  {  

              $data = $recent->selectFromBook($conn, $row['book_id']);

              $rowb = $data->fetch(PDO::FETCH_ASSOC); ?>
               
              <li class="book">        
          <a href="<?php echo "preview.php?book_id=".$rowb['book_id']?>"><div class="book-cover" style="background: url('../<?php echo $rowb['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $rowb['price']; ?></p></div>
              

        </li>

          <?php } } else { ?>
          
          <?php

               $statement = $recent->selectFromRecentlyViewed($conn, $uid);
  
               while($row = $statement->fetch(PDO::FETCH_ASSOC)) {  

               $data = $recent->selectFromBook($conn, $row['book_id']);

               $rowb = $data->fetch(PDO::FETCH_ASSOC); ?>

              <li class="book">        
          <a href="<?php echo "preview.php?book_id=".$rowb['book_id']?>"><div class="book-cover" style="background: url('../<?php echo $rowb['file_path']; ?>');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p><?php echo $rowb['price']; ?></p></div>
              

        </li>
        <?php } }?>