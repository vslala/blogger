<?php 
$title = "About";
include 'layout/_header.php';
include 'layout/_top_nav.php';

require_once 'admin/php/DBConnect.php';
$db = new DBConnect();
$about = $db->selectAllFromAbout();

?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/about-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>About Me</h1>
                        <hr class="small">
                        <span class="subheading">This is what I do.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php if(isset($about[0])): ?>
                    <?= $about[0]['about_me']; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr>

    <?php include 'layout/_footer.php'; ?>