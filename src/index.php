<?php

include_once("lib/functions.php");
include_once("lib/secure.php");

session_start();


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

        if ($query) {

          $logcheck = new Connect();

          mysqli_query($logcheck->connect(), $query);


        }

      }

      public function login() {

        require_once("config/config.php");

        $query = "SELECT username, password FROM users WHERE username = '$this->user' and password ='$this->pass'";

        $query_add = "UPDATE `users` ";
        $query_add .= "SET `account_count` = account_count + 1, `last_ip` = '$this->ip' ";
        $query_add .= "WHERE username = $this->user";

        $login_connect = new Connect();

        $this->user = mysqli_real_escape_string($login_connect->connect(), $this->user);
        $this->pass = mysqli_real_escape_string($login_connect->connect(), $this->pass);

        $result = mysqli_query($login_connect->connect(), $query);

        $num = mysqli_num_rows($result);
        if(mysqli_num_rows($result) == 1) {

          if($config['$allowLoginLog'] == TRUE) {

            $sql_login_success = "INSERT INTO login_log (`log_id`,`account_id`,`username`,`error_message`,`date`,`ip`) VALUES
                                  (NULL, (SELECT `account_id` FROM `users` WHERE username = '$this->user'),
                                  '$this->user','Success', NOW(),'$this->ip')";

            $this->login_log_check($sql_login_success);

          }

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
     <a href="request.php"<p id="request">Request Account?</p></a>
     <button id="login-button" name="submit">Login</button><br />
   </form>
</div>
</body>

  <script type='text/javascript' src='js/view.js'></script>
  <script type='text/javascript' src='js/notification.js'></script>
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
