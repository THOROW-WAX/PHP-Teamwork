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

    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true) { ?>
        <a href="new_post.php?id=<?php echo $id; ?>" >
            Добави отговор
        </a>
    <?php
    }

}else {
    header('Location: index.php');
    exit;
}