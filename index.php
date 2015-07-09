<?php
$scripts = ["css/clean-blog.min.css"];
$count = 0;
if(isset($_GET['count']))
{
    $count = $_GET['count'];
}
$title="Home";
include 'layout/_header.php';
include 'layout/_top_nav.php';

require_once 'admin/php/DBConnect.php';
$db = new DBConnect();
$addCount = intval($count) + 5;
$blogs = $db->fetchAllBlogsLimit($count, $addCount);
$count = $addCount;
?>



<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('img/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <hr class="small">
                    <span class="subheading">A Blogger App By VS Productions</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php if (isset($blogs)): ?>
                <?php foreach ($blogs as $b): ?>
                    <div class="post-preview">
                        <a href="post.php?id=<?= $b['id']; ?>&blog=<?= $b['heading']; ?>">
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