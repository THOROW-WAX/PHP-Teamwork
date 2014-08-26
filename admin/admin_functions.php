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

function check_status($status){
    switch ($status) {
        case 0: return "Locked"; 
        case 1: return "Active"; 
        default: return "Status Error (check db)";
    }
}
function add_eddit_removePostsCats(){
    $cat_name = addslashes(trim($_POST['group_name']));
    if(strlen($cat_name) >= 3){
        $description = addslashes(trim($_POST['description']));
        $status = $_POST['status']; 
        $ed_id = isset($_POST['edit_id'])==1 ? (int)$_POST['edit_id'] : 0 ;
        $rs = run_query('SELECT * FROM group_cats WHERE name="'.$cat_name.'"AND group_cats_id!="'.$ed_id.'"');
        echo mysql_error();
        //proverka za edit dali ima redove koito da se editvat 
        if(!mysql_numrows($rs) > 0 ){
                
            if(isset($_POST['edit_id']) > 0){
                $id=(int)$_POST['edit_id'];
                if($id > 0){
                    $query = sprintf(
                        "UPDATE group_cats SET name='%s',added_by='%s',description='%s',status='%s' WHERE group_cats_id=%s",
                        mysql_real_escape_string($cat_name),
                        mysql_real_escape_string('shefa'),//////////////////TO DO
                        mysql_real_escape_string($description),
                        mysql_real_escape_string($status),
                        mysql_real_escape_string($id)
                        );
                    run_query($query);
                    echo mysql_error();
                    echo "<br>Updated !!!";    
                }else{
                    echo "ID ERROR";    
                }
            }
            else {
                $query = sprintf(
                    "INSERT INTO group_cats (group_cats_id,added_by,name,description,status) VALUES('NULL','%s','%s','%s','%s')",
                    mysql_real_escape_string('shefa'),//////////////////TO DO
                    mysql_real_escape_string($cat_name),
                    mysql_real_escape_string($description),
                    mysql_real_escape_string($status)
                    );
                    echo $query;
                run_query($query);
                echo mysql_error();
                echo "<br>Submited !!!";
            }
        }else{
            echo "Error"; 
        }
    }else{
        echo "Name too short";
    }
}
function user_check_form_info(){
    $errors = 0;    
    if(isset($_POST['login']) && $_POST['login']!= '') {$user['login'] = $_POST['login'];}else{$errors++; echo "Error user login not set<br>";}
    if(isset($_POST['pass']) && $_POST['pass'] != '') {$user['pass'] = $_POST['pass'];}else{$errors++; echo "Error user password not set<br>";}
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
    $query = sprintf(
             "UPDATE `users` SET `login`='%s',`pass`='%s',`real_name`='%s',`email`='%s',`status`='%s',`active`='%s' WHERE `user_id`='%s'",
             mysql_real_escape_string($user_edit['login']),
             mysql_real_escape_string($user_edit['pass']),
             mysql_real_escape_string($user_edit['name']),
             mysql_real_escape_string($user_edit['email']),
             mysql_real_escape_string($user_edit['status']),
             mysql_real_escape_string($user_edit['active']),
             mysql_real_escape_string((int)$user_id)
             );
    run_query($query);
    
}
function users_remove(){
    echo "Successfully Deleted <br>";
    $user_delete = user_check_form_info();
    $user = $user_delete['login'];
    $query = sprintf('DELETE FROM users WHERE login = "%s"',$user);
    run_query($query);
    
    //DELETE FROM `forum`.`users` WHERE `users`.`user_id` = 7
}
?>

