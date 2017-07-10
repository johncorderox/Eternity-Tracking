
<?php

  require('../config/config.php');
  require('../lib/functions.php');
  require('../lib/notification.php');

  $main              = new Functions();
  $main_connect      = new Connect();
  $main_notification = new Notification();

  $main_notification->redirects();

?>

<html lang="en">
<?php  include("../header.php"); ?>

  <body>
    <ul class="nav nav-tabs">
     <li class="active"><a href="main.php">Home</a></li>
     <li><a href="bugs.php">Bug Review</a></li>
     <li><a href="view_deleted.php">Deleted Bugs</a></li>
     <li><a href="">User Accounts</a></li>
     <li><a href="#">Advanced Search</a></li>
     <li><a href="account.php">Account Settings</a></li>
     <li><a href="#">Logout</a></li>
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

    <?php require ('../logs/logs.php'); ?>

    <!-- module under backend





    -->

            <!--
        <br />
        <div class="list-group">
          <a href="#" class="list-group-item active"> <span class="glyphicon glyphicon-list"></span>Backend Information </a>
          <a href="#" class="list-group-item"><b>Host Name:</b> <?php echo $main_connect->getServer(); ?></a>
          <a href="#" class="list-group-item"><b>Database name:</b> <?php echo $main_connect->getDatabase(); ?></a>
          <a href="#" class="list-group-item"><b>PHP Info:</b> <?php echo phpversion(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Vers:</b> <?php echo mysqli_get_server_version($main_connect->connect()); ?></a>
        </div><br />
        <div class="list-group">
          <a class="list-group-item list-group-item-danger"><p id="danger-dark"><span class="glyphicon glyphicon-cog"></span>Admin Section</p></a>
          <a href="account.php" class="list-group-item" id="pointer">Account Settings </a>
          <a href="delete_all.php" class="list-group-item" id="pointer">Delete All Bugs</a>
          <a href="../logout.php" class="list-group-item" id="pointer">Logout</a>
        </div>
      </div>



        <div class="panel panel-default">
          <div class="panel-body">
            <div class="welcome_notes">
            <p>
              Welcome! <br />
              You are currently logged in as: <a href="account.php"><u><?php echo $logged; ?></u></a>
              <?php $main->getLastBug() ?>
            </p>
            </div>
          </div>
      </div>
        <form action="search.php" method="POST">
          <input type="text" name="search" placeholder="Search Database" autofocus/>
          <button type="submit" name="submit_search" id="add-button">Submit</button>
        </form>
        <hr />
        </div>
      </div> -->
  </body>
  <script type='text/javascript' src='../js/notification.js'></script>
  <script type='text/javascript' src='../js/forms.js'></script>

</html>
<?php
$main_notification->notifications();
 ?>
