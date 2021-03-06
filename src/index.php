<?php
session_start();
include_once("lib/functions.php");
include_once("lib/secure.php");
require     ('lib/notification.php');


class Login {

  private $user;
  private $pass;
  private $ip;
  public static $welcome = "Welcome.";


      public function __construct() {

        $this->user= trims($_POST['username']);
        $this->pass = trims($_POST['password']);
        $this->pass = md5($this->pass);
        $this->ip = $_SERVER['REMOTE_ADDR'];

      }

      public function getIP() {

        return $this->ip;
      }

      public static function getLogin($bool) {

        if (isset($bool) && $bool == 1) {

            return $this->user . $this->pass;
        } else {

          return $this->user . $this->ip;
        }

      }

      public function login_log_check($query) {

        if ($allowLogLogin == TRUE) {


        if ($query) {


          $logcheck = new Connect();

          mysqli_query($logcheck->connect(), $query);

        }

      }

   }
      public function login() {

        include ('config/config.php');

          $connect->query($sql_login_success);

          if ($connect) {
          $_SESSION['username'] = $username_l;
          header("Location: modules/main.php?login=1");
        }


    } else {

            if ($allowLogLogin == TRUE) {


        $query = "SELECT username, password FROM users WHERE username = '$this->user' and password ='$this->pass'";
         $query_add = "UPDATE `users` SET `account_count` = account_count + 1, `last_ip` = '$this->ip' WHERE username = '$this->user'";

        $login_connect = new Connect();

        $this->user = mysqli_real_escape_string($login_connect->connect(), $this->user);
        $this->pass = mysqli_real_escape_string($login_connect->connect(), $this->pass);

        $result = mysqli_query($login_connect->connect(), $query);

        if(mysqli_num_rows($result) == 1) {

          if($config['$allowLoginLog'] == TRUE) {

            $sql_login_success = "INSERT INTO login_log (`log_id`,`account_id`,`username`,`error_message`,`date`,`ip`) VALUES
                                  (NULL, (SELECT `account_id` FROM `users` WHERE username = '$this->user'),
                                  '$this->user','Success', NOW(),'$this->ip')";

            $this->login_log_check($sql_login_success);

          }
            mysqli_query($login_connect->connect(), $query_add);
            $_SESSION['username'] = $this->user;
            header("Location: modules/main.php?login=1");

        } else {

                if($config['$allowLoginLog'] == TRUE) {

                  $sql_login_error = "INSERT INTO login_log (`log_id`,`account_id`,`username`,`error_message`,`date`,`ip`) VALUES
                  ('','','$this->user','INVALID LOGIN ATTEMPT',NOW(),'$this->ip')";

                  $this->login_log_check($sql_login_error);

                }

                Login::$welcome = "Invalid Login Credentials.";

          }
      }

   }

if (isset($_POST['submit'])) {


  $login_main = new Login();
  $login_main->login();

}
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
    <?php echo '<h2>' . Login::$welcome .'</h2>'; ?>
     <form action="index.php" method="POST">
     <input type="text" placeholder="Username *" name="username" id="username" class="error-input" autofocus><br />
     <input type="password" placeholder="Password *" name="password" id="password" /><br />
     <a onclick="showPassword()" <p id="show-password-link">Show Password <span class="glyphicon glyphicon-eye-open"></span></p></a>
     <button id="login-button" name="submit">Login</button><br />
   </form>
</div>

</body>

  <script type='text/javascript' src='js/view.js'></script>
  <script type='text/javascript' src='js/notification.js'></script>
  <script type='text/javascript' src='js/forms.js'></script>
</html>
<?php

      $index  = new Notification();
      $index->notifications();

      ?>
