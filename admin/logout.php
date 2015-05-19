<?php
$base_url = "http://varunshrivastava.azurewebsites.net/";
session_start();
session_destroy();

header("Location: $base_url.admin/index.php");
?>
