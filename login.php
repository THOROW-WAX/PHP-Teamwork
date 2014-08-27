<?php
session_start();
include "functions.php";

if (isset($_POST['login']) &&
    isset($_POST['pass'])) {
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    if (strlen($login)>3 && strlen($pass) > 5) {
        db_init();
        $sql = mysql_query('SELECT * FROM users WHERE login="'.addslashes($login).'" AND pass="'.md5($pass).'"');
        if (mysql_num_rows($sql) == 1) {
            $row = mysql_fetch_assoc($sql);
            if ($row['active']==1) {
                $_SESSION['isLogged']=true;
                $_SESSION['userInfo'] = $row;
                header("Location: index.php");
            } else {
                echo "<h1>Access denied</h1>";
            }


        } elseif (mysql_num_rows($sql) == 0) {
            // pass or username is incorrect
            echo "<h1>Password or Username is incorrect</h1>";
        } else {
            //some error
        }


    }

}
myHeader("Login");
?>
    <div id=wrapper">
        <section>
            <div class="image">
                <img src="img/house.jpg" />
            </div>
            <div id="form1">
                <form action="" method="post">
                    <header>
                        <h2>LOGIN</h2>
                    </header>
                    <input type="text" id="login" name="login" value="" placeholder="username" required/><br />
                    <input type="password" id="pass" name="pass" value="" placeholder="password" required/><br />
                    <button type="submit">Login</button>
                </form>
            </div>
<!--<form action="" method="post">-->
<!--    <label for="login">Login</label>-->
<!--    <input id="login" type="text" name="login"/>-->
<!--    <label for="pass">Password</label>-->
<!--    <input id="pass" type="password" name="pass"/>-->
<!--    <input type="submit" value="Login"/>-->
<!--</form>-->
<?php
footer();