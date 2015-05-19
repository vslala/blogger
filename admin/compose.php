<?php
$title = "Compose Blog"; $setComposeActive = "active";

 if (isset($_POST['saveBtn'])) {
//     $imageName = $_FILES['file']['name'];
//     $imageType = $_FILES['file']['type'];
//     $imageSize = $_FILES['file']['size'];
//     $imageTmp  = $_FILES['file']['tmp_name'];
     $heading = $_POST['heading'];
     $content = $_POST['content'];
     $tags = $_POST['tags'];
    require_once 'php/DBConnect.php';

    $db = new DBConnect();
    $flag = $db->createBlog($heading, $content, $tags, $imageName, $imageType, $imageSize);
    if ($flag) {
        $confirmation = "The blog has been inserted in the database successufully!";
        move_uploaded_file($imageTmp, "../images/". basename($imageName));
    }
}


include 'auth/checkAuth.php';
include 'layout/_header.php';
?>
<div class="container">
    <?php    include 'layout/_top_nav.php'; ?>
    
    <div class="row first-row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <?php if(isset($confirmation)): ?>
            <div class="alert-success">
                <?php echo $confirmation; ?>
            </div>
            <?php            endif; ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="h2">Compose Blog</div>
                </div>
                <div class="panel-body">
                    <div class="form-group-lg">
                        <form class="form-horizontal" method="post" action="compose.php" id="blog_compose_form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label col-md-4">Heading:</label>
                                <div class="col-md-8">
                                    <input type="text" name="heading" class="form-control" maxlength="500" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label col-md-4">Content:</label>
                                <div class="col-md-8">
                                    <textarea rows="15" name="content" class="form-control" maxlength="3000" ></textarea>
                                </div>
                            </div>
<!--                            <div class="form-group">
                                <label class="form-label col-md-4">Image:</label>
                                <div class="col-md-8">
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="form-label col-md-4">Tags: </label>
                                <div class="col-md-8">
                                    <input type="text" name="tags" class="form-control" placeholder="ex: #science #technology etc" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label col-md-4"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success" name="saveBtn">Save</button>
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


<?php include 'layout/_footer.php'; ?>
