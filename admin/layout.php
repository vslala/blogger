<?php
$scripts = ['https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js','js/myjs.js'];
$title="Layout";
$setLayoutActive='active';

require_once 'php/DBConnect.php'; 
$db = new DBConnect();
if(isset($_POST['submitBtn'])){
    $forPage = $_POST['forPage'];
    $coverImage = $_POST['coverImage'];
    $coverHeading = $_POST['coverHeading'];
    $coverSubHeading = $_POST['coverSubHeading'];
    $flag = $db->setLayout($forPage, $coverImage, $coverHeading, $coverSubHeading);
    if($flag)
        $message = "Layout set Successfully!";
    else
        $error = "There was some error: " . $flag;
}
$layouts = $db->getAllLayouts();

?>
<?php include 'layout/_header.php'; ?>
<?php include 'layout/_top_nav.php'; ?>

<style>
    body{
        padding-top: 6em;
    }
    ul li{
        list-style: none;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            
            <div class="layout_form">
                <?php if(isset($error)): ?>
                <span class="alert alert-danger" style="font-family: tahoma, sans-serif; font-weight: bolder;"><?= $error; ?></span>
                <?php endif; ?>
                <h3>Add or Update Layout</h3>
                <form class="form-vertical" action="layout.php" method="post">
                    <div class="form-group">
                        <input class="form-control" placeholder="Layout For Page?" name="forPage" id="for_page_input"/>
                        <div class="help-block" id="show_layout_pages">
                            <b>Available Layouts</b>
                            <ul>
                                <?php foreach ($layouts as $l): ?>
                                    <li>
                                        <span class="pull-right"><a href="php/delete.php?for=<?= $l['for_page']; ?>" id="delete_layout_link">delete</a></span>
                                        <a href="#" id="for_page_list_element"><?= $l['for_page']; ?></a>
                                        <input type="hidden" value="<?= $l['cover_image']; ?>">
                                        <input type="hidden" value="<?= $l['cover_heading']; ?>">
                                        <input type="hidden" value="<?= $l['cover_subheading']; ?>">
                                    </li>
                                    
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="cover_image_input" placeholder="Cover Image Url" name="coverImage" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="cover_heading_input" placeholder="Cover Heading" name="coverHeading" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="cover_subheading_input" placeholder="Cover Sub-Heading" name="coverSubHeading" />
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Add/Update Layout" name="submitBtn" />
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php include 'layout/_footer.php'; ?>