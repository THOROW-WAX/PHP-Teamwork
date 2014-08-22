<?php 

function isLoggedAdmin($isLogged, $isAdmin){
    if($_SESSION['is_logged'] === TRUE && $_SESSION['user_info']['type'] == 3){
        return "logged admin";
    }
    else{
        header('Location: ../index.php');
        exit;
    }
}
?>