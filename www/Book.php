<?php

	class Book extends Product {

		private $pageCount;


		public function __construct($pc, $title, $price){

			# Call an overriden constructor

			Parent::__construct($title, $price);
			$this->pageCount = $pc;
			$this->type = "book";
		}


		public function getPageCount(){

			return $this->pageCount;

		}
			
		public function preview() {

			echo "<p> Type: ". $this->getType(). "</p>";
			echo "<p> Title: ". $this->getTitle(). "</p>";
			echo "<p> Price: ". $this->getPrice(). "</p>";
			echo "<p> Page Count: ". $this->getPageCount(). "</p>";
			
		}
	}