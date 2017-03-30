<?php
		# for inserting into database

		function doAdminRegister($dbconn, $input) {

			#hashing password
			$hash = password_hash($input['password'], PASSWORD_BCRYPT);

			#insert preparation
			$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");			

			$data = [
					':fn' => $input['fname'],
					':ln' => $input['lname'],
					':e' => $input['email'],
					':h' => $hash
					];

			$stmt->execute($data);


		}

?>		