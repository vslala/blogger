<?php




    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $blogID = $_POST['blogID'];
    
    require_once 'admin/php/DBConnect.php';
    $db = new DBConnect();
    
    $flag = $db->insertComment($blogID, $comment, $username);
    
    if($flag){
        $db->setNotificationForComment($blogID, $username);
    }

    $result = $db->getCommentsByBlogID($blogID);
    echo json_encode($result);
    
    
?>


