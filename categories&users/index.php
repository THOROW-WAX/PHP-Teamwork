<?php
session_start();
include_once 'functions.php';
myHeader("Beginning");
db_init();
$rs=run_q('SELECT name,group_cat_id FROM group_cat WHERE active=1');
while($row=mysql_fetch_assoc($rs))
{
    $groups[]=$row;
}
foreach($groups as $v)
{
  $rs=run_q('SELECT name,cat_id,desc FROM cat WHERE active=1 AND
  group_cat_id='.$v['group_cat_id']);
    echo '<div class="group_cat"><p>'.$v['name'].'</p>';

    while($row=mysql_fetch_assoc($rs))
    {
      echo'<div class="cat"><a href="topic.php?id='.$row['cat_id'].'">'.$row['name'].'</a><p>'.$row['desc'].'</p></div>';
    }
echo '</div>';
}

footer();
