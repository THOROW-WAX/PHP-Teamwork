<?php 

////////////////////CHEKS IF ADMIN IS LOGED IN /////////
function isLoggedAdmin($isLogged, $isAdmin){
    if($_SESSION['is_logged'] === TRUE && $_SESSION['user_info']['type'] == 3){
        return "logged admin";
    }
    else{
        header('Location: ../index.php');
        exit;
    }
}


///////////////////DB CONNETCTION  (shuld not be here !)/////////
function db_init()
{
    mysql_connect('localhost','admin', '123') or die("Грешка с базата данни!");
    mysql_select_db('forum');
}
//////////////////UTF ENCODING FIX (shuld not be here !)/////////
function run_q($query){
    mysql_query("SET NAMES utf8");
    return mysql_query($query);
}
function check_status($status){
    switch ($status) {
        case 0: return "Not Displyed"; 
        case 1: return "Active";
        case 2: return "Inactive";
        case 3: return "Locked"; 
        default: return "Status Error (check db)";
    }
}
function add_eddit_removePostsCats(){
    $cat_name = addslashes(trim($_POST['group_name']));
    if(strlen($cat_name) >= 3){
        $description = addslashes(trim($_POST['description']));
        $status = $_POST['status']; 
        $ed_id = isset($_POST['edit_id'])==1 ? (int)$_POST['edit_id'] : 0 ;
        $rs = run_q('SELECT * FROM categories WHERE name="'.$cat_name.'"AND categories_id!="'.$ed_id.'"');
        echo mysql_error();
        if(!mysql_numrows($rs) > 0 ){
                
            if(isset($_POST['edit_id']) > 0){
                $id=(int)$_POST['edit_id'];
                if($id > 0){
                    $query = sprintf(
                        "UPDATE categories SET name='%s',description='%s',active='%s' WHERE categories_id=%s",
                        mysql_real_escape_string($cat_name),
                        mysql_real_escape_string($description),
                        mysql_real_escape_string($status),
                        mysql_real_escape_string($id)
                        );
                    run_q($query);
                    echo mysql_error();
                    echo "<br>Updated !!!";    
                }else{
                    echo "ID ERROR";    
                }
            }
            else {
                $query = sprintf(
                    "INSERT INTO categories (categories_id,name,description,active) VALUES('','%s','%s','%s')",
                    mysql_real_escape_string($cat_name),
                    mysql_real_escape_string($description),
                    mysql_real_escape_string($status)
                    );
                run_q($query);
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
?>

