<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "router.php";
include "core/alert.php";
include "core/view.php";
include "core/csrf.php";
include "core/encrypt.php";

$router = new Router();
$router->yonlendir();
?>