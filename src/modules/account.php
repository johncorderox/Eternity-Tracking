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
  <ul class="nav nav-tabs">
   <li><a href="main.php">Home</a></li>
   <li><a href="bug_review.php">Bug Review</a></li>
   <li><a href="view_deleted.php">Deleted Bugs</a></li>
   <li><a href="users.php">User Accounts</a></li>
   <li class="active"><a href="account.php">Account Settings</a></li>
   <li><a href="../logout.php">Logout</a></li>
  </ul>
  <div class="panel panel-info">
<div class="panel-heading"><h6>Account Settings</h6></div>
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


<!--
   <div class="account_info">


     <br />
     <br />
     <form action="account.php" method="POST">
       <button type="submit" name="delete_account">Delete My Account</button>
     </form>
   </div>
   <div class="changePassword">
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
       <button type="submit" name="submit_newpass" id="add-button">Submit</button>
       <button type="submit" name="cancel">Cancel</button>
     </form>
   </div>
   <div class="changeEmail">
     <form action="account.php" method="POST">
       <p id="larger">
         Your Email is currently: <?php echo $email; ?>
       </p><br />
       <p>
         Enter your desired new email.
       </p>
       <input type="email" name="new_email" /><br />
       <button type="submit" name="submit_newemail" id="add-button">Submit</button>
       <button type="submit" name="cancel">Cancel</button>
     </form>
   </div>
   <div class="resetLoginCount">
     <p id="larger">
        Your current login count is: <?php echo $account_count; ?>
     </p><br />
     <p>
       Click submit to reset your Login Count to 0.
     </p>
     <form action="account.php" method="POST">
     <button type="submit" name="submit_count" id="add-button">Submit</button>
     <button type="submit" name="cancel">Cancel</button>
   </form>
   </div>
 </div> -->
</body>

<?php



  if (isset($_POST['submit_newpass'])) {

    $password      = trims(mysqli_escape_string($main_connect->connect(),$_POST['password']));
    $password_new1 = trims(mysqli_escape_string($main_connect->connect(),$_POST['password_new1']));
    $password_new2 = trims(mysqli_escape_string($main_connect->connect(),$_POST['password_new2']));

    if (empty($password) or (empty($password_new1)) or (empty($password_new2))) {

        showError();


    } else if ($password_new1 != $password_new2) {

        showError();
    }

    else {

        $sql = "SELECT * FROM users WHERE username = '{$_SESSION['username']}' AND password = '$password";
        mysqli_query($main_connect->connect(), $sql);

        $rows = mysqli_num_rows($result);

        if ($rows == 1) {

            $password_new1 = md5($password_new1);
            $sql_pass = "UPDATE users SET password = '$password_new1' WHERE username = '{$_SESSION['username']}'";
            $result = mysqli_query($main_connect->connect(), $sql_pass);

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

        showError();

    } else if (!filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL)) {

        showError();
    }

    else {

            $new_email = email_clean($_POST['new_email']);

            $sql_email = "UPDATE users SET email = '$new_email' WHERE username = '{$_SESSION['username']}'";
            mysqli_query($main_connect->connect(), $sql_email);
            echo '<script type="text/javascript">
                  display_input_message(9);
                  </script>';

        }

  }

  if (isset($_POST['submit_count'])) {

    $sql_count = "UPDATE users SET account_count = 0 WHERE username = '{$_SESSION['username']}'";
    mysqli_query($main_connect->connect(), $sql_count);

    header("Location: main.php");

  }

  if (isset($_POST['delete_account'])) {

    $user_to_delete = $_SESSION['username'];

    $sql_delete_user  = "SELECT `username` ";
    $sql_delete_user .= "FROM users ";
    $sql_delete_user .= "WHERE username = '$user_to_delete' ";

    $sql_user_check  = "SELECT * FROM users ";

    $result = mysqli_query($main_connect->connect(), $sql_user_check);

    if($result->num_rows <= 1) {

      echo "Cannot delete when 1 account is left!";
    } else {

        $sql  = "DELETE * FROM users ";
        $sql .= "WHERE username = '$user_to_delete' ";

        $result_delete = mysqli_query($main_connect->connect(), $sql);

        if ($result_delete) {

          header("Location: index.php");

        }

    }

  }


$account_functions = new Functions();

 ?>
