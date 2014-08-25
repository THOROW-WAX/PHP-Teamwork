<?php
include "functions.php";
myHeader("Users");
$page = $_GET['page'];
$limitStart = ($page - 1) * 30;
$limitEnd = $page * 30;
//connect to DB
db_init();
$dbResult = mysql_query("SELECT * FROM `users` ORDER BY date_reg DESC LIMIT {$limitStart}, $limitEnd");
echo mysql_error();
while ($row = mysql_fetch_assoc($dbResult)){
    echo
    "<ul>
        <li>".$row['login']."</li>
        <li>".date("d-m-Y",$row['date_reg'])."</li>
        <li>".$row['real_name']."</li>
    </ul>";
}




?>

<ul>
    <li><a href="users.php?page=1">1</a></li>
    <li><a href="users.php?page=2">2</a></li>
    <li><a href="users.php?page=3">3</a></li>
    <li><a href="users.php?page=4">4</a></li>
    <li><a href="users.php?page=5">5</a></li>
</ul>
