<?php
function myHeader($title)
{
    session_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        <title><?php echo $title?></title>
    </head>
<body>
<div id="top_menu">
    <?php
    if($_SESSION['is_logged']===true)
    {

    }
    else
    {
        echo '<a href="register.php">Регистрирай се</a>';
    }
    ?>
</div>
<?php
}

function footer()
{
    echo '</body></html>';
}
//!connecting to database
function db_init()
{
    mysql_connect('localhost','plami', 'plamkata') or die("Грешка с базата данни!");
    mysql_select_db('forum1');
}