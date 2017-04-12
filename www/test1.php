<?php

	require 'Products.php';

	include 'Book.php';

	include 'Dvd.php';

	# instantiate an object of the product class

/*	$product = new Product();

	# $product is a reference to our object, Product();

	$product->setTitle("Mens Wear");

	$title = $product->getTitle();
	echo $title;

	echo '<br>';
	//echo $product->title;

	$prod = new Product();

	$prod->setPrice(30);

	$price = $prod->getPrice();

	echo $price;

	echo '<br>';

	$prod2 = new Product();

	$prod2->setType("T-Shirt");

	$type = $prod2->getType();

	echo $type; */

	//$prod = new Product("jabgaladugbun", 300, "book");

	//$p = $prod->getPrice();

	//echo $p;

	$book = new Book(1000, "measuring time", 200);

	$b = $book->getTitle();

	echo '<br>';

	echo $b;

	$c = $book->getType();

	echo '<br>';

	echo $c;

	$count = new Book(1000, "jaja", 20);

	$cou = $count->getPageCount();

	echo '<br>';

	echo $cou;

	$dv = new Dvd("100 minutes", "titanic", 500);

	echo '<br>';

	$d = $dv->getDuration();
	echo $d;

	echo $book->preview();

	echo $dv->preview();









