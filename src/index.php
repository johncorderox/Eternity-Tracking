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


  $query  = "SELECT `username`,`password`";
  $query .= "FROM `users`";
  $query .= "WHERE `username` = '$username_l' and password = '$password_l'";


  $query_add = "UPDATE `users`";
  $query_add .= "SET `account_count` = account_count + 1, `last_ip` = '$ip'";
  $query_add .= "WHERE username = '$username_l'";

  $result = $connect->query($query);



    if ($result->num_rows == 1) {

      $connect->query($query_add);

      $sql_login_success = "INSERT INTO login_log (`log_id`,`account_id`,`username`,`error_message`,`date`,`ip`) VALUES
        (NULL, (SELECT `account_id` FROM `users` WHERE username = '$username_l'),
       '$username_l','Success', NOW(),'$ip')";

      $connect->query($sql_login_success);
      $_SESSION['username'] = $username_l;
      header("Location: modules/main.php?login=1");

    } else {

          $sql_login_error = "INSERT INTO login_log (`log_id`,`account_id`,`username`,`error_message`,`date`,`ip`) VALUES
          ('','','$username_l','INVALID LOGIN ATTEMPT',NOW(),'$ip')";
           $connect->query($sql_login_error);
           $message = "Invalid Credentials.";

        }

      $message = "Incorrect Login Information.";




}

$connect->close();

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
     <a href="request.php"<p id="request">Request Account?</p></a>
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

  if (isset($_GET['request']) && $_GET['request'] == '1') {

    echo '<script type="text/javascript">
          display_input_message(10);
          </script>';
  }


 ?>
