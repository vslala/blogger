<?php
$title="home"; $setHomeActive="active";
include 'auth/checkAuth.php';
include 'layout/_header.php';

require 'php/DBConnect.php';
$db = new DBConnect();
$blogs = $db->fetchAllBlogs();
$notifications = $db->getNotification();
$totalNotifications = count($notifications);

?>

<div class="container">
    <?php    include 'layout/_top_nav.php'; ?>
    
    <div class="row first-row">
        <div class="col-md-12">
            <?php if(isset($blogs)): ?>
                <?php foreach($blogs as $b): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label><?= $b['heading']; ?></label>
                    <div class="deleteLink pull-right small">
                        <a href="delete.php?id=<?= $b['id']; ?>" class="btn btn-danger btn-sm">delete </a> 
                    </div> 
                    <div class="editLink pull-right small">
                        <a href="edit.php?id=<?= $b['id']; ?>&heading=<?= $b['heading']; ?>" class="btn btn-warning btn-sm">edit</a> &nbsp; | &nbsp;
                    </div>                 
                    <div class="help-block small">Created At: <?= $b['created_at']; ?></div>
 
                </div>
            </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
</div>

<?php
include 'layout/_footer.php';
?>
