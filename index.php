<?php
session_start();
include "functions.php";
myHeader("Index");
db_init();
$result = run_query('SELECT categories_id, name, description FROM categories WHERE status = 1');

while ($rows = mysql_fetch_assoc($result)) {
    $categories[] = $rows;
}

foreach ($categories as $value) { ?>
    <div class="categories">
        <a href="topics.php?page=1&id=<?php echo $value['categories_id'] ?>">
            <?php
            echo $value['name']. "\n" . $value['description'];
            ?>
        </a>
    </div>
<?php
}

?>
<h1>Index</h1>
<form action="tags_search.php" method="post">
        <input type="search" name="search" id="search" placeholder="search"/>
        <input type="submit" name="searchSubmit" value="Search"/>
</form>
<?php
footer();