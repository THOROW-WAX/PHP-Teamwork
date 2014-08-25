<?php
session_start();

include 'admin_header_footer.php';
admin_header('Editing groups/cats/posts'); 

echo "<h1>EDIT GROUPS CATEGORIES AND POSTS</h1>";
echo "<h2>categorys: </h2><br>"; 

    
db_init();
//echo @mysql_ping() ? 'true' : 'false';

//  Add Edit function (on top for refreshin list after add/edit/remove)
if(isset($_POST['ng']) == 1){
    add_eddit_removePostsCats();
}



/////////////////////////////GET GROUPS POST CATEGORYS////////////////////////////////////////////////// 
echo "<ul>";
echo "<li>Categories:</li>";
$rs_cats = run_query('SELECT * FROM categories');
while ($cats = mysql_fetch_assoc($rs_cats)) {
    echo "<ul>";
    echo "<li>".$cats['name']."   "." --- " ;
    echo check_status($cats['status']);
    echo '<a href="groups_cat.php?mode=edit&table=categories&id='.$cats['categories_id'].'">| Edit |</a>';
        echo "<ul>";
        echo "<li>Topics:</li>"; 
            $rs_topic = run_query('SELECT * FROM topics');
            while ($topics = mysql_fetch_assoc($rs_topic)) {
                if($topics['categories_id'] == $cats['categories_id']){
                     echo "<li>".$topics['name']."   "." --- " ;
                     echo check_status($topics['status']);
                     echo '<a href="groups_cat.php?mode=edit&table=topics&id='.$topics['topic_id'].'">| Edit |</a>';
                        echo "<ul>";
                        echo"<li>Posts</li>";
                            $rs_posts = run_query('SELECT * FROM posts');
                            while ($post = mysql_fetch_assoc($rs_posts)) {
                                echo "<li>";
                                echo "Adderd By: ".$post['added_by']."   "." --- " ;
                                echo "Title: ".$post['title'];
                                echo '<a href="groups_cat.php?mode=edit&table=posts&id='.$post['post_id'].'">| Edit |</a>';
                            }
                        echo "</ul>";
                     echo "</li>";
                }
            }
        echo "</ul>";
    echo "</li>";
    echo "</ul>";
    }
        

echo "</ul>";
echo"</li>";
//////////////////////////////   END   get cat /////////////////////////////////////////////

///////////////////////////// Form Fill Query///////////////////////////////////////////////
if (isset($_GET['mode']) == "edit" && (isset($_GET['id']) > 0)) {
	$id = (int)$_GET['id'];
    $table = $_GET['table'];
    switch ($table) {
        case 'categories': $table_id = "categories_id"; break;
        case 'topics': $table_id = "topic_id"; break;
        case 'posts': $table_id = "post_id";
        default:"Error In table id "; break;
      
    }
    $query ='SELECT * FROM '.$table.' WHERE '.$table_id.'='.$id;
    $rs = run_query('SELECT * FROM '.$table.' WHERE '.$table_id.'='.$id);
    echo $query ;
    echo mysql_error();
    $form_info = mysql_fetch_assoc($rs);
    
    
}
///////////////////////////////////////////////////////////////////////////////////////
//// TO DO fromata da pokazva i postove !
?>

<form method="post" action="groups_cat.php">
    Category name:<input type="text" name="group_name" value="<?php  echo isset($form_info['name']) == 1?$form_info['name']:''  ?>" /><br />
    Description:<textarea name="description" rows="5" cols="50"><?php  echo isset($form_info['description']) == 1?$form_info['description']:''  ?></textarea><br />
    Status:<select name="status">
                <option <?php  echo isset($form_info['status']) == 1? $form_info['status'] == 0 ? 'selected="selected"':'' :''  ?>value="0">Not Displyed</option>
                <option <?php  echo isset($form_info['status']) == 1? $form_info['status'] == 1 ? 'selected="selected"':'' :''  ?>value="1">Active</option>
           </select> <br />
    <input type="submit" value="Submit" />
    <input type="hidden" name="ng" value="1" />
    <?php
    if (isset($_GET['mode']) == "edit"){
        echo '<input type="hidden" name="edit_id" value="'.$_GET['id'].'" />';    
    }
    ?>
</form>
<?php
adminfooter();
?>



