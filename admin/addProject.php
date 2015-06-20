<?php
$setProjectsActive = "active";
$message = NULL;
if(isset($_POST['submitBtn'])){
	$title = $_POST['projectTitle'];
	$link = $_POST['projectLink'];
	$description = $_POST['projectDescription'];

	require_once 'php/DBConnect.php';
	$db = new DBConnect();

	$flag = $db->addProject($title, $link, $description);
	$message = "The project has been submitted successfully!!";
}

include 'layout/_header.php';

?>

<div class="container">
	<?php include 'layout/_top_nav.php'; ?>
	<div class="row first-row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="project-form">
				<?php if(isset($message)): ?>
					<div class="alert-info"><strong><?= $message; ?></strong></div>
				<?php endif; ?>
				<form class="form-horizontal" id="project_form" method="post" action="addProject.php">
					<div class="form-group">
						<label class="col-md-4 form-label">Project Title: </label>
						<div class="col-md-8">
							<input type="text" name="projectTitle" id="project_title" placeholder="Name of the project" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 form-label">Project Link: </label>
						<div class="col-md-8">
							<input type="text" name="projectLink" id="project_link" placeholder="Link for the project" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 form-label">Project Description: </label>
						<div class="col-md-8">
							<textarea name="projectDescription" maxlength="3000" id="project_description" rows="10" cols="20" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 form-label"></label>
						<div class="col-md-8">
							<button name="submitBtn" class="btn btn-primary" id="project_submit_btn" type="submit">Submit</button>
							<a href="showProjects.php" class="btn btn-info btn-small">show all projects</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>

<?php include 'layout/_footer.php'; ?>

