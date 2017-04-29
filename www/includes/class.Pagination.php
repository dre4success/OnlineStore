<?php
		
		# Creating a Pagination Class
		
		class Pagination{

			private $page;
			private $bookPerPage = 2;
			private $offset;
			private $totalPages;
			//private $start;

				
				public function query($dbconn, $catid) {
					

					$stmt = $dbconn->prepare("SELECT * FROM books WHERE category_id=:id LIMIT $this->offset, $this->bookPerPage");
					$stmt->bindParam(':id', $catid);

					$stmt->execute();
				}

				public function all($dbconn, $catid) {


					$stmt = $dbconn->prepare("SELECT * FROM books WHERE category_id=:id");
					$stmt->bindParam(':id', $catid);

					$stmt->execute();

					$count = $stmt->rowCount();

					$this->totalPages = ceil($count/$this->bookPerPage);

					return $this->totalPages;
				}

				public function getStart($start) {
					$this->offset = ($this->page - 1) * $this->bookPerPage;
				}

				public function currentPage($offset) {
					return ($offset/$this->page) + 1;
				}
		}
?>