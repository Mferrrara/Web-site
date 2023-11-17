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
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/homepageLogStyle.css">
</head>

<body>
    <?php
    session_start();
    if (empty($_SESSION["username"])) {
        echo ('<div class="riservata"><p class="riservataMessage">Pagina riservata agli utenti registrati. <br/>
         Effettua il <a href="../general/login.php">Login</a> oppure <a href="../signIn/signIn.php">Registrati</a> per continuare</p></div>');
    } else {
        include "../general/header.php";
        include "../general/phpFunction.php";
        include "filtri.html";
        if (!empty($_POST)) {
            $tipoFiltro = $_POST['selectFiltro'];
            $valoreFiltro = $_POST[$tipoFiltro];
            $giochi = stampaAnteprimaGiochiFiltrati($valoreFiltro, $tipoFiltro);
        } else {
            $giochi2 = stampaAnteprimaGiochi("true");
            $giochi3 = stampaAnteprimaGiochi("false");
            $giochi = $giochi2 + $giochi3;
        }
        ksort($giochi);
    ?>
        <div class="homepageContent">
            <div class="homepageContentSfocatura"></div>
            <?php
            foreach ($giochi as $title => $image) {
                echo ('<div class = game>' .
                    '<a class="tGameLink"   href="../game/game.php? title=' . "$title" . '"> <h3 class="tGame">' . $title . '</h3> ' . '</br>' .
                    '<img class="iGame" src="../images/' . $image . '" alt=""' . '/> </a>' .
                    '</div>');
            }
            ?>
            <div class="clear"></div>
        </div>
    <?php
        include "../general/footer.html";
    }
    ?>

</body>

</html>