<?php
session_start();
include "functions.php";
myHeader("Index");
var_dump($_FILES['photo']);
if (!($_SESSION["isLogged"]===true)) {

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
            echo "yes";
        }

    }


?>
<form action="<?php $_PHP_SELF?>" method="post" enctype="multipart/form-data">
    <label for="login">Login</label>
    <input id="login" type="text" name="login"/>
    <?php
    if($regErrors['login']) {
        echo '<span style="color:red">Not valid login</span>';
    }
    ?>
    <br/>
    <label for="pass">Password</label>
    <input id="pass2" type="password" name="pass"/>
    <?php
    if(($regErrors['pass']) || $regErrors['passNotMatch']) {
        echo '<span style="color:red">Not valid password or password does\'t match</span>';
    }
    ?>
    <br/>
    <label for="pass2">Re-type Password</label>
    <input id="pass" type="password" name="pass2"/>
    <br/>
    <label for="email">Email</label>
    <input id="email" type="email" name="email"/>
    <?php
    if($regErrors['email']) {
        echo '<span style="color:red">Not valid email</span>';
    }
    ?>
    <br/>
    <label for="name">Name</label>
    <input id="name" type="text" name="name"/>
    <?php
    if($regErrors['name']) {
        echo '<span style="color:red">Not valid name</span>';
    }
    ?>
    <br/>
    <label for="avatar">Photo</label>
    <input type="file" name="photo" id="avatar"/>

    <br/>
    <input type="submit" value="Register"/>
</form>
<?php
} else {
    header("Location: index.php");
    exit;
}

footer();
