<?php
function myHeader ($title) {
    header('Content-Type: text/html; charset=utf-8');
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
            if (isset($_SESSION["isLogged"]) && $_SESSION["isLogged"]===true){
                echo 'Hello Dear '.$_SESSION['userInfo']['real_name'];
                echo '<a href="logout.php">Logout</a>';
                if ($_SESSION['userInfo']['status']==2) {
                    //admin options
                    echo '<a href="admin/index.php">AdminPanel</a>';
                }
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
function db_init() {
    mysql_connect('localhost', 'root') or die ("Error with DB");
    mysql_select_db('forum');
}
    function footer () {
        ?>
</body>
</html>
<?php
    }
