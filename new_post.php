<?php
session_start();
include_once 'functions.php';
db_init();

$id = $_GET['id'];
$result = run_query('SELECT categories_id FROM categories WHERE categories_id=' . $id . 'AND active=1');

if ($_SESSION['is_logged'] === true && mysql_num_rows($result) == 1) {
    $errors = new array();

    if ($_POST['new_post'] == 1) {
        $title = mysql_real_escape_string(trim($_POST['title']));
        $text = mysql_real_escape_string(trim(['text']));

        if (count($errors) == 0) {

        }

        if ( strlen($title) < 4 ) {
            $errors['title'] = 'Заглавието на темата е твърде кратко! Опитайте отново.';
        }

        if ( strlen($text) < 4) {
            $errors['text'] = 'Съдържанието на вашия пост е твърде кратко! Опитайте отново.';
        }

    }
    myHeader('Нова тема'); ?>
    <form action="new_post.php?id=<?php $id ?>" method="post">
        <label for="new_topic">Заглавие</label>
        <input type="text" id="title" name="new_topic"/>
        <br/>
        <?php
        if ($errors['title']) {
            echo $errors['title'];
        }
        ?>
        <p>Въведете вашия текст в по-лето по-долу.</p>
        <textarea name="text" id="text" cols="30" rows="10"></textarea>
        <?php
        if ($errors['text']) {
            echo $errors['text'];
        }
        ?>
        <br/>
        <button type="submit">Изпрати</button>
        <input type="hidden" name="new_post" value="1"/>
    </form>
<?php
} else {
    header('Нова тема');
    echo "Възникна грешка при извикването на темата! Моля опитайте отново.";
    exit;
}