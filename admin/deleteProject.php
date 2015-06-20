<?php
$id = NULL;
if(isset($_GET['id']))
	$id = $_GET['id'];

require_once "php/DBConnect.php";
$db = new DBConnect();
$flag = $db->deleteProjectById($id);

if($flag){
	echo "Deleted Project Successfully!";
} else {
	echo $flag;
}
?>