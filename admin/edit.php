<?php
$scripts = ["https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js","http://cdn.ckeditor.com/4.5.1/full/ckeditor.js", "js/myjs.js"];
$base_url = "http://varunshrivastava.azurewebsites.net/";
$blogId = null;
$heading = null;
$sort = 0;
$confirmation = null;
if(isset($_GET['id'])){
    $blogId = $_GET['id'];
    if(isset($_GET['heading']))
    {
        $heading = $_GET['heading'];
    }
    if(isset($_GET['sort']))
    {
        $sort = $_GET['sort'];
    }
}
require 'php/DBConnect.php';
$db = new DBConnect();
$content = $db->getblogContentByBlogId($blogId);

if(isset($_POST['updateBtn']))
{
    $blogId = $_POST['blogId'];
    $heading = $_POST['heading'];
    $content = $_POST['content'];
    $sort = $_POST['sort'];
    $flag = $db->updateBlog($blogId, $heading, $content, $sort);
    if($flag){
        $confirmation = "Blog has been update successfully!";
        header("Refresh: 2; url=".$base_url."admin/adminHome.php");
    }
        
}

include 'layout/_header.php';
?>
<div class="container">
    <?php    include 'layout/_top_nav.php'; ?>
    
    <div class="row first-row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if(isset($confirmation)): ?>
                    <div class='alert-success'>
                        <?= $confirmation; ?>
                    </div>
                    <?php endif; ?>
                    <div class="h2">Edit Blog</div>
                </div>
                <div class="panel-body">
                    <div class="form-group-lg">
                        <form class="form-horizontal" method="post" action="edit.php" id="blog_compose_form" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $blogId; ?>" name="blogId" />
                            <div class="form-group">
                                <label class="form-label col-md-4">Heading:</label>
                                <div class="col-md-8">
                                    <input type="text" value="<?php if(isset($heading)) echo $heading; else echo ''; ?>" name="heading" class="form-control" maxlength="500" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label col-md-4">Content:</label>
                                <div class="col-md-8">
                                    <textarea rows="10" name="content" class="form-control" maxlength="30000" id="text_editor">
                                        <?php if(isset($content)) echo $content; else echo ''; ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label col-md-4">Sort Order:</label>
                                <div class="col-md-8">
                                    <input type="number" value="<?php if(isset($sort)) echo $sort; else echo ''; ?>" name="sort" class="form-control" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label col-md-4"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success" name="updateBtn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<?php 
include 'layout/_footer.php';
?>