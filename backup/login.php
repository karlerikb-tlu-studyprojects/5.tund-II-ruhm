<?php

	require("../../../config.php");
	require("functions.php");
	
	if(isset($_SESSION["userId"] )) {
		header("Location: data.php");
	}
	


	$loginEmailError = "";
	$loginPasswordError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	$nameError = "";
	$dateofBirthError = "";
	$addressError = "";
	$phoneNumberError = "";
	$gender = "";
	$signupEmail = "";
	$firstName = "";
	$lastName = "";
	$dateDay = "";
	$dateMonth = "";
	$dateYear = "";
	$country = "";
	$address = "";
	$phoneNumber = "";
	
	

	
	
	//****LOGIN KASUTAJAGA****

	if(isset($_POST["loginEmail"] )) {
		if(empty($_POST["loginEmail"] )) {
			$loginEmailError = "Sisesta oma E-mail";
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}

	if(isset($_POST["loginPassword"] )) {
		if(empty($_POST["loginPassword"] )) {
			$loginPasswordError = "Sisesta oma parool";
		} else {
			$loginPassword = $_POST["loginPassword"];
		}
	}
	
	//****REGISTREERI KASUTAJA****
	
	if(isset($_POST["signupEmail"] )) {
		if(empty($_POST["signupEmail"] )) {
			$signupEmailError = "See väli on kohustuslik";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
	}
	
	if(isset($_POST["signupPassword"] )) {
		if(empty($_POST["signupPassword"] )) {
			$signupPasswordError = "Parool on kohustuslik";
		} else {
			if(strlen($_POST["signupPassword"] ) <8 ) {
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärki";
			}
		}
	}
	
	
	if(isset($_POST["firstName"] )) {
		if(empty($_POST["firstName"] )) {
			$nameError = "Palun sisestage oma täisnimi";
		} else {
			$firstName = $_POST["firstName"];
		}
	}
	
	if(isset($_POST["lastName"] )) {
		if(empty($_POST["lastName"] )) {
			$nameError = "Palun sisestage oma täisnimi";
		} else {
			$lastName = $_POST["lastName"];
		}
	}
	
	if(isset($_POST["dateDay"] )) {
		if(empty($_POST["dateDay"] )) {
			$dateofBirthError = "Palun sisestage sünniaeg";
		} else {
			$dateDay = $_POST["dateDay"];
		}
	}
	
	if(isset($_POST["dateMonth"] )) {
		if(empty($_POST["dateMonth"] )) {
			$dateofBirthError = "Palun sisestage sünniaeg";
		} else {
			$dateMonth = $_POST["dateMonth"];
		}
	}
		
	if(isset($_POST["dateYear"] )) {
		if(empty($_POST["dateYear"] )) {
			$dateofBirthError = "Palun sisestage sünniaeg";
		} else {
			$dateYear = $_POST["dateYear"];
		}
	}
	
	if(isset($_POST["country"] )) {
		if(empty($_POST["country"] )) {
			$addressError = "Palun sisestage oma aadress";
		} else {
			$country = $_POST["country"];
		}
	}
	
	if(isset($_POST["address"] )) {
		if(empty($_POST["address"] )) {
			$addressError = "Palun sisestage oma aadress";
		} else {
			$address = $_POST["address"];
		}
	}
	
	if(isset($_POST["phoneNumber"] )) {
		if(empty($_POST["phoneNumber"] )) {
			$phoneNumberError = "Palun sisestage oma telefoninumber";
		} else {
			$phoneNumber = $_POST["phoneNumber"];
		}
	}
	
	if(isset($_POST["gender"] )) {
		if(!empty($_POST["gender"] )) {
			$gender = $_POST["gender"];
		}
	}
	
	
	
	//******
	
	
	if($signupEmailError == "" &&
		empty($signupPasswordError) &&
		isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"])
		) {
			echo "Salvestan... <br>";
			echo "email: ".$signupEmail."<br>";
			echo "password: ".$_POST["signupPassword"]."<br>";
			$password = hash("sha512", $_POST["signupPassword"]);
			echo "password hashed: ".$password."<br>";
			signUp($signupEmail, $password);
		}
	
	
	$error = "";
	if(isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])
	) {
		$error = login($_POST["loginEmail"], $_POST["loginPassword"]);
	}
	
	
	

?>









 <!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>
	<h1>Logi sisse</h1>
	<form method="POST">
		<input name="loginEmail" type="text" placeholder="E-mail"> <?php echo $loginEmailError; ?>
		<br><br>
	
		<input name="loginPassword" type="password" placeholder="Parool"> <?php echo $loginPasswordError; ?>
		<br><br>
		
		<input type="submit" value="Logi sisse">
	
	</form>
	
	
	<h1>Loo kasutaja</h1>
	<form method="POST">
			<input name="signupEmail" type="text" placeholder="E-mail" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
		<br><br>
		
			<input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>
		<br><br>
		
		<label>Nimi</label>
		<br>
			<input name="firstName" type="text" placeholder="Eesnimi" value="<?=$firstName;?>">
			<input name="lastName" type="text" placeholder="Perekonnanimi" value="<?=$lastName;?>"> <?php echo $nameError; ?>
		<br><br>
		
		<label>Sugu</label>
		<br>
			<?php if($gender == "male") { ?>
			<input name="gender" type="radio" value="male" checked> Mees	
			<?php } else { ?>
			<input name="gender" type="radio" value="male"> Mees
			<?php } ?>
			
			<?php if($gender == "female") { ?>
			<input name="gender" type="radio" value="female" checked> Naine
			<?php } else { ?>
			<input name="gender" type="radio" value="female"> Naine
			<?php } ?>
			
			<?php if($gender == "other") { ?>
			<input name="gender" type="radio" value="other" checked> Ei soovi öelda
			<?php } else { ?>
			<input name="gender" type="radio" value="other"> Ei soovi öelda
			<?php } ?>
		<br><br>
		
		<label>Sünniaeg</label>
		<br>
			<input name="dateDay" type="number" placeholder="Päev" value="<?=$dateDay;?>">
			<input name="dateMonth" type="number" placeholder="Kuu" value="<?=$dateMonth;?>">
			<input name="dateYear" type="number" placeholder="Aasta" value="<?=$dateYear;?>"> <?php echo $dateofBirthError; ?>
		<br><br>
		
		<label>Aadress</label>
		<br>
			<input name="country" type="text" placeholder="Riik" value="<?=$country;?>">
			<input name="address" type="text" placeholder="Aadress" value="<?=$address;?>"> <?php echo $addressError; ?>
		<br><br>
		
		<label>Kontakttelefon</label>
		<br>
			<input name="phoneNumber" type="text" value="<?=$phoneNumber;?>"> <?php echo $phoneNumberError; ?>
		<br><br>
		
		<input type="submit" value="Loo kasutaja">
		
	</form>
	
</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		