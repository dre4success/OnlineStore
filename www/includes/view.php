<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title ?></title>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>

<body>
	<section>
		<div class="mast">
			<h1><a href="home.php">T<span>SSB</span> Home</a></h1>
			<nav>
				<ul class="clearfix">
					<li><a href="add_category.php" <?php culNav("add_category.php"); ?>>Add Category</a></li>
					<li><a href="view_category.php" <?php culNav("view_category.php");?>>View Category</a></li>
					<li><a href="add_product.php" <?php culNav("add_product.php");?>>Add Product</a></li>
					<li><a href="view_product.php" <?php culNav("view_product.php");?>>View Product</a></li>
					<li><a href="logout.php" <?php culNav("logout.php");?>>Logout</a></li>
				</ul>
			</nav>
		</div>
	</section>