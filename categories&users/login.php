<?php
include 'functions.php';
session_start();
if($_POST['form_login']==1)
{
    $login = trim($_POST['login_name']);
    $pass = trim($_POST['login_pass']);
    if(strlen($login)>3 && strlen($pass)>3)
    {
        db_init();
        $rs=mysql_query('SELECT * FROM users WHERE login="'.addslashes($login).
        '"AND pass="',md5($pass).'"');
        if(mysql_num_rows($rs)==1)
        {
            $rows=mysql_fetch_assoc($rs);
            if($row['active']==1)
            {
            $_SESSION['is_logged']=true;
            $_SESSION['user_info']=$row;
            header('Location: index.php');
            exit;
            }
            else
            {
                echo '<h1>Достъпън ви е спрян</h1>';
            }
        }
        elseif(mysql_num_rows($rs)==0)
        {
            echo '<h1>Грешно име или парола</h1>';
        }
    }
}
myHeader("Вход");
?>
<form action="login.php" method="post">
    Име:<label><input type="text" name="login_name"></label><br />
    Парола:<label><input type="text" name="login_pass"></label><br />
    <input type="submit" value="Влез"><br />
    <input type="hidden" name="form_login" value="1">
</form>
<!php
footer()