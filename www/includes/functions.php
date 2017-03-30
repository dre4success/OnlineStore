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


		function displayErrors($dummy) {
				$result = "";

			if(isset($dummy)) {
				
				$result = '<span class="err">'. $dummy. '</span>';

			}
			return $result;
		}


		function adminLogin($dbconn, $enter) {
			

			$hash = password_hash($enter['password'], PASSWORD_BCRYPT);

			# prepared statement
			$statement = $dbconn->prepare("SELECT email, hash FROM admin WHERE email=:em AND hash=:ha");

			# bind params
			$data = [
						':em' => $enter['email'],
						':ha' => $hash
					];

			$statement->execute($data);

			$count = $statement->fetchColumn();

			if($count == 1) {
				

				while($row = $statement->fetchAll()) {

					$_SESSION['id'] = $row['admin_id'];
					$_SESSION['email']	= $row['email'];

					header("Location:home.php");
				}
			} else {

					$login_error = "Wrong email or password";
					header("Location:login.php?login_error=$login_error");
			}

			
		}

?>		