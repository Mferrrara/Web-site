<!DOCTYPE html>
<html lang="it">

<head>
    <title>My Videogames</title>
    <link rel="icon" href="../images/arcade.png" type="image/png" />
    <meta charset="utf-8" />
    <meta name="author" content="Luca Gerbasi e Mario Ferrara" />
    <meta name="keywords" content="games, giochi, recensioni, best giochi, community giochi, giochi pc, giochi xbox, giochi playstation" />
    <meta name="description" content="Questo &egrave; un sito per scrivere o consultare recensioni di videogames " />
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/headerStyle.css">
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/footerStyle.css">
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/gameStyle.css">
</head>

<body>
    <?php
    include "../general/phpFunction.php";
    session_start();
    include "../general/header.php";

    if (empty($_SESSION["username"])) {
        echo ('<div class="riservata"><p class="riservataMessage">Pagina riservata agli utenti registrati. <br/>
        Effettua il <a href="../general/login.php">Login</a> oppure <a href="../signIn/signIn.php">Registrati</a> per continuare</p></div>');
    } else {
        $title = $_GET['title'];
        $_SESSION["title"] = $title;
        $username = $_SESSION["username"];
        $gioco = stampaGioco($title);
    ?>
    <div class="gameContainer">
        <div class="game">
            <?php
            echo ('<h1 class = "tGame">' . $gioco['nome'] . '</h1>' .
                '<img class="iGame" src="../images/' . $gioco['immagine'] . '" alt=""' . '/>' .
                '<p class ="dGame"> ' . $gioco['descrizione'] . '</p>' .
                '<p class = "pGame"> <span class= "descrizione"> Produttore: </span> ' . $gioco['produttore'] . '</p>' .
                '<p class = "cGame"> <span class= "descrizione"> Categoria: </span> ' . $gioco['categoria'] . '</p>' .
                '<p class = "lGame"> <span class= "descrizione"> lingue supportate: </span>' . $gioco['lingua'] . '</p>' .
                '<p class = "pGame"> <span class= "descrizione"> piattaforme supportate: </span> ' . $gioco['piattaforma'] . '</p>');
            ?>
        </div>
        <div class="commenti">
    <?php
        $commenti = stampaCommenti($title);
        $checkCommento = true;
        if (!empty($commenti)) {
            echo ('<h3 id="xCommento"> Commenti  </h3>');
            foreach ($commenti as $commentatore => $commento) {
                echo ('<p class = "nCommento"> <span class="commentatore"> ' . $commentatore . ' </span>'.
                    ' <span class = "commento"> ' . $commento . '</span>' . '</p>');
                if ($commentatore == $username) {
                    $checkCommento = false;
                    echo ('<a class="cancella" href="gameCancellaCommento.php?title=' . $title . '&' . 'username=' . $username . '"> Cancella </a>');
                }
            }
        }
        if ($checkCommento || empty($commenti)) {
            include "gameFormCommento.html";
        }
    ?>
    </div>
    </div>
    <?php    
    }
    include "../general/footer.html";
    ?>

</body>

</html>