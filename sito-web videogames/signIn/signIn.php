<!DOCTYPE html>
<html>

<head>
    <title>My VideoGames - sign in</title>
    <link rel="icon" href="../images/arcade.png" type="image/png" />
    <meta charset="utf-8" />
    <meta name="author" content="Luca Gerbasi e Mario Ferrara" />
    <meta name="keywords" content="games, giochi, recensioni, best giochi, community giochi, giochi pc, giochi xbox, giochi playstation" />
    <meta name="description" content="Questo &egrave; un sito per scrivere o consultare recensioni di videogames " />
    <script type="text/JavaScript" src="SignInFunction.js"></script>
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/signinStyle.css" />
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/headerStyle.css" />
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/footerStyle.css" />
</head>

<body>
    <?php
    include "../general/header.php";
    include "../general/phpFunction.php";
    $dati['username'] = "";
    $dati['email'] = "";
    $dati['nome'] = "";
    $dati['cognome'] = "";
    $dati['password'] = "";
    $dati['data'] = "";
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $dati[$key] = $value;
        }
        $existUsername = value_exist($dati['username'], "username");
        $existEmail = value_exist($dati['email'], "email");
        if ($existUsername && $existEmail) {
            insert_utente($dati['username'], $dati['email'], $dati['nome'], $dati['cognome'], $dati['password'], $dati['data']);
            echo ('<script> document.body.style = "display: block"  </script>'); #?
            echo (' <a class="success" href="../homepage/homepage.php"> <h1 class="rSuccess"> Registrazione completata con successo ! </h1>
            <p class="rSuccess">Torna alla  HOMEPAGE  ed effettua il login per accedere all\' area riservata </p> </a> ');
        } else {
            include "signInForm.php";
            if (!$existUsername) {
                echo ('<script> pValoreEsistente("eU","username"); </script>');
            }
            if (!$existEmail) {
                echo ('<script> pValoreEsistente("eE","e-mail"); </script>');
            }
        }
    } else {
        include "signInForm.php";
    }
    include "../general/footer.html";
    ?>
</body>

</html>