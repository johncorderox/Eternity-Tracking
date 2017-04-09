<?php


$message = "Welcome.";


include ("config/config.php");
include("lib/functions.php");
include("lib/secure.php");

session_start();

if (isset($_POST['submit'])) {


  $username_l = trims($_POST['username']);
  $password_l = trims($_POST['password']);
  $password_l = md5($password_l);
  $ip = $_SERVER['REMOTE_ADDR'];


  $query = "SELECT * FROM `users` WHERE `username` = '$username_l' and password = '$password_l'";
  $query_add = "UPDATE `users` SET `account_count` = account_count + 1, `last_ip` = '$ip' WHERE username = '$username_l'";
  $result = mysqli_query($connect, $query);

  $num_of_rows = mysqli_num_rows($result);

    if ($num_of_rows == 1) {

      mysqli_query($connect, $query_add);

      $sql_login_success = "INSERT INTO login_log (`account_id`,`username`,`error_message`,`date`,`ip`) VALUES
      ((SELECT `account_id` FROM `users` WHERE username = '$username_l'),
       '$username_l',
       'Success',
        NOW(),
       '$ip'
       )";

      mysqli_query($connect, $sql_login_success);
      $_SESSION['username'] = $username_l;
      header("Location: modules/main.php?login=1");

    } else {

          $sql_login_error = "INSERT INTO login_log (`account_id`,`username`,`error_message`,`date`,`ip`) VALUES
          ('0',
           '$username_l',
           'INVALID LOGIN ATTEMPT',
            NOW(),
           '$ip'
           )";
           mysqli_query($connect, $sql_login_error) or die(mysqli_error($connect));
           $message = "Invalid Credentials.";

        }

      $message = "Incorrect Login Information.";



}

mysqli_close($connect);

?>


<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>
      <link href="css/interface.css" rel="stylesheet" />
    </head>
  <body>
<div class="center">
    <?php echo '<h2>' . $message . '</h2>'; ?>
     <form action="index.php" method="POST">
     <input type="text" placeholder="Username *" name="username" id="username" class="error-input" autofocus><br />
     <input type="password" placeholder="Password *" name="password" id="password" /><br />
     <button id="login-button" name="submit">Login</button><br />
   </form>
</div>
</body>
  <script type='text/javascript' src='js/view.js'></script>
</html>

<?php

  if (isset($_GET['logout']) && $_GET['logout'] == '1') {

    echo '<script type="text/javascript">
          display_input_message(3);
          </script>';
  }


 ?>
