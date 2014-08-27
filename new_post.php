<?php
session_start();
include_once 'functions.php';
db_init();
$id = intval($_GET['id']);

myHeader('Нов пост');

if (isset($_GET['post'])) {
    $post = intval($_GET['post']);
}

if ($id > 0) {
    $result = run_query('SELECT * FROM posts WHERE topic_id='. $id .'');

    while ($rows = mysql_fetch_assoc($result)) {
        $posts[] = $rows;
        if (isset($post) && $rows['post_id'] == $post) {
            $text = $rows['content'];
        }
    }

    /*<?php $query = run_query('SELECT content FROM posts WHERE post_id='. $post.'');$text = mysql_fetch_assoc($query);echo $text['content'];?>*/

    foreach ($posts as $value) { ?>
        <div class="posts">
            <p>
                <?php echo $value['content'];?>
            </p>
            <hr/>
        </div>
        <div class="info">
            <span>Добавен на: <?php echo date('Y-m-d H:i:s', $value['date_added']);?></span>
            <span>Oт: <?php echo $value['added_by'];?></span>
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
                $currentId = mysql_query("SELECT MAX(topic_id) AS currentID FROM topics");
                $currentId=intval($currentId)+1;
                $_SESSION['currentId']= $currentId;

                if (isset($post) && $post > 0) {
                    run_query('UPDATE posts SET content="'.htmlspecialchars($content).'", edited_by="'.$_SESSION['userInfo']['login'].'", edited_when='.time().' WHERE post_id='.$post.'');
                    header('Location: posts.php?id='.$id.'');
                    exit;
                }else {
                    run_query('INSERT INTO posts (topic_id, added_by, date_added, content) VALUES ('.$id.', "'.$_SESSION['userInfo']['login'].'", '.time().', "'.htmlspecialchars($content).'")');
                    header('Location: posts.php?id='.$id.'');
                    exit;
                }
            }

            if ( strlen($content) < 4) {
                $errors['content'] = 'Съдържанието на вашия пост е твърде кратко! Опитайте отново.';
            }
        }


        if (isset($post) && $post > 0) { ?>
            <form action="new_post.php?id=<?php echo $id; ?>&post=<?php echo $post;?>" method="post">
                <textarea name="content" id="content" cols="30" rows="10"><?php echo $text; ?></textarea>
                <br/>
                <button type="submit">Изпрати</button>
                <input type="hidden" name="new_post" value="1"/>
            </form>
            <?php
        }else {
            ?>
            <form action="new_post.php?id=<?php echo $id; ?>" method="post">
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
                <br/>
                <button type="submit">Изпрати</button>
                <input type="hidden" name="new_post" value="1"/>
            </form>
        <?php
        }
    }else {
        header('Location: index.php');
        exit;
    }

}else {
    header('Location: index.php');
    exit;
}