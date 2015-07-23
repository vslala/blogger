<?php

$count = 0;
if(isset($_GET['count']))
{
    $count = $_GET['count'];
}
$title="Home";
$setHomeActive = 'active';
$cover_image_url = 'img/home-bg.jpg';
$cover_heading = "Varun Shrivastava";
$cover_subheading = "(Web Developer, Graphics Designer, Motivational Speaker)";

include 'layout/_header.php';
include 'layout/_top_nav.php';

require_once 'admin/php/DBConnect.php';
$db = new DBConnect();

//take layout variable and include layout.php file which will work as inline function
$layout = $db->getLayout('home');
include 'functions/layout.php';

$addCount = intval($count) + 5;
$blogs = $db->fetchAllBlogsLimit($count, $addCount);
$count = $addCount;
?>



<!-- Page Header -->
<?php include 'layout/_cover_image.php'; ?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php if (isset($blogs)): ?>
                <?php foreach ($blogs as $b): ?>
                    <div class="post-preview">
                        <a href="post.php?id=<?= $b['id']; ?>&blog=<?php echo str_replace(' ', '-',$b['heading']); ?>">
                            <h2 class="post-title">
                                <?= $b['heading']; ?>
                            </h2>
                            <h3 class="post-subtitle">
                                <?php echo substr($b['content'], 0, 200); ?> 
                            </h3>
                        </a>
                        <p class="post-meta">Posted by <a href="#">Varun Shrivastava</a> on <?= $b['created_at']; ?></p>
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <hr>
            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="index.php?count=<?php if(isset($count)){ echo $count; } else { echo 0; } ?>">Older Posts &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<hr>


<?php include 'layout/_footer.php'; ?>