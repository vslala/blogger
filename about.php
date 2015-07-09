<?php 

$title = "About";
$bgImageUrl = null;
include 'layout/_header.php';
include 'layout/_top_nav.php';
$i=0;
require_once 'admin/php/DBConnect.php';
$db = new DBConnect();
$about = $db->selectAllFromAbout();
$projects = $db->fetchAllProjects();
?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url(<?php if(isset($bgImageUrl)){echo $bgImageUrl;}else{ echo 'img/about-bg.jpg'; }?>)">
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
    <!--<div class="container">-->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php if(isset($about[0])): ?>
                    <?= $about[0]['about_me']; ?>
                <?php endif; ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <button data-toggle="modal" data-target="#my_project_modal" class="btn btn-default">My Projects</button>
                <!--<a href="#" class="btn btn-default">Resume</a>
                <a href="#" class="btn btn-default">My Websites</a>-->
            </div>
        </div>



        <div id="my_project_modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

    <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">My Projects</h4>
                    </div>
                <div class="modal-body" id="scroll_bar">
                    <?php foreach ($projects as $key => $value): $i++;?>                    
                    <ul class="nav nav-stacked project-nav <?php if($i%2==0){echo 'bg-danger'; } else{ echo 'bg-info'; } ?>" >
                        <li>
                            <span class="help-block pull-right" style="font-size: xx-small;"><?= $value['created_at']; ?></span>                       
                            <strong><a href="<?= $value['link']; ?>" style="color: blue;"><?= $value['title']; ?></a></strong>
                        </li>
                        <li><div class="pDescription"><?= $value['description']; ?></div></li>
                    </ul>
                    <div class="clear-fix"></div>
                <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
</div>
    <!--</div>-->

    <hr>

    <?php include 'layout/_footer.php'; ?>