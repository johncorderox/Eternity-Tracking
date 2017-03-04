
<?php

  include('config.php');
  include('connect.php');
  include('functions.php');

  if(isset($_GET['add'])) {

    header("location: add_main.php");
  }

  else if(isset($_GET['delete'])) {

    header("location: delete_main.php");
  }

  else if(isset($_GET['add_new'])) {

      header("location: add_new_main.php");
    }

    else if(isset($_GET['remove_user'])) {

        header("location: remove_user_main.php?");
      }


?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="src/css/interface.css" rel="stylesheet" />
  </head>
  <body>
    <div class="header-name">
  <a href="main.php"><h3>Eternity Tracking</h3></a><br />
    </div><br />
      <div class="leftside-info">
        <div class="list-group">
          <a href="#" class="list-group-item active">Main Information</a>
          <a href="#" class="list-group-item"><b>Number of Bugs:</b> <?php num_of_bugs(); ?></a>
          <a href="#" class="list-group-item"><b>Number of User Accounts:</b> <?php num_of_accounts(); ?></a>
          <a href="#" class="list-group-item"><b>Host Name:</b> <?php echo $servername; ?></a>
          <a href="#" class="list-group-item"><b>Database name:</b> <?php echo $database; ?></a>
        </div>
        <br />
        <div class="list-group">
          <a href="#" class="list-group-item active">Backend Information</a>
          <a href="#" class="list-group-item"><b>PHP Info:</b> <?php echo phpversion(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Server Status:</b><?php check_mysql_server_status(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Vers:</b> <?php echo mysqli_get_server_version($connect); ?></a>
        </div><br />
        <div class="list-group">
          <a class="list-group-item list-group-item-danger"><p id="danger-dark">Admin Section</p></a>
          <a href="#" class="list-group-item">Delete All Bugs</a>
        </div>
      </div>
      <div class="ui-main">
        <div class="ui-main-button-group">
        <form action="main.php" action="GET">
        <button name="add">Add Bug</button>
          <button name="delete">Delete Bug</button>
          <button name="add_new">Add New User</button>
          <button name="remove_user">Remove User</button>
          </form>
        <hr />

        </div>
  </body>
  <script type='text/javascript' src='src/js/view.js'></script>
</html>
