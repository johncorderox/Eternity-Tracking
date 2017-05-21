
<?php

  include('../config/config.php');
  include('../lib/functions.php');

  if(isset($_GET['add'])) {

    header("location: add_main.php");
    exit();
  }

  else if(isset($_GET['delete'])) {

    header("location: delete_main.php");
    exit();
  }

  else if(isset($_GET['add_new'])) {

      header("location: add_new_main.php");
      exit();
    }

    else if(isset($_GET['remove_user'])) {

        header("location: remove_user_main.php");
        exit();
      }

?>

<html lang="en">
<?php  include("../header.php"); ?>
  <body>
      <div class="leftside-info">
        <div class="list-group">
          <div class="main-info">
            <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-inbox"></span>Main Information</a>
            <a href="#" class="list-group-item"><b>Company Name:</b> <?php echo $company_name; ?></a>
            <a href="#" class="list-group-item"><b>Number of Bugs:</b> <?php num_of_bugs(); ?></a>
            <a href="#" class="list-group-item"><b>Number of User Accounts:</b> <?php num_of_accounts(); ?></a>
            <a href="#" class="list-group-item"><b>Deleted Bugs</b>: <?php num_of_deleted(); ?> </a>
            <a href="account_requests.php" class="list-group-item"><b>Account Requests</b>: <?php getRequest(); ?> </a>
          </div>
          </div>
        <br />
        <div class="list-group">
          <a href="#" class="list-group-item active"> <span class="glyphicon glyphicon-list"></span>Backend Information </a>
          <a href="#" class="list-group-item"><b>Host Name:</b> <?php echo $servername; ?></a>
          <a href="#" class="list-group-item"><b>Database name:</b> <?php echo $database; ?></a>
          <a href="#" class="list-group-item"><b>PHP Info:</b> <?php echo phpversion(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Server Status:</b><?php check_mysql_server_status(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Vers:</b> <?php echo mysqli_get_server_version($connect); ?></a>
        </div><br />
        <div class="list-group">
          <a class="list-group-item list-group-item-danger"><p id="danger-dark"><span class="glyphicon glyphicon-cog"></span>Admin Section</p></a>
          <a href="account.php" class="list-group-item" id="pointer">Account Settings </a>
          <a href="delete_all.php" class="list-group-item" id="pointer">Delete All Bugs</a>
          <a href="../logout.php" class="list-group-item" id="pointer">Logout</a>
        </div>
      </div>
      <?php include ('../logs/logs.php'); ?>
      <div class="ui-main">
        <div class="ui-main-button-group">
        <form action="main.php" action="GET">
          <button name="add">Add Bug</button>
          <button name="delete">Delete Bug</button>
          <button name="add_new">Add New User</button>
          <button name="remove_user">Remove User</button>
        </form><br />
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="welcome_notes">
            <p>
              Welcome! <br />
              You are currently logged in as: <a href="account.php"><u><?php echo $logged; ?></u></a>
              <?php getLastBug(); ?>
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
      </div>
    <?php include ("../tables/buglist.php"); ?>
  </body>
  <script type='text/javascript' src='../js/view.js'></script>
  <script type='text/javascript' src='../js/forms.js'></script>
</html>

<?php

if (isset($_GET['successbug']) && $_GET['successbug']=='1') {

  echo '<script type="text/javascript">
        display_input_message(0);
        </script>';

}

if (isset($_GET['deletebug']) && $_GET['deletebug']=='1') {

  echo '<script type="text/javascript">
        display_input_message(1);
        </script>';

}

if (isset($_GET['login']) && $_GET['login']=='1') {

  echo '<script type="text/javascript">
        display_input_message(2);
        </script>';

}

if (isset($_GET['removeuser']) && $_GET['removeuser']=='1') {

  echo '<script type="text/javascript">
        display_input_message(4);
        </script>';

}

if (isset($_GET['newuser']) && $_GET['newuser']=='1') {

  echo '<script type="text/javascript">
        display_input_message(6);
        </script>';

}

if (isset($_GET['savebug']) && $_GET['savebug']=='1') {

  echo '<script type="text/javascript">
        display_input_message(0);
        </script>';

}
if (isset($_GET['accept']) && $_GET['accept']=='1') {

  echo '<script type="text/javascript">
        display_input_message(6);
        </script>';

}



 ?>
