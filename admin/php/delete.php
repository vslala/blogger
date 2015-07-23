<?php
$for = $_GET['for'];

require_once 'DBConnect.php';

$db = new DBConnect();

if($db->deleteLayout($for))
    echo true;
else
    echo false;

