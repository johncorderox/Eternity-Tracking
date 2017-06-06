<?php
include ('main.php');
include ("../config/config.php");
include("../lib/secure.php");


if(isset($_POST['cancel'])) {

  header("Location: main.php");
}

if(isset($_POST['submit_newuser'])) {


    if(!empty($_POST['username']) && (!empty($_POST['password'])) && !empty($_POST['email'])) {


        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            showError();

        }

      else if (strlen($_POST['password']) < $MinPasswordLength || sizeof($_POST['password']) > $MaxPasswordLength) {

              showError();

        }

        else {

            $username = trims(mysqli_escape_string($connect, $_POST['username']));
            $password = trims(mysqli_escape_string($connect, $_POST['password']));
            $password = md5($password);
            $email = trims(mysqli_escape_string($connect, $_POST['email']));
            $email = email_clean($email);
            $ip = $_SERVER['REMOTE_ADDR'];
            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
            $test = "SELECT * FROM users WHERE username = '".$username."'";
            $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','AU','{$_SESSION['username']}', '$username', NOW(), '$ip')";

            mysqli_select_db($connect, $database);

            $sql_email_double = "SELECT * from users WHERE email = '$email' ";

            if ($allowMultiEmail == FALSE) {

              $email_result = $connect->query($sql_email_double);

              if ($email_result->num_rows >= 1) {

                echo "the email is already taken";

              }

            } else {

            $query = $connect->query($test);

                if ($query->num_rows > 0) {

                  showError();

                } else {

                $result = $connect->query($sql);
                          $connect->query($sql_log);

                     if ($result) {

                        header("Location: main.php?newuser=1");
                        exit();

                     }

                  }

              }

           }

        }

    else if (empty($_POST['username']) or empty($_POST['password']) or empty($_POST['email'])) {

    showError();

  }

}

?>
<html>
<body>
<div class="newuserform">
  <form action="add_new_main.php" method="POST">
      <p id="larger">
        Please enter desired Username and Password.</p>
      <br />
      <p>
          Username and Password must be longer than 8 characters.<br />
          Password must not exceed <?php echo $MaxPasswordLength; ?> characters.<br />
          Email field must be in standard email format: abcdefg@email.com<br />
      <br />
      </p>
    <input type="text" id="user_new" name ="username" placeholder="Username *"/><br />
    <input type="password" id="pass_new" name ="password" placeholder="Password *"/><br />
    <input type="email" id="email_new" name ="email" placeholder="Email *"/><br />
    <button type="submit" name="submit_newuser" id="add-button">Submit</button>
    <button type="submit" name="cancel">Cancel</button>
  </form>
</div>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide();
  $('.newuserform').show();

});

</script>
