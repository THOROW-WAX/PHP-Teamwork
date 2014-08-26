<?php
session_start();
include_once 'functions.php';
db_init();
$id = intval($_GET['id']);

if ($id > 0) {
    $result = run_query('SELECT * FROM posts WHERE topic_id='. $id .'');

    while ($rows = mysql_fetch_assoc($result)) {
        $posts[] = $rows;
    }

    foreach ($posts as $value) { ?>
        <div class="posts">
            <p>
                <?php echo $value['content'];?>
            </p>
        </div>
    <?php
    }

    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true) {
        $errors = array();
        $content = '';

        if (isset($_POST['content']) && $_POST['new_post'] == 1) {
            $content = mysql_real_escape_string(trim($_POST['content']));
        }

        if ($content != '') {
            if (count($errors) == 0) {                
                run_query('INSERT INTO posts (topic_id, added_by, content) VALUES ('.$id.', "'.$_SESSION['userInfo']['login'].'", "'.htmlspecialchars($content).'")');
                header('Location: posts.php?id='.$id.'');
                exit;
            }

            if ( strlen($content) < 4) {
                $errors['content'] = 'Съдържанието на вашия пост е твърде кратко! Опитайте отново.';
            }
        }
        ?>
        <form action="new_post.php?id=<?php echo $id; ?>" method="post">
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
            <br/>
            
            <button type="submit">Изпрати</button>
            <input type="hidden" name="new_post" value="1"/>
        </form>
    <?php
    }else {
        header('Location: index.php');
        exit;
    }

}else {
    header('Location: index.php');
    exit;
}