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
					

			//$hash = password_hash($enter['password'], PASSWORD_BCRYPT);

			
			# prepared statement
			$statement = $dbconn->prepare("SELECT * FROM admin WHERE email=:em");
			
			# bind params
			$statement->bindParam(":em", $enter['email']);
			$statement->execute();

			
			$count = $statement->rowCount();

			if($count == 1) {
					$row = $statement->fetch(PDO::FETCH_ASSOC);

					if(password_verify($enter['password'], $row['hash'])){
					
					$_SESSION['id'] = $row['admin_id'];
					$_SESSION['email']	= $row['email'];

					header("Location:home.php");
				}
			 else {

					$login_error = "Wrong email or password";
					header("Location:login.php?login_error=$login_error");
			}

			
		} 
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

	function forProduct($dbconn, $dirty){

		define("MAX_FILE_SIZE", "2097152");

		$ext = ["image/jpg", "image/jpeg", "image/png"];


		$rnd = rand(0000000000, 9999999999);

	#strip filename for spaces
	$strip_name = str_replace(" ", "_", $_FILES['book']['name']);

	$filename = $rnd.$strip_name;
	$destination = 'uploads/'.$filename;

		if(array_key_exists('save', $_POST)) {

			if(empty($_FILES['book']['name'])) {
			$errors[] = "please choose a file";
			}

	#  check file size..
		if($_FILES['book']['size'] > MAX_FILE_SIZE) {
		$errors[] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
		}

		if(!in_array($_FILES['book']['type'], $ext)) {
		$errors[] = "invalid file type";
		}

	if(empty($errors)) {
		
		if(!move_uploaded_file($_FILES['book']['tmp_name'], $destination)) {

		$errors[] = "file upload failed";
				}
		echo "done";
		}
	 else {
		foreach ($errors as $err) {
			echo $err. '</br>';
			}
		}
		} 

			$state = $dbconn->prepare("SELECT category_id FROM category WHERE category_name=:ca");

			$state->bindParam(":ca", $dirty['category']);
			$state->execute();

			$row = $state->fetch(PDO::FETCH_ASSOC);

			$id = $row['category_id'];

			$stmt = $dbconn->prepare("INSERT INTO books(title, author, category_id, price, year_of_publication, isbn, file_path) 
													VALUES(:ti, :au, :cat, :pr, :yr, :is, :fi)");			

			#bind params
			$data = [
					':ti' => $dirty['title'],
					':au' => $dirty['author'],
					':cat' => $id,
					':pr' => $dirty['price'],
					':yr' => $dirty['year'],
					':is' => $dirty['isbn'],
					':fi' => $destination
					];

			$stmt->execute($data);

	}

	function viewProduct($dbconn){
				$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM books");
		$stmt->execute();

	
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

					$statement = $dbconn->prepare("SELECT category_name FROM category WHERE category_id=:ci");
					
					$statement->bindParam(":ci", $row['category_id']);
					$statement->execute();
					$row1 = $statement->fetch(PDO::FETCH_ASSOC);

					$result .= '<tr><td>'.$row['title'].'</td>';
					$result .= '<td>'.$row['author'].'</td>';
					$result .= '<td>'.$row1['category_name'].'</td>';
					$result .= '<td>'.$row['price'].'</td>';
					$result .= '<td>'.$row['isbn'].'</td>';
					$result .= '<td><img src="'.$row['file_path'].'" height="60" width="60"></td></tr>';
				}

					return $result;
		
	}

	function viewCat($sr){
		$result = "";

		while($row = $sr->fetch(PDO::FETCH_ASSOC)){

			$result .= '<tr><td>'.$row['category_id'].'</td>';
			$result .= '<td>'.$row['category_name'].'</td></tr>';
		}
		return $result;
	}
?>		