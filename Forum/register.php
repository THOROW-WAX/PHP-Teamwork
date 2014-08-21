<?php
include 'function.php';
if(!$_SESSION['is_logged']==true)
{
    if($_POST['form_submit']==1)
    {
        //trim removes spaces, addslashes secure the information
        $login=trim($_POST['login']);
        $pass=trim($_POST['pass']);
        $pass2=trim($_POST['pass2']);
        $email=trim($_POST['mail']);
        $name=trim($_POST['name']);

        if(strlen($login)<4)
        {
            $error_array['login']='Невалидно име';
        }
        if(strlen($pass)<4)
        {
            $error_array['pass']='Кратка парола';
        }
        if($pass!=$pass2)
        {
           $error_array['pass']='Паролите не отговарят';
        }
        //!deprecated
        if(!eregi("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", $email))
        {
            $error_array['mail']='Невалиден адрес';
        }
        //!deprecated
        if(!ereg("^[a-zA-Z]{3,16}$",$name))
        {
            $error_array['name']='Невалидно име';
        }
        //!check if there is a mistake in the filled information and if there isn't check the database
        if(!count($error_array)>0)
        {
            db_init();
            //!sending the request with sql
            $sql='SELECT COUNT(*)as cnt FROM users WHERE login="'.addslashes($login).
                '" OR email="'.addslashes($email).'"';
            //!creating resource
            $res=mysql_query($sql);
            //!the resource is transformed in an array
            $row=mysql_fetch_assoc($res);
            if($row['cnt']==0)
            {
                //!inserting the information in the data base
                mysql_query('INSERT INTO users(login,pass,real_name,email,date_reg)
                VALUES("'.addslashes($login).'","'.md5($pass).'","'.addslashes($name).'","'.addslashes($email)
                    .'","'.time().')');
                if(mysql_error())
                {
                    $error_array['sql']='<h1>Грешка.Моля опитайте отново!</h1>';
                }
                else
                {
                    header('Location: index.php');
                    exit;
                }
            }
            else
            {
                $error_array['login']='Името или адреса са заети';
                $error_array['mail']='Името или адреса са заети';
            }
        }
    }
    myHeader('Регистрация');
    if($error_array['sql'])
    {
        echo $error_array['sql'];
    }
    ?>
    <form action="register.php" method="POST">
        Login:<label><input type="text" name="login" value=""/></label><?php
        if($error_array['login']){
            echo $error_array['login'];}?>
        <br>
        Парола:<label><input type="text" name="pass" value=""/></label><?php
        if($error_array['pass']){
            echo $error_array['pass'];}?>
        <br>
        Повтори парола:<label><input type="text" name="pass2" value=""/></label><br>
        Email:<label><input type="text" name="mail" value=""/></label><?php
        if($error_array['mail']){
        echo $error_array['mail'];}?>
        <br>
        Име:<label><input type="text" name="name" value=""/></label><?php
        if($error_array['name']){
        echo $error_array['name'];}?>
        <br>
        <input type="hidden" name="form_submit" value="1">
        <input type="submit" name="Регистрирай се" value="Регистрирай се"/><br>
    </form>
    <?php
    footer();
}
else
{
    header('Location: index.php');
    exit;
}