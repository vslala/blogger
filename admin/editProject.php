<?php 
session_start();
if(isset($_GET['id']))
	$_SESSION['projectID'] = $_GET['id'];

$setProjectsActive = "active";
require_once 'php/DBConnect.php';
$db = new DBConnect();

if(isset($_POST['projectSubmitBtn'])){
	$id = $_SESSION['projectID'];
	$title = $_POST['projectTitle'];
	$link = $_POST['projectLink'];
	$description = $_POST['projectDescription'];

	$flag = $db->editProject($title,$link,$description, $id);
}
$project = $db->fetchProjectById($_SESSION['projectID']);

include 'layout/_header.php';
?>

<div class="container">
	<?php include 'layout/_top_nav.php'; ?>
	<div class="row first-row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php if(isset($flag)): ?>
				<div class="alert-success">Your Project has been updated successfully!!!</div>
			<?php endif; ?>
			<div class="project-form">
				<?php if(isset($message)): ?>
					<div class="alert-info"><strong><?= $message; ?></strong></div>
				<?php endif; ?>
				<form class="form-horizontal" id="project_form" method="post" action="editProject.php">
					<input type="hidden" value="<?= $project[0]['id']; ?>" name="id" />
					<div class="form-group">
						<label class="col-md-4 form-label">Project Title: </label>
						<div class="col-md-8">
							<input type="text" value="<?= $project[0]['title'];  ?>" name="projectTitle" id="project_title" placeholder="Name of the project" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 form-label">Project Link: </label>
						<div class="col-md-8">
							<input type="text" value="<?= $project[0]['link'];  ?>" name="projectLink" id="project_link" placeholder="Link for the project" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 form-label">Project Description: </label>
						<div class="col-md-8">
							<textarea name="projectDescription" maxlength="3000" id="project_description" rows="10" cols="20" class="form-control"><?= $project[0]['description'];  ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 form-label"></label>
						<div class="col-md-8">
							<input type="submit" name="projectSubmitBtn" class="btn btn-primary" id="project_submit_btn" value="Submit" />
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