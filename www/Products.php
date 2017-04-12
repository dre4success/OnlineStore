<?php 

		abstract class Product

		{
			protected $title;

			protected $price;

			protected $type;


		/*	public function getTitle() {

				return $this->title;
			}

			public function setTitle($title) {

				$this->title = $title;
			}

			public function setPrice($price){

				$this->price = $price;
			}

			public function getPrice() {

				return $this->price;
			}

			public function setType($type){

				$this->type = $type;
			}

			public function getType() {

				return $this->type;
			} */

			# The Decorator Design Pattern

			# To define a constructor in php

			public function __construct($title, $price) {

				$this->title = $title;
				$this->price = $price;
				//$this->type = $type;
			}  

			public function getPrice() {

				return $this->price;
			} 

			public function getTitle() {

				return $this->title;
			}

			public function getType() {

				return $this->type;
			}

			abstract public function preview();

		}

