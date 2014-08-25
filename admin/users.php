<?php
///////////////////
include 'admin_header_footer.php';
admin_header('Editing users'); 

echo "<h1>EDIT USERS & CHANGE PERMISSIONS</h1>";

db_init();
$stuf = "php";
$rs = run_q("SELECT `title` FROM `tags` WHERE `title` LIKE '".$stuf."'");
var_dump( mysql_fetch_assoc($rs));


?>








<?php
footer();
?>