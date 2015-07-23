<?php
$scripts = ["https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js","http://cdn.ckeditor.com/4.5.1/full/ckeditor.js", "js/myjs.js"];
$title = "About Edit";
$setAboutActive="active";

require 'php/DBConnect.php';
$db = new DBConnect();

$error = null;
$message = null;
if(isset($_POST['aboutSubmit'])){
    $id = null;
    $content = $_POST['content'];
    if(isset($_POST['blog_id'])){
        $id = $_POST['blog_id'];
        $coverImage = $_POST['coverImage'];
        $coverHeading = $_POST['coverHeading'];
        $coverSubHeading = $_POST['coverSubHeading'];
    }
    $flag = $db->updateAboutMe($id, $content, $coverImage, $coverHeading, $coverSubHeading);
    
    if($flag){
        $message = "About update Successfully!";
    }else{
        $error = "Error updating the about me";
    }
}

$about = $db->selectAllFromAbout();



include 'layout/_header.php';

?>
<div class="container">
    <?php include 'layout/_top_nav.php'; ?>
    
    <div class="row first-row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <?php if(isset($message)): ?>
            <div class="alert-success">
                <?= $message; ?>
            </div>
            <?php endif; ?>
            <?php if(isset($error)): ?>
            <div class="alert-danger">
                <?= $error; ?>
            </div>
            <?php endif; ?>
            
            <section class="about-edit">
                <button class="btn btn-default" type="button" onclick="previewText()" id="preview_button">Preview</button>
                <form class="form-vertical" role="form" method="POST" action="about.php" id="about_edit_form">
                    <input type="hidden" name="blog_id" value="<?php if(isset($about[0])){echo $about[0]['id']; }else{ echo ''; } ?>" >
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="about" rows="10"><?php if(isset($about[0])){echo $about[0]['about_me']; }else{ echo ''; } ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="coverImage" placeholder="Cover Image Url" class="form-control" value="<?= $about[0]['cover_image']; ?>" id="cover_image" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="coverHeading" placeholder="Cover Heading" class="form-control" value="<?= $about[0]['cover_heading']; ?>" id="cover_heading" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="coverSubHeading" placeholder="Cover Sub Heading" class="form-control" value="<?= $about[0]['cover_subheading']; ?>" id="cover_subheading" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="aboutSubmit" class="btn btn-md btn-primary" value="Update" id="submitBtn" />
                    </div>
                </form>
                <hr>
                <div class="form-group">
                    <div class="preview" id="preview_pane" contenteditable="true">
                        
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<?php 'layout/_footer.php'; ?>
