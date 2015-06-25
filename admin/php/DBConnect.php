<?php
/**
 * This file will be used for all the transaction with the database
 *
 * @author Varun
 */
class DBConnect {
     private $db = NULL;

     const DB_SERVER = "localhost";
     const DB_USER = "root";
     const DB_PASSWORD = "";
    // const DB_SERVER = "ap-cdbr-azure-east-c.cloudapp.net";
    // const DB_USER = "b9ebb4837a6198";
    // const DB_PASSWORD = "09653ffb";
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
	
    public function createBlog($heading, $content, $tags, $imageName = null, $imageType = null, $imageSize = null)
    {
        $tagArray = explode(' ', $tags);
        $stmt = $this->db->prepare("INSERT INTO blogs (heading,content) VALUES (?,?)");
        $stmt->execute([$heading,$content]);
        $blogId = $this->db->lastInsertId();
        if($blogId) // if blog is inserted successfully
        {
            $blogFlag = true;
            if (!empty($tagArray)) {
                for ($i = 0; $i < count($tagArray); $i++) {
                    $stmt = $this->db->prepare("INSERT INTO tags (blog_id, tag) VALUES (?,?)");
                    $stmt->execute([$blogId, $tagArray[$i]]);
                }
            }
            
//            $flag = $this->insertBlogImage($blogId, $imageName, $imageType, $imageSize);
            
        } else {
            return false;
        }
        
        return $blogFlag;
        
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
        $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY created_at DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
     public function fetchAllBlogsLimit($l,$u)
    {
        $l = intval($l); $u= intval($u);
        $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT $l,$u ");
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
    
    public function updateBlog($blogId, $heading, $content)
    {
        $stmt = $this->db->prepare("UPDATE blogs SET heading=?, content=? WHERE id=?");
        $stmt->execute([$heading,$content,$blogId]);
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
    
    public function updateAboutMe($id,$content){
        $stmt = $this->db->prepare("SELECT * FROM about");
        $stmt->execute();
        $count = count($stmt->fetchAll());
        
        if($count<=0){
            $stmt = $this->db->prepare("INSERT INTO about (about_me) VALUES (?)");
            $flag = $stmt->execute([$content]);
            if($flag)
                return true;
            else
                return false;
        } else{
            $stmt = $this->db->prepare("UPDATE about SET about_me=? WHERE id=?");
            $flag = $stmt->execute([$content,$id]);
            if($flag){
                return true;
            }else{
                return false;
            }
        }
    }
    
    public function insertComment($blogID, $comment,$username){
        $stmt = $this->db->prepare("INSERT INTO comments (blog_id,comment,username) VALUES (?,?,?)");
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
        $stmt = $this->db->prepare("INSERT INTO notifications (blog_id, username) VALUES(?,?)");
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
        $stmt = $this->db->prepare("INSERT INTO projects (title,link,description) VALUES (?,?,?)");
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
}
