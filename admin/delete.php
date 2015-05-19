<?php
$base_url = "http://varunshrivastava.azurewebsites.net/";
$title = "Delete Blog";

if (isset($_POST['yesBtn'])) {
    require 'php/DBConnect.php';
    $db = new DBConnect();
    $id = $_POST['blogId'];
    $flag = $db->deleteBlog($id);

    if ($flag)
        header("Location: $base_url"."admin/adminHome.php");
}

include 'auth/checkAuth.php';
include 'layout/_header.php';
?>
<div class="container">
    <?php include 'layout/_top_nav.php'; ?>

    <div class="row first-row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="h2 center-align">
                        Are You sure you want to delete this blog!
                    </div>
                </div>
                <div class='panel-body '>
                    <center>
                        <form action="delete.php" class="form-inline" method="POST">
                            <input type='hidden' value="<?= $_GET['id']; ?>" name="blogId" />
                            <button class="btn btn-danger btn-sm" name="yesBtn"> YES </button>
                            <button class="btn btn-success btn-sm" name="noBtn"> NO </button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<?php include 'layout/_footer.php'; ?>
