<?php 
include '../functions.php';
////////////////////CHEKS IF ADMIN IS LOGED IN /////////
function isLoggedAdmin($isLogged, $isAdmin){
    if($_SESSION['isLogged'] === TRUE && $_SESSION['userInfo']['status']==2){
        return "logged admin";
    }
    else{
        header('Location: ../index.php');
        exit;
    }
}

function form_categories($ls_cats){
?>
<form method="post" action="groups_cat.php">
    Name:<input type="text" name="cat_name" value="<?php echo isset($ls_cats['name'])?$ls_cats['name']:''; ?>" /><br />
    Description :<input type="text" name="description" value="<?php echo isset($ls_cats['description'])?$ls_cats['description']:'';?>" /><br />
    Status: <select name="status" >
                <option <?php echo isset($ls_cats['status'])?$ls_cats['status']==0?'selected="selected"' :'':'' ;?> value="0" >InActive</option>
                <option <?php echo isset($ls_cats['status'])?$ls_cats['status']==1?'selected="selected"' :'':'' ;?> value="1" >Active</option>
            </select>
    <input type="submit" name="submit" value="Create Cat" />
    <input type="submit" name="submit" value="Submit Cat" />
    <input type="submit" name="submit" value="Delete Cat" />
    <input type="hidden" name="cat_id" value="<?php echo $ls_cats['categories_id'] ?>" />
    <p>WARNING!!! Category will be deleted only if empty</p>   
</form>
<?php    
}
function form_topics($ls_topics){         // TO ADD CHANGEING CATEGORY
?>
<form method="post" action="groups_cat.php">
    Title:<input type="text" name="topic_name" value="<?php echo isset($ls_topics['title'])?$ls_topics['title']:''; ?>" /><br />
    Status: <select name="status">
                <option <?php echo isset($ls_topics['status'])?$ls_topics['status']==0?'selected="selected"' :'':'' ;?> value="0" >InActive</option>
                <option <?php echo isset($ls_topics['status'])?$ls_topics['status']==1?'selected="se4lected"' :'':'' ;?> value="1" >Active</option>
            </select>
    Category:<select name= "categories_s" >
                <?php
                    $rs = run_query('SELECT * FROM categories');
                    while ($cats_select = mysql_fetch_assoc($rs)) {
                        
                        if($ls_topics['categories_id']  == $cats_select['categories_id']){
                            echo '<option selected="selected" value="'.$cats_select['categories_id'].'" >'.$cats_select['name'].'</option>';    
                        }else{
                            echo '<option value="'.$cats_select['categories_id'].'" >'.$cats_select['name'].'</option>';
                        }
                    } 
                ?>      
             </select>
    <input type="submit" name="submit" value="Create Topic" />
    <input type="submit" name="submit" value="Submit Topic" />
    <input type="submit" name="submit" value="Delete Topic" />
    <input type="hidden" name="topic_id" value="<?php echo $ls_topics['topic_id'] ?>" />
    <p>WARNING!!! Category will be deleted only if empty</p>   
    
</form>
<?php    
}
function form_posts(){
?>
<form method="post" action="groups_cat.php">
    Category name:<input type="text" name="cat_name" value="" /><br />
    Category name:<input type="text" name="cat_desc" value="" /><br />
    Status: <select>
                <option>InActive</option>
                <option>Active</option>
            </select>
</form>
<?php    
}

function user_check_form_info(){
    $errors = 0;    
    if(isset($_POST['login']) && $_POST['login']!= '') {$user['login'] = $_POST['login'];}else{$errors++; echo "Error user login not set<br>";}
    if(isset($_POST['pass']) ) {$user['pass'] = $_POST['pass'];}else{$errors++; echo "Error user password not set<br>";}
    if(isset($_POST['name']) && $_POST['name'] != '') {$user['name'] = $_POST['name'];}else{$errors++; echo "Error user name not set<br>";}
    if(isset($_POST['email']) && $_POST['email']!= '') {$user['email'] = $_POST['email'];}else{$errors++; echo "Error user email not set<br>";}
    $user['status'] = $_POST['status'];
    $user['active'] = $_POST['active'];
    if($errors > 0){
        echo "Not submited<br>";
    }else{
        return $user; 
    }
}
function users_add(){
    echo "Successfully Created <br>";
    $user_add = user_check_form_info();
    $query = sprintf(
            "INSERT INTO users (`user_id`, `login`, `pass`, `real_name`, `email`, `date_reg`, `status`, `active`)
             VALUES (NULL, '%s', MD5('%s'), '%s', '%s', '%s', '%s', '%s')",
             mysql_real_escape_string($user_add['login']),
             mysql_real_escape_string($user_add['pass']),
             mysql_real_escape_string($user_add['name']),
             mysql_real_escape_string($user_add['email']),
             time(),
             mysql_real_escape_string($user_add['status']),
             mysql_real_escape_string($user_add['active'])
            );
    run_query($query);
}
function users_edit(){
    echo "Successfully Edited <br>";
    $user_edit = user_check_form_info();
    $user_id = $_POST['user_id']; 
    if($user_edit['pass'] != ''){
        if($user_edit['pass'] == $user_edit['pass2']){
            echo "updating pass ";
            $query = sprintf(
                     "UPDATE `users` SET `login`='%s',`pass`='%s',`real_name`='%s',`email`='%s',`status`='%s',`active`='%s' WHERE `user_id`='%s'",
                     mysql_real_escape_string($user_edit['login']),
                     mysql_real_escape_string(md5($user_edit['pass'])),
                     mysql_real_escape_string($user_edit['name']),
                     mysql_real_escape_string($user_edit['email']),
                     mysql_real_escape_string($user_edit['status']),
                     mysql_real_escape_string($user_edit['active']),
                     mysql_real_escape_string((int)$user_id)
                 );
        }else{
            echo "Error in password";
        }
    }else{
        $query = sprintf(
                 "UPDATE `users` SET `login`='%s',`real_name`='%s',`email`='%s',`status`='%s',`active`='%s' WHERE `user_id`='%s'",
                 mysql_real_escape_string($user_edit['login']),
                 mysql_real_escape_string($user_edit['name']),
                 mysql_real_escape_string($user_edit['email']),
                 mysql_real_escape_string($user_edit['status']),
                 mysql_real_escape_string($user_edit['active']),
                 mysql_real_escape_string((int)$user_id)
             );
    }
    run_query($query);
    
}
function users_remove(){
    echo "Successfully Deleted <br>";
    $user_delete = user_check_form_info();
    $user = $user_delete['login'];
    $query = sprintf('DELETE FROM users WHERE login = "%s"',$user);
    run_query($query);
}
function check_cat_form_info(){
    $cat_for['errors'] = 0 ;
    if(isset($_POST['cat_name']) && $_POST['cat_name']!= '') {$cat_for['cat_name'] = $_POST['cat_name'];}else{$cat_for['errors']++; echo "Error Name not set<br>";} 
    if(isset($_POST['description']) && $_POST['description']!= '') {$cat_for['description'] = $_POST['description'];}else{$cat_for['errors']++; echo "Error description not set<br>";} 
    $cat_for['status'] = $_POST['status'];
    return $cat_for;
}

function category_create(){
    $cat_info = check_cat_form_info();
    //var_dump($cat_info);
    //var_dump($_SESSION);
    if($cat_info['errors'] == 0 ){
        $query = sprintf("INSERT INTO `categories` (`categories_id`, `added_by`, `name`, `description`, `status`) 
                          VALUES (NULL, '%s', '%s', '%s', '%s')",
                        mysql_real_escape_string($_SESSION['userInfo']['login']),
                        mysql_real_escape_string($cat_info['cat_name']),
                        mysql_real_escape_string($cat_info['description']),
                        mysql_real_escape_string($cat_info['status'])
                        );
        run_query($query);
    }else{
        echo "info error";
    }
}
function category_edit(){
    $cat_info = check_cat_form_info(); 
    if(isset($_POST['cat_id'])){
        if($cat_info['errors'] == 0){
            $query = sprintf(
                         "UPDATE `categories` SET `name`='%s',`description`='%s',`status`='%s' WHERE `categories_id`='%s'",
                         mysql_real_escape_string($cat_info['cat_name']),
                         mysql_real_escape_string($cat_info['description']),
                         mysql_real_escape_string($cat_info['status']),
                         mysql_real_escape_string((int)$_POST['cat_id'])
                     );
        run_query($query);
        }else{
         echo "cat id error";
        }
         
     }else{
         echo "cat id error";
     }
}
function category_remove(){
    if(isset($_POST['cat_id'])){
        $query = sprintf('DELETE FROM categories WHERE categories_id = "%s"',(int)$_POST['cat_id']);
        run_query($query);
    }else{
        echo "cat id error";
    }
}
function topic_form_check(){
    $topic_for['errors'] = 0 ;
    if(isset($_POST['topic_name']) && $_POST['topic_name']!= '') {$topic_for['topic_name'] = $_POST['topic_name'];}else{$topic_for['errors']++; echo "Error Name not set<br>";} 
    $topic_for['status'] = $_POST['status'];
    echo $_POST['categories_s'];
    $topic_for['categories_id'] = $_POST['categories_s'];
    return $topic_for;
}
function topic_add(){
    $topic_info = topic_form_check();
    if($topic_info['errors'] == 0 ){
        $query = sprintf("INSERT INTO `topics` (`topic_id`, `categories_id`, `added_by`, `date_added`, `title`, `status`, `counter`) 
                          VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '0')",
                        mysql_real_escape_string($topic_info['categories_id']),
                        mysql_real_escape_string($_SESSION['userInfo']['login']),
                        mysql_real_escape_string(time()),
                        mysql_real_escape_string($topic_info['topic_name']),
                        mysql_real_escape_string($topic_info['status'])
                        );
        run_query($query);
    }else{
        echo"cat info error";
    }
}
function topic_edit(){
    echo "edit topic";
    $topic_info = topic_form_check();
    var_dump($topic_info);
    if(isset($_POST['topic_id'])){
        if($topic_info['errors'] == 0){
            $query = sprintf(
                         "UPDATE `topics` SET `title`='%s',`status`='%s',`categories_id`='%s' WHERE `topic_id`='%s'",
                         mysql_real_escape_string($topic_info['topic_name']),
                         mysql_real_escape_string($topic_info['status']),
                         mysql_real_escape_string($topic_info['categories_id']),
                         mysql_real_escape_string((int)$_POST['topic_id'])
                     );
             var_dump($query);
             run_query($query);
        //run_query($query);
        }else{
         echo "cat id error";
        }
         
     }else{
         echo "cat id error";
     }
    
}
function topic_remove(){
    if(isset($_POST['topic_id'])){
        $query = sprintf('DELETE FROM topics WHERE topic_id = "%s"',(int)$_POST['topic_id']);
        run_query($query);
    }else{
        echo "cat id error";
    }
}
    
    //DELETE FROM `forum`.`users` WHERE `users`.`user_id` = 7

?>