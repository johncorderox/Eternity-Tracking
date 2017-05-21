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

      } else {

      $username = trims($_POST['username']);
      $password = trims($_POST['password']);
      $password = md5($password);
      $email = trims($_POST['email']);
      $email = email_clean($email);
      $ip = $_SERVER['REMOTE_ADDR'];
      $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
      $test = "SELECT * FROM users WHERE username = '".$username."'";
      $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','AU','{$_SESSION['username']}', '$username', NOW(), '$ip')";

      mysqli_select_db($connect, $database);


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
          Username and Password must be longer than 7 characters.<br />
          Please make both fields unique for the account. Numbers and Letters.<br />
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
