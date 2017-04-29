 


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