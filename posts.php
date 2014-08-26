<?php
session_start();
include_once 'functions.php';
db_init();
$id = intval($_GET['id']);

if ($id > 0) {
    $result = run_query('SELECT * FROM topics WHERE topic_id='. $id .'');
    $rows = mysql_fetch_assoc($result);
    $title = $rows['title'];
    $counter = $rows['counter'] + 1;
    run_query('UPDATE topics SET counter='.$counter.' WHERE topic_id='.$id.'');
    myHeader($title);
    $result = run_query('SELECT * FROM posts WHERE topic_id='. $id .' ORDER BY date_added ASC');

    while ($rows = mysql_fetch_assoc($result)) {
        $posts[] = $rows;
    }
    ?>
    <h1><?php echo $title; ?></h1>
    <span>Брой прегледи: <?php echo $counter;?></span>
    <hr/>
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
            <?php
                if ($value['edited_by'] != null) { ?>
                    <span>Редактиран на: <?php echo date('Y-m-d H:i:s', $value['edited_when']);?></span>
                <?php
                }
            ?>
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