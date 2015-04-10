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
    const DB_NAME = "blogger";

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
            
            $flag = $this->insertBlogImage($blogId, $imageName, $imageType, $imageSize);
            
        } else {
            return false;
        }
        
        if($flag){
            return true;
        } else {
            return $blogFlag;
        }
        
    }
    
    public function insertBlogImage($blogId, $imageName, $imageType, $imageSize)
    {
        if($blogId)
        {
            if($imageName !== null)
            {
                if($imageSize > 0)
                {
                    $validImages = ["image/jpeg", "image/png", "image/jpg"];
                    if(in_array($imageType, $validImages)){
                        $stmt = $this->db->prepare("INSERT INTO images (blog_id, image_name, image_type, image_size) VALUES (?,?,?,?)");
                        $stmt->execute([$blogId, $imageName,$imageType,$imageSize]);
                        if($stmt->rowCount() > 0){
                            move_uploaded_file($imageName, "../images");
                            return true;
                        }else {
                            return false;
                        }
                    } else { return "Invalid File Type"; }
                } else return false;
            } else return false;
        } else return false;
    }
    
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
}
