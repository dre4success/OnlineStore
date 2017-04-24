<?php
		
		# Creating a Pagination Class
		
		class Pagination{

			private $page;
			private $bookPerPage = 4;
			private $offset;

				private function query($dbconn) {
					if(isset($_GET['page'])) {
						$this->page = $_GET['page'];
					} else
					{
						$this->page = 1;
					}
					$this->offset = ($this->page - 1) * $this->bookPerPage;

					$stmt = $conn->prepare("SELECT * FROM books WHERE category_id=:id LIMIT $this->offset, $this->bookPerPage");
					$stmt->bindParam(':id', $_GET['cat_id']);

					$stmt->execute();
				}
		}
?>