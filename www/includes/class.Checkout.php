<?php

	# To Insert Into Checkout Table after Getting Total amount and Quantity
	
	class Checkout {

		private $total;
		private $totalPur = 0;
		private $quantity;
		private $tq = 0; //Total Quantity
		private $sub; //Price From Book Table Without the Dollar Sign
		//private $stmt;



			# Method To Get Price From Book Table
			private function GetItemPrice($dbconn, $bkid) {
				$statement = $dbconn->prepare("SELECT * FROM books WHERE book_id=:bi");
				$statement->bindParam(':bi', $bkid);
				$statement->execute();

				$rowBook = $statement->fetch(PDO::FETCH_ASSOC);
				$this->sub = substr($rowBook['price'], 1);

			}



			# Method To Select From Cart Table
			private function SelectFromCart($dbconn, $userID){

				$stmt = $dbconn->prepare("SELECT * FROM cart WHERE user_id=:id");
				$stmt->bindParam(':id', $userID);
				$stmt->execute();

				return $stmt;
			}



			# Method To Get Total Purchase
			public function getTotal($dbconn, $userID){
		
				$cart = $this->SelectFromCart($dbconn, $userID);

				while($row = $cart->fetch(PDO::FETCH_ASSOC)) { 

					$this->GetItemPrice($dbconn, $row['book_id']);

					$this->total = $this->sub * $row['quantity'];
					$this->totalPur += $this->total; 
		
				}
				return $this->totalPur;
			}	

			
			
			# method for counting quantity in cart
			public function quantity($dbconn, $userID){

				$cart = $this->SelectFromCart($dbconn, $userID);

				while ($row = $cart->fetch(PDO::FETCH_ASSOC)) {
						
						$this->quantity = $row['quantity'];

						$this->tq += $this->quantity;
				}
					return $this->tq;
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


}