<?php

	# Class To display Recently Viewed Books

	class RecentlyViewed{


		private function ToCheck($dbconn, $userID, $bookID){

			$statement = $dbconn->prepare("SELECT * FROM recentlyViewed WHERE book_id=:bk AND user_id=:ud");
			$statement->bindParam(':bk', $bookID);
			$statement->bindParam(':ud', $userID);
			$statement->execute();

			return $statement;
		}


		function insertIntoRecentlyViewed($dbconn, $userID, $bookID) {

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
}