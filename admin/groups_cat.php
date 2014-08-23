<?php
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

$rs = run_q('SELECT * FROM categories');
//// $rs contains db resorse query ID
//echo $rs ; 

/////////////////////////////GET CATEGORYS////////////////////////////////////////////////// 
echo "<ul>" ;          
while ($row = mysql_fetch_assoc($rs)) {
    ///////////The check does not work// TO DO FIX/////
    
    if(FALSE/* count($row) == 0 */){
        echo "There are no catecories";
    }else{
        echo "<li>".$row['name']."   "." --- " ;
        echo check_status($row['status']);
        echo '<a href="groups_cat.php?mode=edit&id='.$row['categories_id'].'">| Edit |</a>'."</li>";
    }

}
echo "</ul>";
//////////////////////////////   END   get cat /////////////////////////////////////////////

///////////////////////////// Form Fill Query///////////////////////////////////////////////
if (isset($_GET['mode']) == "edit" && (isset($_GET['id']) > 0)) {
	$id = (int)$_GET['id'];
    $rs = run_q('SELECT * FROM categories WHERE categories_id='.$id);
    $form_info = mysql_fetch_assoc($rs);
}
///////////////////////////////////////////////////////////////////////////////////////
?>

<form method="post" action="groups_cat.php">
    Category name:<input type="text" name="group_name" value="<?php  echo isset($form_info['name']) == 1?$form_info['name']:''  ?>" /><br />
    Description:<textarea name="description" rows="5" cols="50"><?php  echo isset($form_info['description']) == 1?$form_info['description']:''  ?></textarea><br />
    Status:<select name="status">
                <option <?php  echo isset($form_info['status']) == 1? $form_info['status'] == 0 ? 'selected="selected"':'' :''  ?>value="0">Not Displyed</option>
                <option <?php  echo isset($form_info['status']) == 1? $form_info['status'] == 1 ? 'selected="selected"':'' :''  ?>value="1">Active</option>
                <option <?php  echo isset($form_info['status']) == 1? $form_info['status'] == 2 ? 'selected="selected"':'' :''  ?>value="2">InActive</option>
                <option <?php  echo isset($form_info['status']) == 1? $form_info['status'] == 3 ? 'selected="selected"':'' :''  ?>value="3">Locked</option>
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
footer();
?>