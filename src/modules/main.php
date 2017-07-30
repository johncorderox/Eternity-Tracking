
<?php

  require('../config/config.php');
  require('../lib/functions.php');
  require('../lib/notification.php');
  require("../header.php");

  $main              = new Functions();
  $main_connect      = new Connect();
  $main_notification = new Notification();

?>
<html lang="en">
  <body>
    <ul class="nav nav-tabs">
     <li class="active"><a href="main.php">Home</a></li>
     <li><a href="bug_review.php">Bug Review</a></li>
     <li><a href="view_deleted.php">Deleted Bugs</a></li>
     <li><a href="users.php">User Accounts</a></li>
     <li><a href="account.php">Account Settings</a></li>
     <li><a href="../logout.php">Logout</a></li>
     <li id="welcome-name"><a href="account.php">Welcome, <?php echo $_SESSION['username'];?>!</a></li>
    </ul>
    <div class="container-fluid">
      <div class="main-information">
        <div class="list-group">
          <div class="main-info">
            <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-inbox"></span>Main Information</a>
            <a href="#" class="list-group-item"><b>Company Name:</b> <?php echo $config['$company_name']; ?></a>
            <a href="#" class="list-group-item"><b>Number of Bugs:</b> <?php $main->num_of_items(0); ?></a>
            <a href="#" class="list-group-item"><b>Number of User Accounts:</b> <?php $main->num_of_items(1); ?></a>
            <a href="view_deleted.php" class="list-group-item"><b>Deleted Bugs</b>: <?php $main->num_of_items(2); ?> </a>
          </div>
        </div>
      </div>
      <div class="backend-information">
        <div class="list-group">
          <a href="#" class="list-group-item active"> <span class="glyphicon glyphicon-list"></span>Backend Information </a>
          <a href="#" class="list-group-item"><b>Host Name:</b> <?php echo $main_connect->getServer(); ?></a>
          <a href="#" class="list-group-item"><b>Database name:</b> <?php echo $main_connect->getDatabase(); ?></a>
          <a href="#" class="list-group-item"><b>PHP Info:</b> <?php echo phpversion(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Vers:</b> <?php echo mysqli_get_server_version($main_connect->connect()); ?></a>
        </div><br />
      </div>
    </div>
    <script type='text/javascript' src='../js/notification.js'></script>
    <script type='text/javascript' src='../js/forms.js'></script>
  </body>

<?php
require ('../logs/logs.php');
  $main_notification->notifications();
 ?>
