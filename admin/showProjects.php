<?php
$setProjectsActive = "active";
require_once 'php/DBConnect.php';
$db = new DBConnect();
$projects = $db->fetchAllProjects();

include 'layout/_header.php';

?>

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

<script>
$(document).ready(function(){
	$("body").on("click", "#project_delete", function(event){
		event.preventDefault();
		var url = $(this).attr("href");
		var parentPanel = $(this).parent().parent();

		$.ajax({
			type : "GET",
			url : url,
			success: function(data){
					$(parentPanel).remove();
					$("#danger_div").html(data);
			},
			error : function(xhr,status,message){
					alert(xhr.responseText);
			}
		});
	});
});
</script>

<?php include 'layout/_footer.php'; ?>