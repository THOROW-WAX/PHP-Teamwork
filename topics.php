<?php
session_start();
include_once 'functions.php';
db_init();
$id = intval($_GET['id']);

//Check if the id is correct
if ($id > 0) {
    $result = run_query('SELECT name, status FROM categories WHERE categories_id =' . $id . ' AND status = 1');

    if (mysql_num_rows($result) == 1) {

        $rows = mysql_fetch_assoc($result);
        myHeader($rows['name']);

        if ($_SESSION['isLogged'] === true): ?>
            <div>
                <a href="new_post.php?id=<?php echo $id; ?>">Създай нова тема</a>
            </div>
       <?php endif;

        footer();
    } else {
        //echo "Възникна грешка при извикването на темата! Моля опитайте отново.";
        header('Location: index.php');
        exit;
    }

} else {
    header('Location: index.php');
    exit;
}
