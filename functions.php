<?php
function myHeader($title)
{
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title><?=$title?></title>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
    </head>
    <body>
    <header>
        <nav>
            <ul>
                <?php
                if (isset($_SESSION["isLogged"]) && $_SESSION["isLogged"]===true){
                    echo 'Hello Dear '.$_SESSION['userInfo']['real_name'];
                    echo '<a href="logout.php">Logout</a>';
                    if ($_SESSION['userInfo']['status']==2) {
//admin options
                        echo '| <a href="admin/admin.php">AdminPanel</a> |';
                    }
                } else {
                    ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php
                }
                ?>
                <li><a href="about.php">About</a></li>
				<li><a href="users.php?page=1">Users</a></li>
            </ul>
        </nav>
    </header>
<?php
}

function db_init()
{
    mysql_connect('localhost', 'admin','123') or die ("Error with DB");
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
    </body>
    </html>
<?php

}

function tagMatching($tags)
{
    $check = addslashes($tags);
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
        var_dump($postId);
        $update = run_query("INSERT INTO title_tags (post_id, tag_id) VALUES ('$postId', '".$tagId."') ");


    } else {
        $insert = run_query("INSERT INTO tags (tag_id, title, count) VALUES (NULL, '" . $check . "' ,'0')");
        $tagidQuery = mysql_query("SELECT tag_id FROM tags WHERE title='" . $check . "'");
        $tagId = implode(' ', mysql_fetch_array($tagidQuery, MYSQL_ASSOC));
        $tagId = intval($tagId);
        $postId = $_SESSION['currentId'];
        var_dump($postId);
        $update = run_query("INSERT INTO title_tags (post_id, tag_id) VALUES ('$postId', '".$tagId."') ");
    }

}
