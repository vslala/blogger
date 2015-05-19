<?php
$title="notifications"; $setNotificationActive="active";
include 'auth/checkAuth.php';
include 'layout/_header.php';

require 'php/DBConnect.php';
$db = new DBConnect();
$blogs = $db->fetchAllBlogs();
$notifications = $db->getNotification();


?>

<div class="container">
    <?php    include 'layout/_top_nav.php'; ?>
    
    <div class="row first-row">
        <?php foreach($notifications as $n): ?>
        <ul class="nav navbar-brand">
            <li>
                <a href="/blogger/post.php?id=<?= $n['blog_id']; ?>" id="notified"><?= $n['id'].". ".$n['username']; ?> commented on this thread.
                    <span class="help-block"><?= $n['created_at']; ?></span>
                </a>
            </li>
        </ul>
        <?php endforeach; ?>
    </div>
    
</div>
