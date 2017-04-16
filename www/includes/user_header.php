<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../styles/frontstyles.css">
    <title><?php echo $page_title ?></title>
</head>
<body id="<?php echo $body_id ?>">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->

  <!-- top bar starts here -->
  <div class="top-bar"> 

    <div class="top-nav">
      <a href="index.html"><h3 class="brand"><span>B</span>rain<span>F</span>ood</h3></a>
      <ul class="top-nav-list">
        <li class="top-nav-listItem Home"><a href="index.php">Home</a></li>
        <li class="top-nav-listItem catalogue"><a href="catalogue.php">Catalogue</a></li>

<?php session_start();

   if(isset($_SESSION['logged']) == true && $_SESSION['logged']){
?>

  <li class="top-nav-listItem login"><?php  echo $_SESSION['username']?></li>
        <li class="top-nav-listItem register"><a href="logout.php">Logout</a></li>

        <?php }else { ?>


        <li class="top-nav-listItem login"><a href="user_login.php">Login</a></li>
        <li class="top-nav-listItem register"><a href="user_register.php">Register</a></li>

        	<?php } ?>

        <li class="top-nav-listItem cart">
          <div class="cart-item-indicator">

          <?php

            include_once '../includes/db.php';

        # load function
          include_once '../includes/functions.php';

          
          
          if(isset($_SESSION['id'])) {

            # instantiating object for counting quantity in cart 
          $quantity = new Checkout();
            
            # assigning obeject->method to variable
            $quan = $quantity->quantity($conn, $_SESSION['id']);

          ?>
              <!-- echoing quantity count for cart in header -->
            <p><?php echo $quan; ?></p>

              <!-- here, if no user is logged in -->
            <?php } elseif(!isset($_SESSION['id'])) {

               $quantity = new Checkout();
            $quant = $quantity->quantitynotID($conn);

            ?>
              <p><?php echo $quant; ?></p>
              <?php }?>
          </div>
          <a href="cart.php">Cart</a>
        </li>
      </ul>

      <form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>


    </div>
     <?php
       if(isset($_GET['msge'])){
        echo '<p>'.$_GET['msge'].'</p>';
      }
      ?>
  </div>