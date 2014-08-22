<?php 
/////////////////////////// HEADER START //////////////////////////////////////////////
session_start();
include 'admin_functions.php';


function admin_header($title){
 
    echo isLoggedAdmin($_SESSION['is_logged'], $_SESSION['user_info']['type']);
?>

<!DOCTYPE  HTML>
<html>
<head>
    <title><?php echo $title?></title>
</head>
    <body>
        <div id="main_menu">
            <a href="admin.php">Beginning</a>| <a href="groups_cat.php">Groups</a> | <a href="users.php">Users</a> | <a href="../logout.php">Log out</a>
        </div>
<?php
}
///////////////////////// HEADER END///////////////////////////////////////////////////
?>    



<?php
///////////temp footer/////////////////////////////////////////////
function footer(){
    echo '</body></html>';
}
?>
