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


		private function selectFromRecentlyViewed($dbconn, $userID) {

			 $stmt = $dbconn->prepare("SELECT * FROM recentlyViewed WHERE user_id=:ui");
             $stmt->bindParam(':ui', $sid);
             $stmt->execute(); 
                
             return $stmt;
         }

        private function selectFromBook($dbconn, $bkid){

               $stmt = $dbconn->prepare("SELECT * FROM books WHERE book_id=:bi");
               $stmt->bindParam(':bi', $bkid);
               $stmt->execute(); 
               
               return $stmt;
	}

	public function ViewRecent($dbconn, $userID){

			$bk = $this->selectFromRecentlyViewed($dbconn, $userID);
         	 while($row = $bk->fetch(PDO::FETCH_ASSOC)) {  
         	 	$statement = $this->selectFromBook($dbconn, $row['book_id']);
         	 	$this->result = $statement->fetch(PDO::FETCH_ASSOC);
		}

		return $this->result;
	} 
         
}