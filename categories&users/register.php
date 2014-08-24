<?php
session_start();
include "functions.php";

if (!($_SESSION["isLogged"]===true)) {

} else {
    header("Location: index.php");
    exit;
}
myHeader("Index");
footer();