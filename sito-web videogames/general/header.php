<div id="header">
    
    <?php
    if (empty($_SESSION["username"])) {
        echo ('<a href="../homepage/homepage.php"> <img id="logo" src="../images/header.jpg" alt=""> </a>
            <ul id="account">
            <li><a class="button" href="../general/login.php"> Login</a></li> 
            <li><a class="button" href="../signIn/signIn.php"> Signin </a> </li>
            </ul>');
    } else {
        $username = $_SESSION["username"];
        echo ('<a href="../homepageWithLogin/homepageWL.php"> <img id="logo" src="../images/header.jpg" alt=""> </a>
        <p id="headerLogged"> Benvenuto <span id="username">' . $username . '</span> !
        <a class="button" id="headerLogout" href="../general/logout.php"> Logout </a> </p>
        <a class="button" id="returnHome" href="../homepageWithLogin/homepageWL.php"> Homepage </a> ');
    }
    ?>

</div>