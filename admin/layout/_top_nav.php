
<nav class="nav navbar navbar-fixed-top">
    <ul class="nav nav-pills pull-right">
        <li class="<?php echo $setHomeActive; ?>"><a href="adminHome.php">Home</a></li>
        <li class="<?php echo $setAboutActive; ?>"><a href="about.php">About</a></li>
        <li class="<?php echo $setComposeActive; ?>"><a href="compose.php">Compose</a></li>
        <li class="<?php echo $setNotificationActive; ?>">
            <a href="notification.php">Notification<div class="badge"><?php if(isset($totalNotifications)){echo $totalNotifications;}else{echo '';} ?></div></a>  
        </li> 
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>