<?php
		
		# Creating a Pagination Class
		
		class Pagination{

			private $page;
			private $bookPerPage = 4;
			private $offset;
			private $totalPages;

				public function __construct(){

					if(isset($_GET['page'])) {
						$this->page = $_GET['page'];
					} else
					{
						$this->page = 1;
					}
					$this->offset = ($this->page - 1) * $this->bookPerPage;
				}

				public function query($dbconn, $catid) {
					

					$stmt = $dbconn->prepare("SELECT * FROM books WHERE category_id=:id LIMIT $this->offset, $this->bookPerPage");
					$stmt->bindParam(':id', $catid);

					$stmt->execute();
				}

				public function all($dbconn) {


					$stmt = $dbconn->prepare("SELECT * FROM books WHERE category_id=:id");
					$stmt->bindParam(':id', $_GET['cat_id']);

					$stmt->execute();

					$count = $stmt->rowCount();

					$this->totalPages = ceil($count/$this->bookPerPage);
				}
		}
?>