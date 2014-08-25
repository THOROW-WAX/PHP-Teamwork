<?php
session_start();

include 'admin_header_footer.php';

////////// TO BE REMOVED WHEN CONNECTED TO LOGIN FORM //////////////
//$_SESSION['is_logged'] = TRUE ;
//$_SESSION['user_info']['type']=3;
////////// TO BE REMOVED WHEN CONNECTED TO LOGIN FORM //////////////



    
admin_header("Admin Panel");    



echo "<h1>WELCOME TO ADMIN HOME PAGE</h1>";


footer(); 
?>