<?php
require_once 'DBConnect.php';
require_once 'Values.php';

$value = new Values();
$db = new DBConnect();
$base_url = $value->getBaseUrl();


    $forPage = $_POST['forPage'];
$coverImage = $_POST['coverImage'];
$coverHeading = $_POST['coverHeading'];
$coverSubHeading = $_POST['coverSubHeading'];
$flag = $db->setLayout($forPage, $coverImage, $coverHeading, $coverSubHeading);
if ($flag) {
//        session_start();
//        $message = "Layout set Successfully!";
//        $_SESSION['success_message'] = $message;
    echo true;
//        header("Location: ".$base_url."admin/layout.php");
//        die();
} else {
//        session_start();
//        $error = "There was some error: " . $flag;
//        $_SESSION['error_message'] = $error;
    echo false;
//        header("Location: ".$base_url."/admin/layout.php");
//        die();
}
