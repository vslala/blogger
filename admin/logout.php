<?php
require_once "php/Values.php";
$v = new Values();
$admin_login = $v->getAdminLoginUrl();
session_start();
session_destroy();

header("Location: $admin_login");
?>
