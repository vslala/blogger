<?php
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
    }
    $flag = $db->updateAboutMe($id, $content);
    
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
                <form class="form-vertical" role="form" method="POST" action="about.php" id="about_edit_form">
                    <input type="hidden" name="blog_id" value="<?php if(isset($about[0])){echo $about[0]['id']; }else{ echo ''; } ?>" >
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="about" rows="10"><?php if(isset($about[0])){echo $about[0]['about_me']; }else{ echo ''; } ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="aboutSubmit" class="btn btn-md btn-primary" value="Update" id="submitBtn" />
                    </div>
                </form>
            </section>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<?php 'layout/_footer.php'; ?>
