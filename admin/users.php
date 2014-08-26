<?php

session_start();
include 'admin_header_footer.php';
admin_header('Editing users'); 
db_init();
date_default_timezone_set("Europe/Sofia");
echo "<h1>EDIT USERS & CHANGE PERMISSIONS</h1>";
switch ((isset($_POST['submit'])== 1 ? $_POST['submit'] : '')) {
	case 'Create': users_add(); break;
	case 'Submit': users_edit(); break;
    case 'Delete': users_remove(); break;
    
	default: break;
}

echo "Slecet from <a href='../users.php?page=1'>users page</a> to edit ";

if (isset($_GET['mode']) == "edit" && (isset($_GET['id']) > 0)) {
    $id = (int)$_GET['id'];
    $query ='SELECT * FROM users WHERE user_id='.$id;
    $rs = run_query($query);
    $user_info = mysql_fetch_assoc($rs);
}

?>
<form method="post" action="users.php" >
    User login: <input type="text" name="login" value="<?php  echo isset($user_info['login']) == 1?$user_info['login']:''  ?>" /><br />
    Set new password: <input type="text" name="pass" value="" /><br />
    Repeat password: <input type="text" name="pass2" value="" /><br />
    Name: <input type="text" name="name" value="<?php  echo isset($user_info['real_name']) == 1?$user_info['real_name']:''  ?>" /><br />
    Email: <input type="email" name="email" value="<?php  echo isset($user_info['email']) == 1?$user_info['email']:''  ?>" /><br />
    Date registered: <?php  echo isset($user_info['date_reg']) == 1?date("d-m-Y",$user_info['date_reg']):''  ?></br>
    Status:<select name="status">
                <option <?php  echo isset($user_info['status']) == 1? $user_info['status'] == 1 ? 'selected="selected"':'' :''  ?> value="1" >User</option>
                <option <?php  echo isset($user_info['status']) == 1? $user_info['status'] == 2 ? 'selected="selected"':'' :''  ?> value="2" >Admin</option>
           </select> <br />
    Active:<select name="active">
                <option <?php  echo isset($user_info['active']) == 1? $user_info['active'] == 0 ? 'selected="selected"':'' :''  ?> value="0" >Suspended</option>
                <option <?php  echo isset($user_info['active']) == 1? $user_info['active'] == 1 ? 'selected="selected"':'' :''  ?> value="1" >Active</option>
           </select> <br />
    <input type="submit" name="submit" value="Create" />
    <input type="submit" name="submit" value="Submit" />
    <input type="submit" name="submit" value="Delete" />
    <input type="hidden" name="user_id" value="<?php echo isset($user_info['user_id'])? $user_info['user_id'] :'' ?>" />
</form>

<?php
adminfooter();
?>