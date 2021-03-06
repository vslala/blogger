<?php
$scripts = ['https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js','js/myjs.js'];
$title="Layout";
$setLayoutActive='active';

require_once 'php/DBConnect.php'; 
$db = new DBConnect();

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
            
            <div class="layout_form" id="layout_form_div">
                
                <?php session_start(); if(isset($_SESSION['error_message'])): ?>
                <span class="alert alert-danger" style="font-family: tahoma, sans-serif; font-weight: bolder;"><?= $_SESSION['error_message']; ?></span>
                <?php unset($_SESSION['error_message']); endif; ?>
                <?php if(isset($_SESSION['success_message'])): ?>
                <span class="alert alert-success" style="font-family: tahoma, sans-serif; font-weight: bolder;"><?= $_SESSION['success_message']; ?></span>
                <?php unset($_SESSION['success_message']); endif; ?>
                
                <h3>Add or Update Layout</h3>
                <form class="form-vertical" action="php/layoutProcess.php" method="post" id="layout_form">
                    <div class="form-group">
                        <input class="form-control" placeholder="Layout For Page?" name="forPage" id="for_page_input"/>
                        <div class="help-block" id="show_layout_pages">
                            <b>Available Layouts</b>
                            <ul id="available_layouts_list">
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