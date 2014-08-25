<?php
session_start();
include_once 'functions.php';
db_init();
$id = $_GET['id'];
$result = run_query('SELECT categories_id FROM categories WHERE categories_id=' . $id . ' AND status=1');

if ($_SESSION['isLogged'] === true && mysql_num_rows($result) == 1) {
    $errors = array();

    if (isset($_POST['new_post']) && $_POST['new_post'] == 1) {

        $title = mysql_real_escape_string(trim($_POST['title']));
        $content = mysql_real_escape_string(trim($_POST['content']));

        if (count($errors) == 0) {
            run_query('INSERT INTO topics (categories_id, added_by, date_added, title) VALUES ('.$id.', "'.$_SESSION['userInfo']['login'].'", '.time().', "'.htmlspecialchars($title).'")');
            $topicID = mysql_insert_id();
            run_query('INSERT INTO posts (topic_id, added_by, date_added, content) VALUES ('.$topicID.', "'.$_SESSION['userInfo']['login'].'", '.time().', "'.htmlspecialchars($content).'")');
            header('Location: topics.php');
            exit;
        }

        if ( strlen($title) < 4 ) {
            $errors['title'] = 'Заглавието на темата е твърде кратко! Опитайте отново.';
        }

        if ( strlen($content) < 4) {
            $errors['content'] = 'Съдържанието на вашия пост е твърде кратко! Опитайте отново.';
        }

    }
    
    myHeader('Нова тема'); ?>
    <form action="new_post.php?id=<?php echo $id ?>" method="post">
        <label for="new_topic">Заглавие</label>
        <input type="text" id="title" name="title"/>
        <br/>
        <?php
        if (isset($errors['title'])) {
            echo $errors['title'];
        }
        ?>
        <p>Въведете вашия текст в по-лето по-долу.</p>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <?php
        if (isset($errors['content'])) {
            echo $errors['content'];
        }
        ?>
        <br/>
        <label for="tags">Тагове</label>
        <input type="text" id="tags" name="tags"/>
        <br/>
        <button type="submit">Изпрати</button>
        <input type="hidden" name="new_post" value="1"/>
    </form>
<?php
} else {
    header('Нова тема');
    //echo "Възникна грешка при извикването на темата! Моля опитайте отново.";
    exit;
}