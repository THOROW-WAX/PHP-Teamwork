<?php 
/////////////////////////// HEADER START //////////////////////////////////////////////

include 'admin_functions.php';


function admin_header($title){
 
    
?>

<!DOCTYPE  html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title?></title>
</head>
    <body>
        <div id="main_menu">
            <a href="index.php">AdminPanel</a>| <a href="groups_cat.php">Groups</a> | <a href="users.php">Users</a> | <a href="../index.php">Begining</a> | <a href="../logout.php">Log out</a>
        </div>
<?php
}
///////////////////////// HEADER END///////////////////////////////////////////////////
?><?php
///////////temp footer////////////////////////////////////////////
function adminfooter(){
    echo '</body></html>';
}
?>
