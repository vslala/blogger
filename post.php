<?php
$id = $_GET['id'];
require_once 'admin/php/DBConnect.php';
$db = new DBConnect();
$blog = $db->getBlogById($id);
$comments = $db->getCommentsByBlogID($id);
$db->deleteNotificationByBlogID($id);
$title = $blog[0]['heading'];
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

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <section id="comment_section">
        <?php if(isset($comments[0])): ?>
        <!-- Comments will be shown here -->
        <?php foreach($comments as $c): ?>
        <div class="form-group comment-group">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 username-text"><u><?= $c['username']; ?></u></div>
                    <div class="col-md-10 help-block"><span class="time">created at: <?= $c['created_at']; ?> </span></div>
                </div>
                <div class="row">
                    <div class="col-md-6 comment-text"><?= $c['comment']; ?></div>
                </div>
            </div>
        </div>
        <hr>
        <?php        endforeach; endif; ?>
        </section>
        <form class="form" method="post" action="postAjax.php" id="comment_form">
            <input type="hidden" value="<?= $blog[0]['id']; ?>" name="blogID" />
            <div class="panel panel-default">
                <div class="panel-heading">
                    Please share your views below...
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="text" placeholder="Name" id="username" name="username" required="true" class="form-control" />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="4" id="comment_box" name="comment" required="true" minlength="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary" name="submitComment" type="submit" >Comment</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-3"></div>
</div>

<hr>
<?php include 'layout/_footer.php'; ?>