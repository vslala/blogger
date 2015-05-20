<?php
    require_once 'admin/php/DBConnect.php';
    $db = new DBConnect();
if(isset($_GET['id'])){
    if(isset($_GET['delete'])){
        $id  = $_GET['id'];
        $delete = $_GET['delete'];
        
        if($delete){
            $db->deleteBlogCommentWithId($id);
        }
    }
}


    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $blogID = $_POST['blogID'];
    

    
    $flag = $db->insertComment($blogID, $comment, $username);
    
    if($flag){
        $db->setNotificationForComment($blogID, $username);
    }

    $result = $db->getCommentsByBlogID($blogID);
    echo json_encode($result);
    
    
?>


