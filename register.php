<!DOCTYPE html>
<html>

<head>
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="css/forum.css">
</head>

<body>

<?php

include "functions.php";
if (!(isset($_SESSION["isLogged"]) && !$_SESSION["isLogged"]===true)) {
if(
    isset($_POST['login']) &&
    isset($_POST['pass']) &&
    isset($_POST['pass2']) &&
    isset($_POST['email']) &&
    isset($_POST['name'])
) {
    $login = addslashes(trim($_POST['login']));
    $pass = trim($_POST['pass']);
    $pass2 = trim($_POST['pass2']);
    $email = addslashes(trim($_POST['email']));
    $name = addslashes(trim($_POST['name']));

    //validation
    if (!preg_match('/^[A-Za-z]{1}[A-Za-z0-9_]{5,31}$/', $login)) {
        $regErrors['login'] = true;
    }
    if (strlen($pass)<6) {
        $regErrors['pass'] = true;
    }
    if ($pass!== $pass2) {
        $regErrors['passNotMatch'] = true;
    }
    if (!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $email)) {
        $regErrors['email'] = true;
    }
    if (!preg_match('/^(([A-Za-zа-яА-Я]{2,20})[ ]{0,1}){1,3}$/', $name)) {
        $regErrors['name'] = true;
    }
    if($_FILES['photo']['type'] == 'image/png' && $_FILES['photo']['size'] > 0) {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/01.png');
        //echo "yes";
    }
    if (count($regErrors)<1) {
        db_init();
        $sql = 'SELECT count(*) as cnt FROM users WHERE login="'.$login.'" OR email="'.$email.'"';
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result);
        if ($row['cnt'] == 0 ) {
            mysql_query('INSERT INTO users (login, pass, real_name, email, date_reg)
                VALUES ("'.$login.'", "'.md5($pass).'", "'.$name.'", "'.$email.'", '.time().')');
            if (mysql_error()) {
                echo "<h1>Error!!</h1>";
            } else {
                $_SESSION['isLogged']=true;
                header("Location: index.php");
            }
        } else {
            $regErrors['email'] = true;
            $regErrors['login'] = true;
        }
    }
}
myHeader('Register');
?>
<div id=wrapper">
    <section>
        <div class="image">
            <img src="img/house.jpg" />
        </div>
        <div id="form">
            <header>
                <h2>REGISTER</h2>
            </header>
            <form action="<?php $_PHP_SELF?>" method="post" enctype="multipart/form-data">
                <input type="text" name="login" value="" placeholder="username" required/><br />
                <?php
                if(isset($regErrors['login']) && $regErrors['login']) {
                    echo '<span style="color:red">Username or Email is not Valid</span>';
                }
                ?>
                <br/>
                <input type="password" name="pass" value="" placeholder="password" required/><br />
                <?php
                if(isset($regErrors['pass']) && (($regErrors['pass']) || $regErrors['passNotMatch'])) {
                    echo '<span style="color:red">Not valid password or password does\'t match</span>';
                }
                ?>
                <br/>
                <input type="password" name="pass2" value="" placeholder="re-type password" required/><br />
                <input type="text" name="email" value="" placeholder="email" required/><br />
                <?php
                if(isset($regErrors['email']) && $regErrors['email']) {
                    echo '<span style="color:red">Username or Email is not Valid</span>';
                }
                ?>
                <br/>
                <input type="text" name="name" value="" placeholder="name" required/><br />
                <?php
                if(isset($regErrors['name']) && $regErrors['name']) {
                    echo '<span style="color:red">Not valid name</span>';
                }
                ?>
                <br/>
                <input type="file" name="photo" value="Choose file" id="avatar"/>
                <button>Register</button>
            </form>
        </div>
    </section>
</div>
<?php

} else {
    header("Location: index.php");
    exit;
}

footer();
