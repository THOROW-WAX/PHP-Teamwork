<?php

function myHeader ($title) {
    ?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <?php
            if ($_SESSION['isLogged']===true){

            } else {
                ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php
            }
            ?>
            <li><a href="about.php">About</a></li>
        </ul>
    </nav>
</header>
<?php
}
    function footer () {
        ?>
</body>
</html>
<?php
    }
    ?>
