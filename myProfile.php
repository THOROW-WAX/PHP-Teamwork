<?php
session_start();
include "functions.php";
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true) {
    foreach ($_SESSION['userInfo'] as $key => $info){
        if ($key == 'pass' || $key == 'user_id'){
            continue;
        } elseif ($key == 'real_name') {
            echo "<div><span>Your name: $info </span></div>";
        } elseif ($key == 'date_reg') {
            echo "<div><span> Registration Date:". date('d-m-Y', $info). "</span></div>";
        } elseif ($key == 'status') {
            if ($info == 1) {
                echo "<div><span>Permissions: User </span></div>";
            } else {
                echo "<div><span>Permissions: Admin </span></div>";
            }
        } elseif ($key == 'active') {
            echo "<div><span>Status: Active </span></div>";
        } elseif ($key == 'email') {
            echo "<div><span>Email: $info </span></div>";
        }
    }

    echo "<a href='admin/users.php'>Edit your profile </a>";

}