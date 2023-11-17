<?php
session_start();
$title=$_SESSION["title"];
if(!empty($_POST)){
include "../general/phpFunction.php";
$username = $_SESSION["username"];
$commento = $_POST['commento'];
inserisciCommento($title, $username, $commento);
}
header("location: game.php? title=".$title);
