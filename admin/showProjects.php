<?php
$setProjectsActive = "active";
require_once 'php/DBConnect.php';
$db = new DBConnect();
$projects = $db->fetchAllProjects();

// scripts is the array defined in the header which goes through all the links mentioned in the array and connects it to the src
$scripts = ["https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js", "../admin/js/myjs.js"];

include 'layout/_header.php';

?>
<script>

</script>

<div class="container">
	<?php include 'layout/_top_nav.php'; ?>
	<div class="row first-row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="alert-danger" id="danger_div"></div>
			<section class="show-projects">
				<div class="clear"></div>
			<?php foreach ($projects as $key => $row): ?>
				<div class="panel-default" id="parent_panel">
					<div class="panel-heading">
						<div class="pull-right">
							<span class="glyphicon glyphicon-calender"><?= $row['created_at']; ?></span>
						</div>
						<?= $row['title']; ?>
					</div>
					<div class="panel-body">
						<?= $row['description']; ?>
					</div>
					<div class="panel-footer">
						<a href="editProject.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
						<a href="deleteProject.php?id=<?= $row['id']; ?>" id="project_delete" class="btn btn-danger btn-sm">Delete</a>
					</div>
				</div>
				<div class="clear"></div>
			<?php endforeach; ?>
		</section>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>



<?php include 'layout/_footer.php'; ?>