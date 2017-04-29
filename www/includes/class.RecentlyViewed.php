<?php

	# Class To display Recently Viewed Books

	class RecentlyViewed{

		private $result;

		private function ToCheck($dbconn, $userID, $bookID){

			$statement = $dbconn->prepare("SELECT * FROM recentlyViewed WHERE book_id=:bk AND user_id=:ud");
			$statement->bindParam(':bk', $bookID);
			$statement->bindParam(':ud', $userID);
			$statement->execute();

			return $statement;
		}


		public function insertIntoRecentlyViewed($dbconn, $userID, $bookID) {

		$chk = $this->ToCheck($dbconn, $userID, $bookID);
		$count = $chk->rowCount();

			if($count == 0) {
		$stmt = $dbconn->prepare("INSERT INTO recentlyViewed(book_id, user_id) VALUES(:bi, :ui)");

		$data = [
					':bi'=>$bookID,
					':ui'=>$userID
				];
		
		$stmt->execute($data);
			}
		}


		public function selectFromRecentlyViewed($dbconn, $userID) {

			 $stmt = $dbconn->prepare("SELECT * FROM recentlyViewed WHERE user_id=:ui ORDER BY recent_id DESC LIMIT 4 ");
             $stmt->bindParam(':ui', $userID);
             $stmt->execute(); 
                
             return $stmt;
             
         }

        public function selectFromBook($dbconn, $bkid){

               $stmt = $dbconn->prepare("SELECT * FROM books WHERE book_id=:bi");
               $stmt->bindParam(':bi', $bkid);
               $stmt->execute(); 
              
               return $stmt;
		}

	
}