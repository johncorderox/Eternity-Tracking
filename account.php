<?php
include 'main.php';
include 'secure.php';

  $connected = mysqli_select_db($connect, $database);
  if($connected) {

    $sql = "SELECT `email`, `account_count`, `last_ip` FROM users WHERE username = '$logged'";
    $result = mysqli_query($connect, $sql);
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

      echo "Something is empty";


    } else if ($password_new1 != $password_new2) {

      echo "The passwords do not match";
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

              echo "Password update was Successful!";
            }

    }




  }


}





 ?>
 <body>
   <div class="account_settings">
     <h5>Account Settings</h5>
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
      <p>Number of bugs reported: </p>
      <p>Number of bugs deleted:  </p>
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
          Enter your new password.
        </p>
        <input type="password" name="password_new2" /><br />
        <button type="submit" name="submit_newpass" id="add-button">Submit</button>
        <button type="submit" name="cancel">Cancel</button>
      </form>
    </div>
   </div>
 </body>

 <script>
 $(document).ready(function() {

   $('.ui-main-button-group, .changePassword').hide();

 });

 </script>
