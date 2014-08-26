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

}else {
    header('Location: index.php');
    exit;
}