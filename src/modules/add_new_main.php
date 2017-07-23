<?php
require ('main.php');
require ("../config/config.php");
require ("../lib/secure.php");

class NewUser {

  private $username_user;
  private $password_user;
  private $email;
  private $logged_user;
  private $ip;

  public static $errorMessage = "";

    public function __construct() {

      $this->username_user = trims($_POST['username']);
      $this->password_user = trims($_POST['password']);
      $this->email         = trims($_POST['email']);
      $this->ip            = $_SERVER['REMOTE_ADDR'];
      $this->logged_user   = $_SESSION['username'];

      $this->email_clean();
      $this->md5pass();
      $this->escape_var();

    }


    public function email_clean() {

      $this->email = email_clean($this->email);

    }

    public function md5pass() {

      $this->password_user = md5($this->password_user);

    }


    public function escape_var() {

      $escape_var = new Connect();

      mysqli_escape_string($escape_var->connect(), $this->username_user);
      mysqli_escape_string($escape_var->connect(), $this->password_user);
      mysqli_escape_string($escape_var->connect(), $this->email);



    }

    public function test_email() {

        require("../config/config.php");

        $test_email_check = new Connect();

        if ($config['$allowMultiEmail'] == FALSE) {

          $sql_check_double_email = "SELECT * from `users` WHERE `email` = '$this->email' ";

          $result = mysqli_query($test_email_check->connect(), $sql_check_double_email);

            if(mysqli_num_rows($result) >= 1) {

               NewUser::$errorMessage = "This email is already taken!";
               mysqli_close($test_email_check->connect());

            }

        }

        $this->test_username();

  }

  public function test_username() {

    $test_username = new Connect();

    $sql_username_test = "SELECT * FROM users WHERE username = '".$this->username_user."'";

    $result = mysqli_query($test_username->connect(), $sql_username_test);

      if (mysqli_num_rows($result) >= 1) {

         NewUser::$errorMessage = "This username is already taken.";

      }

  }

    public function add_new_user() {

      require ("../config/config.php");

      if(!empty($_POST['username']) && (!empty($_POST['password'])) && !empty($_POST['email'])) {


          if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

               NewUser::$errorMessage = "Incorrect Email Format!";

          }

        else if (strlen($_POST['password']) < $config['$MinPasswordLength'] || sizeof($_POST['password']) > $config['$MaxPasswordLength']) {

                 NewUser::$errorMessage = "Password requirements did not meet.";

          }
              else {


              $this->test_email();

                    $add_new_final = new Connect();
                    $sql_add_new  = "INSERT INTO users (username, password, email) VALUES ('$this->username_user', '$this->password_user', '$this->email')";
                    $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','AU','$this->logged_user', '$this->username_user', NOW(), '$this->ip')";
                    mysqli_query($add_new_final->connect(), $sql_add_new);

                    mysqli_query($add_new_final->connect(), $sql_log);

                    mysqli_close($add_new_final->connect());

                    header("Location: main.php?newuser=1");
                    exit();


                }

          }

       else if (empty($_POST['username']) or empty($_POST['password']) or empty($_POST['email'])) {

             NewUser::$errorMessage = "You are missing 1 or more of the required fields.";

      }

   }

}

  if(isset($_POST['submit_newuser'])) {

      $new_user = new NewUser();
      $new_user->add_new_user();



  }



  if(isset($_POST['cancel'])) {

    header("Location: main.php");
  }


?>
<html>
<body>

</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide();
  $('.newuserform').show();

});

</script>
