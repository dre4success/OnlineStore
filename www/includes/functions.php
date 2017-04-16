<?php
		# for inserting into database

		function doAdminRegister($dbconn, $input) {

			# hashing password
			$hash = password_hash($input['password'], PASSWORD_BCRYPT);

			# prepared statement
			$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");			

			#bind params
			$data = [
					':fn' => $input['fname'],
					':ln' => $input['lname'],
					':e' => $input['email'],
					':h' => $hash
					];

			# execute prepared statement
			$stmt->execute($data);


		}

		function doesEmailExist($dbconn, $email) {
			$result = false;

			$stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:e");

			#bind params
			$stmt->bindParam(":e", $email);
			$stmt->execute();

			# get number of rows returned
			$count = $stmt->rowCount();

			if($count > 0) {
				$result = true;
			}
			return $result;
		}


		function displayErrors($dummy, $what) {
					$result = "";
						
			if(isset($dummy[$what])) {
				
				$result = '<span class="err">'. $dummy[$what]. '</span>';

			}
					return $result; 
		}


		function adminLogin($dbconn, $enter) {
					

			$result = [];

			
			# prepared statement
			$statement = $dbconn->prepare("SELECT * FROM admin WHERE email=:em");
			
			# bind params
			$statement->bindParam(":em", $enter['email']);
			$statement->execute();

			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			$count = $statement->rowCount();

			if($count !== 1 || !password_verify($enter['password'], $row['hash'])){
					
				$result[] = false;
			} else{
				$result[] = true;
				$result[] = $row;
			}
					
				return $result;
		}	

		function redirect($loca){
			header("Location: ".$loca);
		}

	

	function authenticate() {
		if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

			header("Location:login.php");
		}
	}

	function insertCategory($dbconn, $inn) {

		# prepare statement
		$stmt = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:c)");

		# bind Params and execute statement
		$stmt->bindParam(":c", $inn['cat']);
		$stmt->execute();

	}

	function fileUpload($dum_fil, $dum_err, $dum_name) {

		define("MAX_FILE_SIZE", "2097152");

		$ext = ["image/jpg", "image/jpeg", "image/png"];

		
	# be sure a file was selected..
	if(empty($dum_fil[$dum_name]['name'])) {
	$dum_err[] = "please choose a file";
	}

	#  check file size..
	if($dum_fil[$dum_name]['size'] > MAX_FILE_SIZE) {
		$dum_err[] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
	}

		if(!in_array($dum_fil[$dum_name]['type'], $ext)) {
		$dum_err[] = "invalid file type";
	}

		#generate random number to append
	$rnd = rand(0000000000, 9999999999);

	#strip filename for spaces
	$strip_name = str_replace(" ", "_", $dum_fil[$dum_name]['name']);

	$filename = $rnd.$strip_name;
	$destination = 'uploads/'.$filename;

	if(empty($dum_err)) {
		
		if(!move_uploaded_file($dum_fil[$dum_name]['tmp_name'], $destination)) {

		$dum_err[] = "file upload failed";
				}
		echo "done";
		}
	 else {
		foreach ($dum_err as $err) {
			echo $err. '</br>';
			}
		}
	
	
}

	function UploadFile($file, $name, $uploadDir) {
		$data = [];
	$rnd = rand (0000000000,9999999999);

	$strip_name = str_replace ("","",$file[$name]['name']);

	$filename = $rnd.$strip_name;
	$destination = $uploadDir .$filename;

	if (!move_uploaded_file($file[$name]['tmp_name'], $destination)){
	$data[] = false;
	} else {
	$data[] = true;
	$data[] = $destination;
	}

	return $data;
}


	function forProduct($dbconn, $dirty, $dest){

		$state = $dbconn->prepare("SELECT category_id FROM category WHERE category_name=:ca");

		$state->bindParam(":ca", $dirty['category']);
		$state->execute();

		$row = $state->fetch(PDO::FETCH_ASSOC);

		$id = $row['category_id']; 

		$stmt = $dbconn->prepare("INSERT INTO books(title, author, category_id, price, year_of_publication, isbn, file_path, flag) 
													VALUES(:ti, :au, :cat, :pr, :yr, :is, :fi, :fg)");			

			#bind params
		$data = [
				':ti' => $dirty['title'],
				':au' => $dirty['author'],
				':cat' => $id,
				':pr' => $dirty['price'],
				':yr' => $dirty['year'],
				':is' => $dirty['isbn'],
				':fi' => $dest,
				':fg' => $dirty['flag']
				];

			$stmt->execute($data);
		}


	function viewProduct($dbconn){
				$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM books");
		$stmt->execute();

	
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

					$bk_id = $row['book_id'];
					$title = $row['title'];
					$author = $row['author'];
					$price = $row['price'];
					$year = $row['year_of_publication'];
					$isbn = $row['isbn'];

					$statement = $dbconn->prepare("SELECT category_name FROM category WHERE category_id=:ci");
					
					$statement->bindParam(":ci", $row['category_id']);
					$statement->execute();
					$row1 = $statement->fetch(PDO::FETCH_ASSOC);

					$result .= '<tr><td>'.$row['title'].'</td>';
					$result .= '<td>'.$row['author'].'</td>';
					$result .= '<td>'.$row1['category_name'].'</td>';
					$result .= '<td>'.$row['price'].'</td>';
					$result .= '<td>'.$row['year_of_publication'].'</td>';
					$result .= '<td>'.$row['isbn'].'</td>';
					$result .= '<td><img src="'.$row['file_path'].'" height="60" width="60"></td>';
					$result .= "<td><a href='edit.php?book_id=$bk_id'>edit</a></td>";
					$result .=	"<td><a href='delete_product.php?book_id=$bk_id'>delete</a></td></tr>";
				}

					return $result;
		
	}

	function viewCat($sr){
		$result = "";

		while($row = $sr->fetch(PDO::FETCH_ASSOC)){

			$cat_id = $row['category_id'];
			$cat_name = $row['category_name'];

			$result .= '<tr><td>'.$cat_id.'</td>';
			$result .= '<td>'.$row['category_name'].'</td>';
			$result .= "<td><a href='edit_cate.php?category_id=$cat_id'>edit</a></td>";
			$result .=	"<td><a href='delete_cate.php?category_id=$cat_id'>delete</a></td></tr>";
          		
		}
		return $result;
	}

	function delCat($dbconn, $what){
		$stmt = $dbconn->prepare("DELETE FROM category WHERE category_id=:c");
									$stmt->bindParam(":c", $what);
									$stmt->execute();
									
				redirect("view_category.php");
	}

	function delPro($dbconn, $what){
		$stmt = $dbconn->prepare("DELETE FROM books WHERE book_id=:c");
									$stmt->bindParam(":c", $what);
									$stmt->execute();

						redirect("view_product.php");
	}

	function editCat($dbconn, $edible){

		$stmt = $dbconn->prepare("UPDATE category SET category_name=:cn WHERE category_id=:ci");

		$data = [
					':cn'=> $edible['cat'],
					':ci'=> $edible['cid']
				];
		$stmt->execute($data);

		redirect("view_category.php");
	}

	function editPro($dbconn, $edible, $dest){

		$stmt = $dbconn->prepare("UPDATE books SET title=:ti, author=:au, category_id=:ci, price=:pr, year_of_publication=:yr, isbn=:is, file_path=:fp, 
								flag=:fl WHERE book_id=:b");

		$data = [
					':ti'=> $edible['til'],
					':au'=> $edible['auth'],
					':ci'=> $edible['cat'],
					':pr'=>	$edible['pri'],
					':yr'=> $edible['yer'],
					':is'=> $edible['bn'],
					':fp'=> $dest,
					':fl'=> $edible['ty'],
					':b'=> $edible['bk']

				];

		$stmt->execute($data);

		redirect("view_product.php");
	}


		function getBookByID($dbconn, $bookID) {
			$stmt = $dbconn->prepare("SELECT * FROM books WHERE book_id=:id");
			$stmt->bindParam(':id', $bookID);

			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
			return $row;
	}
		
	function doEditSelectCategory($dbconn,$catName){


						$statement = $dbconn->prepare("SELECT * FROM category");
						$statement->execute();

						$result = "";
						while($row = $statement->fetch(PDO::FETCH_ASSOC)) { 

							$cat_id = $row['category_id'];
							$cat_name = $row['category_name'];

							#to skip the category_name chosen

							if($cat_name == $catName) { continue; }

						$result .= "<option value='$cat_id'>$cat_name</option>";

		}


		return $result;					
					
	}

		

	function getCategoryByID($dbconn, $catid){

			$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_id=:id");
			$stmt->bindParam(':id', $catid);

			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
			return $row;
	
	}

	function doesUserEmailExist($dbconn, $email) {
			$result = false;

			$stmt = $dbconn->prepare("SELECT email FROM user WHERE email=:e");

			#bind params
			$stmt->bindParam(":e", $email);
			$stmt->execute();

			# get number of rows returned
			$count = $stmt->rowCount();

			if($count > 0) {
				$result = true;
			}
			return $result;
		}

		function doUserRegister($dbconn, $input) {

			# hashing password
			$hash = password_hash($input['password'], PASSWORD_BCRYPT);

			# prepared statement
			$stmt = $dbconn->prepare("INSERT INTO user(firstname, lastname, email, username, hash) VALUES(:fn, :ln, :e, :ur, :h)");			

			#bind params
			$data = [
					':fn' => $input['firstname'],
					':ln' => $input['lastname'],
					':e' => $input['email'],
					':ur' => $input['username'],
					':h' => $hash
					];

			# execute prepared statement
			$stmt->execute($data);

				redirect("user_register.php?msg=You Have Been Successfully Registered");
		}

		function displayErrorsUser($dummy, $what) {
					$result = "";
						
			if(isset($dummy[$what])) {
				
				$result = '<p class="form-error">'. $dummy[$what]. '</p>';

			}
					return $result; 
		}


		function UserLogin($dbconn, $enter) {
					

			$result = [];

			
			# prepared statement
			$statement = $dbconn->prepare("SELECT * FROM user WHERE email=:em");
			
			# bind params
			$statement->bindParam(":em", $enter['email']);
			$statement->execute();

			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			$count = $statement->rowCount();

			if($count !== 1 || !password_verify($enter['password'], $row['hash'])){
					
				$result[] = false;
			} else{
				$result[] = true;
				$result[] = $row;
			}
					
				return $result;
		}	

		function topSelling($dbconn) {

			$tim = "Top-Selling";

			$stmt = $dbconn->prepare("SELECT * FROM books WHERE flag=:gt");

			$stmt->bindParam(':gt', $tim);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row;
	}


		function comment($dbconn, $bookid) {

					$result = "";

			$stmt = $dbconn->prepare("SELECT * FROM review WHERE book_id=:bk");

			$stmt->bindParam(':bk', $bookid);

			$stmt->execute();

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

				$statement = $dbconn->prepare("SELECT firstname, lastname FROM user WHERE user_id=:di");
					
					$statement->bindParam(":di", $row['user_id']);
					$statement->execute();
					$row1 = $statement->fetch(PDO::FETCH_ASSOC);

					$fname = $row1['firstname'];
					$lname = $row1['lastname'];

					$f = substr($fname, 0, 1);
					$l = substr($lname, 0, 1);

		 $result .= '<li class="review">
         	 		<div class="avatar-def user-image">
            		<h4 class="user-init">'.$f.$l.'</h4>
         	 		</div>
         	 		<div class="info">
            		<h4 class="username">'.$fname." ".$lname.'</h4>
            		<p class="comment">'.$row['review'].'</p>
          			</div>
        			</li>';
			}
			return $result;
		}

		function insertIntoReview($dbconn, $userID, $bookid, $input){

			$stmt = $dbconn->prepare("INSERT INTO review(user_id, book_id, review, date) VALUES(:us, :bk, :re, now())");

				$data = [':us' => $userID,
						 ':bk' => $bookid,
						 're' => $input['review'],
						];
				$stmt->execute($data);
		}

		function addToCart($dbconn, $userID, $bookID, $input) {

			$stmt = $dbconn->prepare("INSERT INTO cart(quantity, user_id, book_id) VALUES(:qu, :ui, :bi)");

			$data = [ ':qu'=> $input['quantity'],
					  ':ui'=> $userID,
					  ':bi'=> $bookID,
					];
			$stmt->execute($data);
		}

		/*function viewCart($dbconn) {

			$result = "";

			$stmt = $dbconn->prepare("SELECT * FROM cart");
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				
				$statement = $dbconn->prepare("SELECT * FROM books WHERE book_id=:bi");
				$statement->bindParam(':bi', $row['book_id']);
				$statement->execute();

				$rowBook = $statement->fetch(PDO::FETCH_ASSOC);

				$location = '../';

				$result .= '<td><div class="book-cover  style="background: url('.($location.$rowBook['file_path']).');
  										background-size: cover;
  										background-position: center;
  										background-repeat: no-repeat;""></div></td>';

  				$result .=	'<td><p class="book-price">'.$rowBook['price'].'</p></td>';
         		$result .= '<td><p class="quantity">'.$row['quantity'].'</p></td>';
         		$result .= '<td><p class="total">'.($rowBook['price'] * $row['quantity']).'</p></td>';

			}
			return $result;
		} */

	/*	function getCartByID($dbconn, $cartID) {
			$stmt = $dbconn->prepare("SELECT * FROM cart WHERE cart_id=:id");
			$stmt->bindParam(':id', $cartID);

			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
			return $row;
	} */

	function editCart($dbconn, $cart){

		$stmt = $dbconn->prepare("UPDATE cart SET quantity=:qy WHERE cart_id=:ci");

		$data = [
					':qy'=> $cart['qty'],
					':ci'=> $cart['cartid']
				];
		$stmt->execute($data);

		redirect("cart.php");
	}

	function delCart($dbconn, $cart) {

		$stmt = $dbconn->prepare("DELETE FROM cart WHERE cart_id=:c");
									$stmt->bindParam(":c", $cart);
									$stmt->execute();
									
				redirect("cart.php");
	}

	class Checkout {

		private $total;
		private $totalPur;
		//private $dbconn;
		//private $userID;

			# method to get total purchase
			public function getTotal($dbconn, $userID){

				//$this->dbconn = $dbconn;
				//$this->userID = $userID;

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

			# method to insert into checkout
			public function insertIntoCheckout($dbconn, $userID, $input){

				$stmt = $dbconn->prepare("INSERT INTO checkout(phoneNumber, address, postCode, user_id) 
														VALUES(:pn, :ad, :pc, :ui)");

				$data = [
							':pn'=>$input['phoneNumber'],
							':ad'=>$input['addy'],
							':pc'=>$input['code'],
							':ui'=>$userID
						];
				$stmt->execute($data);

				redirect("index.php?msge=Thank You very much for using our service, Your Goods Will be shipped to you within 2days");
			}
}

?>