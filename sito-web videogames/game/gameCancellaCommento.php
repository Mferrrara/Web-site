<?php
session_start();
include "../general/phpFunction.php";
$title=$_GET['title'];
$username = $_GET['username'];
eliminaCommento($title, $username);
header("location: game.php? title=".$title);
?>