<?php

	session_start();
	
	//**** SIGNUP ****
	
	function signUp ($email, $password, $firstname, $lastname, $day, $month, $year, $gender) {
		
		$database = "if16_karlerik";
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
			
			$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password, firstname, lastname, day, month, year, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			
			echo $mysqli->error;
			
			$stmt->bind_param("ssssiiis", $email, $password, $firstname, $lastname, $day, $month, $year, $gender);
			
			if($stmt->execute()) {
				echo "salvestamine õnnestus";	
			} else {
				echo "ERROR ".$stmt->error;
			}
			$stmt->close();
			$mysqli->close();
	}
	
	
	
	function login ($email, $password) {
		$error = "";
		$database = "if16_karlerik";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("SELECT id, email, password, created, firstname, lastname FROM user_sample WHERE email = ?");
		
		echo $mysqli->error;
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created, $firstNameDb, $lastNameDb);
		$stmt->execute();
		
		if($stmt->fetch()) {
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb) {
				echo "Kasutaja logis sisse ".$id;
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["userFirstName"] = $firstNameDb;
				$_SESSION["userLastName"] = $lastNameDb;
				
				header("Location: data.php");
				
			} else {
				$error = "vale parool";
			}
		} else {
			$error = "ei ole sellist emaili";
		}
		
		return $error;
		
	}
	
	




?>