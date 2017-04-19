<?php
	
	class Checkout {

		private $total;
		private $totalPur;
		private $quantity;
		private $tq = 0;
		

			//public function selectFromCart()

			# method to get total purchase
			public function getTotal($dbconn, $userID){


				$stmt = $dbconn->prepare("SELECT * FROM cart WHERE user_id=:id");
				$stmt->bindParam(':id', $userID);

				$stmt->execute();

				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

				$statement = $dbconn->prepare("SELECT * FROM books WHERE book_id=:bi");
				$statement->bindParam(':bi', $row['book_id']);
				$statement->execute();

				$rowBook = $statement->fetch(PDO::FETCH_ASSOC);
				$sub = substr($rowBook['price'], 1);

				$this->total = $sub * $row['quantity'];

				$this->totalPur += $this->total; 
		
				}

			return $this->totalPur;
	}	
		# get total if user is not logged in
		function getTotalTempCart($dbconn) {

			$stmt = $dbconn->prepare("SELECT * FROM temp_cart");
			
				$stmt->execute();

				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

				$statement = $dbconn->prepare("SELECT * FROM books WHERE book_id=:bi");
				$statement->bindParam(':bi', $row['book_id']);
				$statement->execute();

				$rowBook = $statement->fetch(PDO::FETCH_ASSOC);
				$sub = substr($rowBook['price'], 1);

				$this->total = $sub * $row['quantity'];

				$this->totalPur += $this->total; 
		
				}

			return $this->totalPur;
		}

			# method to insert into checkout
			public function insertIntoCheckout($dbconn, $userID, $input, $tp){

				$stmt = $dbconn->prepare("INSERT INTO checkout(phoneNumber, address, postCode, user_id, totalPurchase) 
														VALUES(:pn, :ad, :pc, :ui, :tp)");

				$data = [
							':pn'=>$input['phoneNumber'],
							':ad'=>$input['addy'],
							':pc'=>$input['code'],
							':ui'=>$userID,
							':tp'=>$tp
						];
				$stmt->execute($data);

				redirect("index.php?msge=Thank You very much for using our service, Your Goods Will be shipped to you within 2days");
			}

			# method for counting quantity in cart
			public function quantity($dbconn, $userID){

				$stmt = $dbconn->prepare("SELECT quantity FROM cart WHERE user_id=:id");
				$stmt->bindParam(':id', $userID);

				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						
						$this->quantity = $row['quantity'];

						$this->tq += $this->quantity;
				}
					return $this->tq;
			}

			# method for counting quantity when no user is logged in
			public function quantitynotID($dbconn){

				$stmt = $dbconn->prepare("SELECT quantity FROM temp_cart");
				//$stmt->bindParam(':id', $userID);

				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						
						$this->quantity = $row['quantity'];

						$this->tq += $this->quantity;
				}
					return $this->tq;
			}

}