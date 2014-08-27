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
            <br/>
            <?php
            echo $value['name']. "<br/>" . $value['description'];
            ?>
        </a>
        <hr/>
    </div>
<?php
}

?>
    <div id="index">
<h3>Търсене по тагове</h3>
<form action="tags_search.php" method="get">
        <input type="search" name="search" id="search" placeholder="search"/>
    <br/>
        <input type="submit" name="searchSubmit" value="Search"/>
</form>
        </div>
<?php
footer();