<html>

<head>
	<title>My VideoGames - log in</title>
    <link rel="icon" href="../images/arcade.png" type="image/png" />
    <meta charset="utf-8" />
    <meta name="author" content="Luca Gerbasi e Mario Ferrara" />
    <meta name="keywords" content="games, giochi, recensioni, best giochi, community giochi, giochi pc, giochi xbox, giochi playstation" />
    <meta name="description" content="Questo &egrave; un sito per scrivere o consultare recensioni di videogames " />
	<script src="login.js"></script>
	<link rel="stylesheet" type="text/css" href="../fogliDiStile/loginStyle.css" />
	<link rel="stylesheet" type="text/css" href="../fogliDiStile/headerStyle.css" />
	<link rel="stylesheet" type="text/css" href="../fogliDiStile/footerStyle.css" />
</head>

<body>
	<?php
	include "phpFunction.php";
	include "../general/header.php";
	$username = "";
	if (!empty($_POST)) {
		if ($_POST['username'] || $_POST['password']) { 
			$username =  $_POST['username'];
			$pass =  $_POST['password'];
			$hash = getPassword($username);
			if (!$hash) {
				include "loginForm.php";
				echo ('<script> loginFallito("fL","L\'utente non esiste. Riprova "); </script>');
			} else {
				if (password_verify($pass, $hash)) {
					session_start();
					$_SESSION['username'] = $username;
					header("location: ../homepageWithLogin/homepageWL.php");
				} else {
					include "loginForm.php";
					echo ('<script> loginFallito("fL","Username o password errati. Riprova "); </script>');
				}
			}
		} else {
			echo "<p>ERRORE: username o password non inseriti <a href=\"login.html\">Riprova</a></p>";
			exit();
		}
	} else {
		include "loginForm.php";
	}
	include "../general/footer.html"
	?>

</body>

</html>