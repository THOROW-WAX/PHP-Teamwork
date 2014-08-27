<?php
function myHeader($title)
{
    //header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title><?=$title?></title>
        <link rel="stylesheet" href="styles/forum.css">
    </head>
    <body>
    <header>
        <div>
            <img src="img/header.jpg" />
            <h1>The Forum of "Fakulteto-Uni"</h1>
            <nav>
                <?php
                if (isset($_SESSION["isLogged"]) && $_SESSION["isLogged"]===true){ ?>

                    <h3><?php echo  'Hello Dear '.$_SESSION['userInfo']['real_name'];?></h3>
                        <?php
                    echo '<br/>';
                    echo '<a href="logout.php">Logout</a>';
                    echo '<a href="myProfile.php">My Profile</a>';
                    if ($_SESSION['userInfo']['status']==2) {
//admin options
                        echo '<a href="admin/index.php">AdminPanel</a>';
                    }
                } else {
                    ?>
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                <?php
                }
                ?>
                <a href="about.php">About</a>
                <a href="users.php?page=1">Users</a>
                <a href="index.php">Index</a>
            </nav>
        </div>
    </header>
<?php
}

function db_init()
{
    mysql_connect('localhost', 'root') or die ("Error with DB");
    mysql_select_db('forum');
}

function run_query($query)
{
    mysql_query("SET NAMES utf8");
    return mysql_query($query);
}

function footer()
{
    ?>
    <footer>
        <p>© 2014 by Team "THOROW-WAX". All Rights Reserved.</p>
    </footer>
    </body>
    </html>
<?php

}

function tagMatching($tags)
{
    $check = addslashes(strtolower($tags));
    db_init();
    $sql = "SELECT `title` FROM `tags` WHERE `title` LIKE '" . $check . "'";
    if ((mysql_fetch_assoc(mysql_query($sql)))) {
        $sql = mysql_query("SELECT count FROM tags WHERE title='" . $check . "'");
        $counter = implode(' ', mysql_fetch_array($sql, MYSQL_ASSOC));
        $counter = intval($counter);
        $counter++;
        $update = run_query("UPDATE tags SET count='" . $counter . "' WHERE title='" . $check . "'");
        $tagidQuery = mysql_query("SELECT tag_id FROM tags WHERE title='" . $check . "'");
        $tagId = implode(' ', mysql_fetch_array($tagidQuery, MYSQL_ASSOC));
        $tagId = intval($tagId);
        $postId = $_SESSION['currentId'];
        //var_dump($postId);
        $update = run_query("INSERT INTO title_tags (topic_id, tag_id) VALUES ('$postId', '".$tagId."') ");


    } else {
        $insert = run_query("INSERT INTO tags (tag_id, title, count) VALUES (NULL, '" . $check . "' ,'0')");
        $tagidQuery = mysql_query("SELECT tag_id FROM tags WHERE title='" . $check . "'");
        $tagId = implode(' ', mysql_fetch_array($tagidQuery, MYSQL_ASSOC));
        $tagId = intval($tagId);
        $postId = $_SESSION['currentId'];
        //var_dump($postId);
        $update = run_query("INSERT INTO title_tags (topic_id, tag_id) VALUES ('$postId', '".$tagId."') ");
    }

}
