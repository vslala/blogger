<?php 
$id = $_GET['id'];
require_once 'admin/php/DBConnect.php';
$db = new DBConnect();
$blog = $db->getBlogById($id);

include 'layout/_header.php';
include 'layout/_top_nav.php';

?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/post-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1><?= $blog[0]['heading']; ?></h1>
                        <span class="meta">Posted by <a href="#">Varun Shrivastava</a> <?= $blog[0]['created_at']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?= $blog[0]['content']; ?>
                </div>
            </div>
        </div>
    </article>

    <hr>

    <?php include 'layout/_footer.php'; ?>