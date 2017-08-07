<?php
      require('../header.php');
      require('../config/config.php');
      require('../lib/secure.php');
      require('../lib/functions.php');
      require('../lib/notification.php');

      $account_connect   = new Connect();
      $account_functions = new Functions();

      $sql  = "SELECT `email`, `account_count`, `last_ip` ";
      $sql .= "FROM users ";
      $sql .= "WHERE username = '$logged'";

      $result = mysqli_query($account_connect->connect(), $sql);
      while ($row = mysqli_fetch_assoc($result)) {

        $email = $row['email'];
        $account_count = $row['account_count'];
        $ip = $row['last_ip'];

    }

?>
<body>
 <div class="account-container">
   <ul class="nav nav-tabs">
    <li><a href="main.php">Home</a></li>
    <li><a href="bug_review.php">Bug Review</a></li>
    <li><a href="view_deleted.php">Deleted Bugs</a></li>
    <li><a href="users.php">User Accounts</a></li>
    <li class="active"><a href="account.php">Account Settings</a></li>
    <li><a href="../logout.php">Logout</a></li>
    <li id="welcome-name"><a href="account.php">Welcome, <?php echo $_SESSION['username'];?>!</a></li>
   </ul>
   <div class="panel panel-info">
 <div class="panel-heading"><h6>Account Settings</h6></div>
 </div>
 <div class="account-menu-form">
   <div class="btn-group btn-group-justified">
     <a onclick="reveal(4)" class="btn btn-default">Change Password</a>
     <a onclick="reveal(11)" class="btn btn-default">Change Email</a>
     <a onclick="reveal(12)" class="btn btn-default">Reset Account Count</a>
     <a onclick="reveal(14)" class="btn btn-danger">Delete My Account</a>
   </div>
 </div>
 <div class="account-information-tables">
   <ul class="list-group">
     <li class="list-group-item"><b>Account Username:</b> <?php echo $logged; ?></li>
     <li class="list-group-item"><b>Email:</b> <?php echo $email; ?></li>
     <li class="list-group-item"><b>Account Login Count:</b> <?php echo $account_count; ?></li>
     <li class="list-group-item"><b>Last Login IP Address:</b> <?php echo $ip; ?></li>
     <li class="list-group-item"><b>Bugs Reported:</b> <?php echo $account_functions->getReported(1); ?></li>
     <li class="list-group-item"><b>Bugs Deleted:</b> <?php echo $account_functions->getReported(2); ?></li>
   </ul>
 </div>
 <div class="change-password-form">
   <form action="account.php" method="POST">
     <p>
       Enter your password.
     </p>
     <input type="password" name="password" /><br />
     <p>
       Enter your new password.
     </p>
     <input type="password" name="password_new1" /><br />
     <p>
       Confirm your new password.
     </p>
     <input type="password" name="password_new2" /><br />
     <button type="submit" name="submit_newpassword" class="btn btn-primary">Submit</button>
     <button type="button" name="cancel" class="btn btn-primary" onclick="reveal(10)">Cancel</button>
   </div>
   </form>
   <div class="change-email-form">
     <form action="account.php" method="POST">
       <p id="larger">
         Your Email is currently: <?php echo $email; ?>
       </p><br />
       <p>
         Enter your desired new email.
       </p>
       <input type="email" name="new_email" /><br />
       <button type="submit" name="submit_newemail" class="btn btn-primary">Submit</button>
       <button type="button" class="btn btn-primary" onclick="reveal(13)">Cancel</button>
     </form>
   </div>
   <div class="reset-login-count">
     <p id="larger">
        Your current login count is: <?php echo $account_count; ?>
     </p><br />
     <p>
       Click submit to reset your Login Count to 0.
     </p>
     <form action="account.php" method="POST">
     <button type="submit" name="submit_count" class="btn btn-primary">Submit</button>
     <button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
   </form>
   </div>
 </div>
 <div class="delete-account-form">
   <hr />
   <p id="larger">Enter your E-mail to Delete Your Account:</p><br />
   <form action="account.php" method="POST">
     <input type="text" name="delete_account_email"/><br />
     <button type="submit" class="btn btn-danger" name="submit_delete">Delete</button>
   </form>
 </div>
  <script type='text/javascript' src='../js/notification.js'></script>
  <script type='text/javascript' src='../js/forms.js'></script>
</body>

<?php

if (isset($_POST['submit_newpassword'])) {

  $password      = trims(mysqli_escape_string($account_connect->connect(),$_POST['password']));
  $password_new1 = trims(mysqli_escape_string($account_connect->connect(),$_POST['password_new1']));
  $password_new2 = trims(mysqli_escape_string($account_connect->connect(),$_POST['password_new2']));

  if (empty($password) or (empty($password_new1)) or (empty($password_new2))) {

    echo "Nothing was entered!";
    echo '<script type="text/javascript">
          display_input_message(20);
          </script>';


  } else if ($password_new1 != $password_new2) {

      echo "New Passwords do not match!";
      echo '<script type="text/javascript">
            display_input_message(20);
            </script>';
  }

  else {

      $sql = "SELECT * FROM users WHERE username = '{$_SESSION['username']}' AND password = '$password";
      mysqli_query($account_connect->connect(), $sql);

      $rows = mysqli_num_rows($result);

      if ($rows == 1) {

          $password_new1 = md5($password_new1);
          $sql_pass = "UPDATE users SET password = '$password_new1' WHERE username = '{$_SESSION['username']}'";
          $result = mysqli_query($account_connect->connect(), $sql_pass);

          if ($result) {
            echo '<script type="text/javascript">
                  display_input_message(8);
                  </script>';

          }

     }

  }

}

  if (isset($_POST['submit_newemail'])) {


    if(empty($_POST['new_email'])) {

      echo '<script type="text/javascript">
            display_input_message(20);
            </script>';

    } else if (!filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL)) {

      echo '<script type="text/javascript">
            display_input_message(20);
            </script>';
    }

    else {

            $new_email = email_clean($_POST['new_email']);

            $sql_email = "UPDATE users SET email = '$new_email' WHERE username = '{$_SESSION['username']}'";
            mysqli_query($account_connect->connect(), $sql_email);
            echo '<script type="text/javascript">
                  display_input_message(9);
                  </script>';


        }

  }

  if (isset($_POST['submit_count'])) {

    $sql_count = "UPDATE users SET account_count = 0 WHERE username = '{$_SESSION['username']}'";
    mysqli_query($account_connect->connect(), $sql_count);

    echo '<script type="text/javascript">
          display_input_message(21);
          </script>';

  }

  if(isset($_POST['submit_delete'])) {

    $email_input = trims($_POST['delete_account_email']);
    $email_input = mysqli_escape_string($account_connect->connect(), $email_input);

    $sql_email_verify = "SELECT username FROM users WHERE email = '$email_input' ";

    $result = mysqli_query($account_connect->connect(), $sql_email_verify);
    $row = mysqli_fetch_row($result);

    $current_User = $_SESSION['username'];

    if ($row[0] == $current_User) {

      $sql_delete_account = "DELETE FROM users WHERE username = '$current_User' ";

      $result = mysqli_query($account_connect->connect(), $sql_delete_account);

        if ($result) {

          mysqli_close($account_connect->connect());
          header("Location: ../index.php?deleteaccount=1");

        }

    } else {

      echo '<script type="text/javascript">
            display_input_message(20);
            </script>';
    }


  }

$account_functions = new Functions();
 ?>
