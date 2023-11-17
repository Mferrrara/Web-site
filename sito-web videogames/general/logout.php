<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>

<body>
    <?php
    include "../general/phpFunction.php";
    destroySessionAndData();
    header("location: ../homepage/homepage.php");
    ?>
</body>

</html>