<?php
session_start();
include_once 'functions.php';
db_init();
$id = intval($_GET['id']);

if ($id > 0) {
    $result = run_query('SELECT name, active FROM categories WHERE categories_id =' . $id . 'AND active = 1');

    if (mysql_num_rows($result) == 1) {

        $rows = mysql_fetch_assoc($result);
        myHeader($rows['name']);

        if ($_SESSION['is_logged'] === true): ?>
            <div>
                <a href="new_post.php?id=<?php $id ?>">Създай нова тема</a>
            </div>
       <?php endif;

        footer();
    } else {
        header('Location: index.php');
        echo "Възникна грешка при извикването на темата! Моля опитайте отново.";
        exit;
    }

} else {
    header('Location: index.php');
    exit;
}
