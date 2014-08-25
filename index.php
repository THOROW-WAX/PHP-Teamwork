<?php
session_start();
include "functions.php";
myHeader("Index");
db_init();
$result = run_query('SELECT categories_id, name, description FROM categories WHERE status = 1');
echo $result;
while ($rows = mysql_fetch_assoc($result)) {
    $categories[] = $rows;
}

foreach ($categories as $value) { ?>
    <div class="categories">
        <a href="topics.php?id=<?php echo $value['categories_id'] ?>">
            <?php
            echo $value['name']. "\n" . $value['description'];
            ?>
        </a>
    </div>
    <?php
}

?>
<h1>Index</h1>
<?php
footer();