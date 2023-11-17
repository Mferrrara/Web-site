<!DOCTYPE html>
<html>

<head lang="it">
    <title>My Videogames</title>
    <link rel="icon" href="../images/arcade.png" type="image/png" />
    <meta charset="utf-8" />
    <meta name="author" content="Luca Gerbasi e Mario Ferrara" />
    <meta name="keywords" content="games, giochi, recensioni, best giochi, community giochi, giochi pc, giochi xbox, giochi playstation" />
    <meta name="description" content="Questo &egrave; un sito per scrivere o consultare recensioni di videogames " />
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/headerStyle.css">
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/homepageStyle.css">
    <link rel="stylesheet" type="text/css" href="../fogliDiStile/footerStyle.css">

</head>

<body>
    <?php
    include "../general/phpFunction.php";
    include "../general/header.php";
    ?>

    <div class="homepageContent">
        <div class="homepageContentSfocatura"></div>
        <?php
        $giochi = stampaAnteprimaGiochi("true");
        foreach ($giochi as $title => $image) {
            echo ('<div class=game>' .
                '<h3 class="tGame">' . $title . '</h3>' .
                '<img class="iGame" src="../images/' . $image . '" alt=""' . ' />' .
                '</div>');
        }
        ?>
        <div class="clear"></div>
    </div>
    <?php
    include "../general/footer.html";
    ?>
</body>

</html>