<?php
    require_once 'admin/php/DBConnect.php';
    $db = new DBConnect();

    $id = $_GET['id'];
    $delete = $_GET['delete'];
    
    $flag = $db->deleteBlogCommentWithId($id);
    
    if($flag){
        echo $flag;
    }else{
        echo $flag;
    }
    ?>
