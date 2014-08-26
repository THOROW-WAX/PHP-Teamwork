<?php
session_start();

include 'admin_header_footer.php';
admin_header('Editing groups/cats/posts'); 

echo "<h1>EDIT CATEGORIES TOPICS AND POSTS</h1>";

db_init();
//SWICH FOR CATEGORIES
switch ((isset($_POST['submit'])? $_POST['submit'] : '')) {
    case 'Create': category_create(); break;
    case 'Submit': echo 'submit'; break;
    case 'Delete': category_remove(); break;
    default: break;
}
//For Empty Form
echo '<a href="groups_cat.php?mode=create&table=category"> Create Category (empty form)</a></br>';
echo '<a href="groups_cat.php?mode=create&table=topic"> Create Topic (empty form)</a></br>';
if(isset($_GET['mode']) && ($_GET['mode'] == 'create')){
    if(isset($_GET['table']) && $_GET['table'] == 'category'){
        $ls_cas = null ;    
        form_categories($ls_cas); 
    }
    if(isset($_GET['table']) && $_GET['table'] == 'topic'){
        form_topics();
    }    
} 








echo "<ul>";
echo "<li>Categories</li></br>";
$rs_cats = run_query('SELECT * FROM categories');
while ($ls_cats = mysql_fetch_assoc($rs_cats)) {
    echo "<li>";
    echo $ls_cats['name']." -- ".$ls_cats['description'] ;
    echo '<a href="groups_cat.php?mode=edit&table=categories&id='.$ls_cats['categories_id'].'">| Edit |</a>';
    if((isset($_GET['mode']) && $_GET['mode'] == 'edit') && 
       (isset($_GET['table']) && $_GET['table'] == 'categories') &&
       (isset($_GET['id']) && $_GET['id'] == $ls_cats['categories_id']) ){
        form_categories($ls_cats);
    }    
        echo "<ul>";
        echo "Topics:";
            $rs_topics = run_query('SELECT * FROM topics');
            while ($ls_topics = mysql_fetch_assoc($rs_topics)) {
                if($ls_topics['categories_id'] == $ls_cats['categories_id']){    
                    echo "<li>";    
                    echo $ls_topics['title']." -- ".$ls_topics['added_by'];         
                    echo '<a href="groups_cat.php?mode=edit&table=topics&id='.$ls_topics['topic_id'].'">| Edit |</a>';
                    echo '<a href="groups_cat.php?mode=edit&table=topics&id='.$ls_topics['topic_id'].'">| Edit Posts In Topic |</a>';
                    echo "</li>";
                }
            }
        echo "</ul>";
    
    echo "</li>";
}
echo "</ul>";
adminfooter();
?>