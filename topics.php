<?php
session_start();
include_once 'functions.php';
db_init();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
//Check if the id is correct
if (isset($id) && $id > 0) {
    $result = run_query('SELECT name, status FROM categories WHERE categories_id =' . $id . ' AND status = 1');

    if (mysql_num_rows($result) == 1) {

        $rows = mysql_fetch_assoc($result);
        myHeader($rows['name']);

        if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true): ?>
            <div>
                <a href="new_topic.php?id=<?php echo $id; ?>">Създай нова тема</a>
            </div>
       <?php endif;

        $result = run_query('SELECT * FROM topics WHERE categories_id=' . $id . ' AND status=1 ORDER BY date_added DESC');

        while ($rows = mysql_fetch_assoc($result)) {
            $topics[] = $rows;
        }
        ?>
        <br/>
        <?php

        /*if (!empty($topics)) {
            foreach ($topics as $value) { */?><!--
                <div class="topics">
                    <a href="posts.php?id=<?php /*echo $value['topic_id']; */?>">
                        <?php /*echo $value['title']; */?>
                    </a>
                </div>
            --><?php
/*            }
        }*/
        $page = $_GET['page'];
        $limitStart = ($page - 1) * 10;
        $limitEnd = $page * 10;
        $dbResult = run_query("SELECT * FROM `topics` WHERE categories_id=" . $id . " ORDER BY date_added DESC LIMIT {$limitStart}, $limitEnd");
        //var_dump($dbResult);
        echo  mysql_num_rows($dbResult);
        while ($row = mysql_fetch_assoc($dbResult)) {
            var_dump($row);
            ?>
            <div class="topics">
                <a href="posts.php?page=<?=$page?>&id=<?php echo $row["topic_id"]; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </div>
        <?php
        }
        footer();
    }else {
        //echo "Възникна грешка при извикването на темата! Моля опитайте отново.";
        header('Location: index.php');
        exit;
    }

}else {
    header('Location: index.php');
    exit;
}
?>
<ul>
    <li><a href="topics.php?page=1&id=<?php echo $id ?>">1</a></li>
    <li><a href="topics.php?page=2&id=<?php echo $id ?>">2</a></li>
    <li><a href="topics.php?page=3&id=<?php echo $id ?>">3</a></li>
    <li><a href="topics.php?page=4&id=<?php echo $id ?>">4</a></li>
    <li><a href="topics.php?page=5&id=<?php echo $id ?>">5</a></li>
</ul>
