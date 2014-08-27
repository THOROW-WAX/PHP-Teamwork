<?php
session_start();

include 'admin_header_footer.php';
echo isLoggedAdmin($_SESSION['isLogged'], $_SESSION['userInfo']['status']);
admin_header('Editing groups/cats/posts'); 

echo "<h1>EDIT CATEGORIES TOPICS AND POSTS</h1>";

db_init();
//SWICH FOR CATEGORIES
switch ((isset($_POST['submit'])? $_POST['submit'] : '')) {
    case 'Create Cat': category_create(); break;
    case 'Submit Cat': category_edit(); break;
    case 'Delete Cat': category_remove(); break;
    case 'Create Topic': topic_add(); break;
    case 'Submit Topic': topic_edit(); break;
    case 'Delete Topic': topic_remove(); break;
    
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
        $ls_topics = null;
        form_topics($ls_topics);
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

                    if((isset($_GET['mode']) && $_GET['mode'] == 'edit') && 
                       (isset($_GET['table']) && $_GET['table'] == 'topics') &&
                       (isset($_GET['id']) && $_GET['id'] == $ls_topics['topic_id']) ){
                        form_topics($ls_topics);
                    }
                    echo "</li>";
                }
            }
        echo "</ul>";
    
    echo "</li>";
}
echo "</ul>";
adminfooter();
?>