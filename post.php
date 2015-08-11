<?php
$uri = $_SERVER['REQUEST_URI'];
session_start();

$id = $_GET['id'];

require_once 'admin/php/DBConnect.php';
$db = new DBConnect();

if(!isset($_SESSION['username']))
    $db->incrementBlogCount($id);

$blog = $db->getBlogById($id);
$comments = $db->getCommentsByBlogID($id);
$db->deleteNotificationByBlogID($id);

$title = $blog[0]['heading'];
$cover_image_url = 'img/post-bg.jpg';
$cover_heading = $blog[0]['heading'];
$cover_subheading = "Posted by <a href='#'>Varun Shrivastava</a> ".$blog[0]['created_at'];
if(isset($blog[0]['cover_image']) && $blog[0]['cover_image'] !== ''){
    $cover_image_url = $blog[0]['cover_image'];
}
include 'layout/_header.php';
include 'layout/_top_nav.php';
?>

<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<?php include 'layout/_post_cover.php'; ?>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?= $blog[0]['content']; ?>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="pull-left box">Total Blog Views: <?= $blog[0]['views']; ?></div>
                <div class="pull-left box">
                    <div class="fb-like" 
                         data-href="http://varunshrivastava.azurewebsites.net<?= $uri; ?>" 
                         data-layout="standard" 
                         data-action="like" 
                         data-show-faces="true" 
                         data-share="true">
                    </div>
                    <g:plusone></g:plusone>
                    <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/+Varunshrivastava007" data-rel="author"></div>
                </div>
            </div>
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="pull-left box">
                    <div class="fb-comments" data-href="http://varunshrivastava.azurewebsites.net<?= $uri; ?>" data-numposts="5"></div>
                    
                </div>
            </div>
            
        </div>
        <hr>
    </div>
    
</article>

<!--<hr>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="fb-comments" data-href="http://varunshrivastava.azurewebsites.net<?= $uri; ?>" data-numposts="5"></div>
    </div>
    <div class="col-md-3"></div>

</div>-->

<!--<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <section id="comment_section">
        <?php if(isset($comments[0])): ?>
         Comments will be shown here 
        <?php foreach($comments as $c): ?>
        <div class="form-group comment-group">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 username-text"><u><?= $c['username']; ?></u></div>
                    <div class="col-md-10 help-block"><span class="time">created at: <?= $c['created_at']; ?> </span></div>
                </div>
                <div class="row">
                    <div class="col-md-6 comment-text"><?= $c['comment']; ?></div>
                    <?php if(isset($_SESSION['username'])): ?>
                    <span class="time"><a href="deleteAjax.php?id=<?= $c['id']; ?>&delete=1" id="deleteComment">delete</a></span>
                    <?php endif; ?>
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
                        <input type="text" placeholder="Name" id="username" name="username" required="true" class="form-control" minlength="3"/>
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
</div>-->

<hr>
<?php include 'layout/_footer.php'; ?>