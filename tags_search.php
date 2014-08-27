<?php
session_start();
include "functions.php";
myHeader("Index");
db_init();
if(isset($_GET['search']) && $_GET['search']!= null){
    $search = addslashes(strtolower($_GET['search']));
    $tagCheck = mysql_fetch_assoc(run_query("SELECT tag_id FROM tags WHERE title LIKE '$search'"));
    if($tagCheck==null){
        echo "There is no result. Try again!".'<br>';
        echo'<a href="index.php"><p>To main page</p></a>';
        exit;
    }
    $tagCheck = intval($tagCheck['tag_id']);

    $sql =run_query("SELECT * FROM title_tags WHERE tag_id='$tagCheck'");


    while($rows = mysql_fetch_assoc($sql)){
     $topicsId[] = $rows;
    }
    for ($i = 0; $i < count($topicsId); $i++) {
      $arr[]=$topicsId[$i]['topic_id'];
    }
    sort($arr);
    for ($i = 0; $i < count($arr); $i++) {
      if($arr[$i]!=$arr[$i+1]){
          $arrResult[]=intval($arr[$i]);
      }else{
          continue;
      }
    }
    for ($i = 0; $i < count($arrResult); $i++) {
      $titlePrint = mysql_fetch_assoc(run_query("SELECT title FROM topics WHERE topic_id LIKE '$arrResult[$i]'"));
      echo '<a href="posts.php?id='.$arrResult[$i].'">'.$titlePrint['title'].'</a><br>';

    }

}else{

   header('Location: index.php');
}
?>
<?php

?>
<aside id="mostPopular">
<h3>Most Popular Tags</h3>
    <?php
    $countID = run_query("SELECT tag_id FROM tags ORDER BY count DESC");
    $countarr= array();
    $i = 0;
    while($rows = mysql_fetch_assoc($countID)){
        if($i == 10){
            break;
        }
        $countarr[] = $rows;
        $i++;
    }
    $countResult= array();
    for ($i = 0; $i < count($countarr); $i++) {
        $countResult[$i] = intval($countarr[$i]['tag_id']);
    }
//    var_dump($countResult);
    $tagTitle= array();
    for ($j = 0; $j < count($countResult); $j++) {
        $tagTemp = mysql_fetch_assoc(run_query("SELECT title FROM tags WHERE tag_id LIKE '$countResult[$j]'"));
        $tagTitle[] = $tagTemp['title'];
    }
    //var_dump($tagTitle);

    ?>
    <ul>
        <?php
        for ($i = 0; $i < count($tagTitle); $i++) {
            echo "<li><a href='tags_search.php?search=$tagTitle[$i]&searchSubmit=Search'>$tagTitle[$i]</a></li>";
        }
        ?>
    </ul>
</aside>
<?php

?>