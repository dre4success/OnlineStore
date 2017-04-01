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


	function uploadFile($wobi, $sempe, $foto, $ten) {
			

		if($wobi[$foto]['size'] > MAX_FILE_SIZE) {
			$sempe[] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
		}

		if(!in_array($wobi[$foto]['type'])){
			$sempe[] = "invalid file type";
		}

		# generate random number to append
		$rnd = rand(0000000000, 9999999999);

		# strip filename for spaces
		$strip_name = str_replace(" ", "_", $wobi[$foto]['name']);

		$filename = $rnd.$strip_name;
		$destination = 'uploads/'.$filename;

		if(!move_uploaded_file($wobi[$foto]['tmp_name'], $destination)) {
		$sempe[] = "file upload failed";
	}


	}

	function authenticate() {
		if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

			header("Location:login.php");
		}
	}
?>		