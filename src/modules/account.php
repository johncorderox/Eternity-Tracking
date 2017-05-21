<?php
include 'main.php';
include '../lib/secure.php';
include('../config/config.php');

  $connected = mysqli_select_db($connect, $database);
  if($connected) {

    $sql = "SELECT `email`, `account_count`, `last_ip` ";
    $sql .= "FROM users ";
    $sql .= "WHERE username = '$logged'";

    $result = $connect->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {

      $email = $row['email'];
      $account_count = $row['account_count'];
      $ip = $row['last_ip'];

    }

  }

  if (isset($_POST['submit_newpass'])) {

    $password = trims($_POST['password']);
    $password_new1 = trims($_POST['password_new1']);
    $password_new2 = trims($_POST['password_new2']);

    if (empty($password) or (empty($password_new1)) or (empty($password_new2))) {

        showError();


    } else if ($password_new1 != $password_new2) {

        showError();
    }

    else {

        $sql = "SELECT * FROM users WHERE username = '{$_SESSION['username']}' AND password = '$password";
        mysqli_query($connect, $sql);

        $rows = mysqli_num_rows($result);

        if ($rows == 1) {

            $password_new1 = md5($password_new1);
            $sql_pass = "UPDATE users SET password = '$password_new1' WHERE username = '{$_SESSION['username']}'";
            $result = mysqli_query($connect, $sql_pass);

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
            $connect->query($sql_email);
            echo '<script type="text/javascript">
                  display_input_message(9);
                  </script>';

        }

  }

  if (isset($_POST['submit_count'])) {

    $sql_count = "UPDATE users SET account_count = 0 WHERE username = '{$_SESSION['username']}'";
    $connect->query($sql_count);

    header("Location: main.php");

  }

 ?>
 <body>
   <div class="account_settings">
    <a href="account.php"><h5>Account Settings</h5></a>
     <hr />
     <div class="panel panel-info">
  <div class="panel-heading"> Menu:
    <li onclick="reveal(0)">Change Password</li>
    <li onclick="reveal(1)">Change Email</li>
    <li onclick="reveal(2)">Reset Login Count</li>
  </div>
</div>
    <div class="account_info">
      <p>Username: <?php echo $logged; ?> </p>
      <p>Email: <?php echo $email; ?></p>
      <p>Login Count: <?php echo $account_count; ?> </p>
      <p>Last IP: <?php echo $ip; ?> </p><br />
      <p>Number of bugs reported: <?php echo getReported(1); ?></p>
      <p>Number of bugs deleted: <?php echo getReported(2); ?> </p>
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
   </div>
 </body>
 <script>
 $(document).ready(function() {

   $('.ui-main-button-group, .changePassword, .changeEmail, .resetLoginCount').hide();

 });

 </script>
