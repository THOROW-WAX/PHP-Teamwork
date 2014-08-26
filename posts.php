<?php
session_start();
include_once 'functions.php';
db_init();
$id = intval($_GET['id']);

if ($id > 0) {
    $result = run_query('SELECT * FROM topics WHERE topic_id='. $id .'');
    $rows = mysql_fetch_assoc($result);
    $title = $rows['title'];
    myHeader($title);
    $result = run_query('SELECT * FROM posts WHERE topic_id='. $id .' ORDER BY date_added ASC');

    while ($rows = mysql_fetch_assoc($result)) {
        $posts[] = $rows;
    }
    ?>
    <h1><?php echo $title; ?></h1>
    <?php
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
        if (isset($_SESSION['isLogged']) && $value['added_by'] == $_SESSION['userInfo']['login']) { ?>
            <a href="new_post.php?id=<?php echo $id;?>&post=<?php echo $value['post_id']?>">Редактирай</a>
        <?php
        }
    }

    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true) { ?>
        <hr/>
        <div>
            <a href="new_post.php?id=<?php echo $id; ?>=" >
                Добави отговор
            </a>
        </div>

    <?php
    }

}else {
    header('Location: index.php');
    exit;
}