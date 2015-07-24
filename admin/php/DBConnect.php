<?php
/**
 * This file will be used for all the transaction with the database
 *
 * @author Varun
 */
class DBConnect {
     private $db = NULL;
////
//     const DB_SERVER = "localhost";
//     const DB_USER = "root";
//     const DB_PASSWORD = "";
     const DB_SERVER = "ap-cdbr-azure-east-c.cloudapp.net";
     const DB_USER = "b9ebb4837a6198";
     const DB_PASSWORD = "09653ffb";
    const DB_NAME = "bloggerdb";

    public function __construct() {
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_SERVER;
        try {
            $this->db = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' .
            $e->getMessage());
        }
        return $this->db;
    }
	
    public function createBlog($heading, $content, $sort=0, $tags, $coverImage)
    {
        $tagArray = explode(' ', $tags);
        $stmt = $this->db->prepare("INSERT INTO blogs (`heading`,`content`,`sort`,`cover_image`) VALUES (?,?,?,?)");
        if ($stmt->execute([$heading, $content, $sort, $coverImage])) {
            $blogId = $this->db->lastInsertId();
            if ($blogId) { // if blog is inserted successfully
                $blogFlag = true;
                if (!empty($tagArray)) {
                    for ($i = 0; $i < count($tagArray); $i++) {
                        $stmt = $this->db->prepare("INSERT INTO tags (blog_id, tag) VALUES (?,?)");
                        $stmt->execute([$blogId, $tagArray[$i]]);
                    }
                }
            } else {
                return $this->db->errorInfo();
            }

            return $blogFlag;
        } else {
            return $this->db->errorInfo();
        }
    }
    
//    public function insertBlogImage($blogId, $imageName, $imageType, $imageSize)
//    {
//        if($blogId)
//        {
//            if($imageName !== null)
//            {
//                if($imageSize > 0)
//                {
//                    $imageUrl = "images/".$imageName;
//                    $validImages = ["image/jpeg", "image/png", "image/jpg"];
//                    if(in_array($imageType, $validImages)){
//                        $stmt = $this->db->prepare("INSERT INTO images (blog_id, image_name, image_type, image_size, image_url) VALUES (?,?,?,?,?)");
//                        $stmt->execute([$blogId, $imageName,$imageType,$imageSize, $imageUrl]);
//                        if($stmt->rowCount() > 0){
//
//                            return true;
//                        }else {
//                            return false;
//                        }
//                    } else { return "Invalid File Type"; }
//                } else return false;
//            } else return false;
//        } else return false;
//    }
    
    public function fetchAllBlogs()
    {
        $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY sort ASC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
     public function fetchAllBlogsLimit($l,$u)
    {
        $l = intval($l); $u= intval($u);
        $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY sort ASC LIMIT $l,$u ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getBlogById($id){
        $stmt = $this->db->prepare("SELECT * FROM blogs WHERE id=?");
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getblogContentByBlogId($id){
        $stmt = $this->db->prepare("SELECT content FROM blogs WHERE id=?");
        $stmt->execute([$id]);
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    public function getBlogCoverImageByBlogId($id){
        $stmt = $this->db->prepare("SELECT cover_image FROM blogs WHERE id=?");
        $stmt->execute([$id]);
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    public function updateBlog($blogId, $heading, $content, $sort, $coverImage)
    {
        $stmt = $this->db->prepare("UPDATE blogs SET heading=?, content=?, sort=?, cover_image=? WHERE id=?");
        $stmt->execute([$heading,$content,$sort,$coverImage,$blogId]);
        return true;
    }
    
    public function deleteBlog($id){
        $stmt = $this->db->prepare("DELETE FROM blogs WHERE id=? ");
        $stmt->execute([$id]);
        return true;
    }
    
//    public function updateAboutMe($id,$content){
//        $stmt = $this->db->prepare("UPDATE about SET about_me=? WHERE id=?");
//        if($stmt->execute([$content, $id])){
//            return true;
//        }else{
//            return false;
//        }
//    }
//    
//    private function insertIntoAboutMe($content){
//        $stmt = $this->db->prepare("INSERT INTO about (about_me) VALUES (?)");
//            if($stmt->execute([$content])){
//                return true;
//            }else{
//                return false;
//            }
//    }
//
//
//    public function insertAboutMe($id,$content){
//        $flag = $this->checkAboutInsert();      
//        if($flag){
//            return $this->insertIntoAboutMe($content);
//        }else{
//            return $this->updateAboutMe($id,$content);          
//        }
//             
//    }
//    
    public function selectAllFromAbout(){
        $stmt = $this->db->prepare("SELECT * FROM about");
        $stmt->execute();
        return $stmt->fetchAll();
    }
//
//    public function checkAboutInsert(){
//        $stmt = $this->db->prepare("SELECT * FROM about");
//        $stmt->execute();
//        if(count($stmt->fetchAll()) <= 0){
//            return true;
//        }else {
//            return false;
//        }
//    }
    
    public function updateAboutMe($id,$content,$coverImage, $coverHeading,$coverSubHeading){
        $stmt = $this->db->prepare("SELECT * FROM about");
        $stmt->execute();
        $count = count($stmt->fetchAll());
        
        if($count<=0){
            $stmt = $this->db->prepare("INSERT INTO about (`about_me`, `cover_image`, `cover_heading`, `cover_subheading`) VALUES (?,?,?,?)");
            $flag = $stmt->execute([$content, $coverImage, $coverHeading, $coverSubHeading]);
            if($flag)
                return true;
            else
                return false;
        } else{
            $stmt = $this->db->prepare("UPDATE about SET about_me=?, cover_image=?, cover_heading=?, cover_subheading=? WHERE id=?");
            $flag = $stmt->execute([$content, $coverImage, $coverHeading, $coverSubHeading,$id]);
            if($flag){
                return true;
            }else{
                return false;
            }
        }
    }
    
    public function insertComment($blogID, $comment,$username){
        $stmt = $this->db->prepare("INSERT INTO comments (`blog_id`,`comment`,`username`) VALUES (?,?,?)");
        if($stmt->execute([$blogID,$comment,$username])){
            return true;
        }else{
            return $this->db->errorInfo();
        }
    }
    
    public function getCommentsByBlogID($blogID){
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE blog_id=?");
        if($stmt->execute([$blogID])){
            return $stmt->fetchAll();
        }else{
            return $this->db->errorInfo();
        }
    }
    
    public function setNotificationForComment($blogID,$username){
        $stmt = $this->db->prepare("INSERT INTO notifications (`blog_id`, `username`) VALUES(?,?)");
        if($stmt->execute([$blogID, $username]))
                return true;
        else
            return $this->db->errorInfo();
    }
    
    public function getNotification(){
        $stmt = $this->db->prepare("SELECT * FROM notifications");
        if($stmt->execute())
            return $stmt->fetchAll();
        else
            return $this->db->errorInfo ();
    }
    
    public function deleteNotificationByBlogID($blogID){
        $stmt = $this->db->prepare("DELETE FROM notifications WHERE blog_id=?");
        $stmt->execute([$blogID]);
    }
    
    public function deleteBlogCommentWithId($id){
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id=?");
        if($stmt->execute([$id]))
            return true;
        else
            return $this->db->errorInfo ();
    }

    public function addProject($title, $link, $description){
        $stmt = $this->db->prepare("INSERT INTO projects (`title`,`link`,`description`) VALUES (?,?,?)");
        $flag = $stmt->execute([$title,$link,$description]);
        if($flag){
            return true;
        } else{
            return $this->db->errorInfo();
        }
    }

    public function fetchAllProjects(){
        $stmt = $this->db->prepare("SELECT * FROM projects");
        $flag = $stmt->execute();
        if($flag){
            return $stmt->fetchAll();
        }
    }

    public function fetchProjectById($id){
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE id=?");
        $flag = $stmt->execute([$id]);
        if($flag){
            return $stmt->fetchAll();
        }
    }

    public function editProject($title, $link, $description, $id){
        $stmt = $this->db->prepare("UPDATE projects SET title=?, link=?, description=? WHERE id=?");
        $flag = $stmt->execute([$title,$link,$description,$id]);
        if($flag){
            return true;
        } else{
            return $this->db->errorInfo();
        }
    }

    public function deleteProjectById($id){
        $stmt = $this->db->prepare("DELETE FROM projects WHERE id=? ");
        $flag = $stmt->execute([$id]);

        if($flag){
            return true;
        } else{
            return $this->db->errorInfo();
        }
    }

    public function incrementBlogCount($id){
        $stmt = $this->db->prepare("SELECT `views` FROM blogs WHERE id=?");
        $stmt->execute([$id]);
        $result = $stmt->fetchColumn();
        if($result == NULL){
            $stmt = $this->db->prepare("UPDATE blogs SET views=1 WHERE id=?");
            $flag = $stmt->execute([$id]);
            if($flag){
                return true;
            }
        }

        $stmt = $this->db->prepare("UPDATE blogs SET views=views+1 WHERE id=?");
        $flag = $stmt->execute([$id]);
        if($flag){
            return true;
        }else{
            return $this->db->errorInfo();
        }
        
    }
    
    public function setLayout($forPage,$coverImage, $coverHeading, $coverSubHeading){
        $stmt = $this->db->prepare("SELECT * FROM layout WHERE for_page=?");
        if($stmt->execute([$forPage])){
            if(count($stmt->fetchAll()) <= 0){
                $stmt = $this->db->prepare("INSERT INTO layout (`for_page`, `cover_image`, `cover_heading`, `cover_subheading`) VALUES (?,?,?,?)");
                if($stmt->execute([$forPage,$coverImage,$coverHeading,$coverSubHeading])){
                    return true;
                }else{
                    return $this->db->errorInfo();
                }
            }else{
                $stmt = $this->db->prepare("UPDATE layout SET cover_image=?, cover_heading=?, cover_subheading=? WHERE for_page=?");
                if($stmt->execute([$coverImage,$coverHeading,$coverSubHeading,$forPage])){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
    
    public function getLayout($forPage){
        $stmt = $this->db->prepare("SELECT * FROM layout WHERE for_page=?");
        if($stmt->execute([$forPage])){
            return $stmt->fetchAll();
        }else{
            return false;
        }
    }
    
    public function getAllLayouts(){
        $stmt = $this->db->prepare("SELECT * FROM layout");
        if($stmt->execute()){
            return $stmt->fetchAll();
        }else{
            return false;
        }
    }
    
    public function deleteLayout($for){
        $stmt = $this->db->prepare("DELETE FROM layout WHERE for_page=?");
        if($stmt->execute([$for]))
            return true;
        else
            return false;
    }
}
