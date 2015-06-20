<?php
require_once 'php/Values.php';
$values = new Values();
$admin_home = $values->getAdminHomeUrl();

session_start();
if(isset($_SESSION['username']))
{
    header("Location: ".$admin_home);
}
if(isset($_POST['loginBtn']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    if($username == "vs_lala"){
        if($password == "ucanthackitbuddy")
        {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: ".$admin_home);
        }
    }
}

$title = "Admin Login";
    include 'layout/_header.php';    
?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="h2">Admin Login</div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="index.php">
                        <div class="form-group">
                            <label class="form-label col-md-4">Username:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="username" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label col-md-4">Password:</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label col-md-4"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit" name="loginBtn">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php 
include 'layout/_footer.php';
?>