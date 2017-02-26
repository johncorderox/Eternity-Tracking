<?php

include('config.php');
include('connect.php');

$error = "";

if(isset($_POST['submit_newuser'])) {

    if($_POST['username'] and ($_POST['password'])) {


      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
      $test = "SELECT * FROM users WHERE id = " .$username;

        mysqli_select_db($connect, $database);

        $query = mysqli_query($connect, $test);

        if(mysqli_num_rows($query) > 0 ) {

          mysqli_query($connect, $sql);
          $error = "This username is already taken!";

        }

        else {

          $error = "One of the fields did not meet the requirements!";
        }

    }




}

if(isset($_POST['cancel'])) {

  header("location: main.php");
}



?>
<?php include 'main.php'; ?>
<html>
<body>
<div class="newuserform">
  <form action="add_new_main.php" method="POST">
      <p id="larger">
        Please enter desired Username and Password.
      </p><br />
      <p>
        Username and Password must be longer than 7 characters! </p>
        <?php echo $error; ?>
    <input type="text" id="user_new" name ="username" placeholder="Username *"/><br />
    <input type="password" id="pass_new" name ="password" placeholder="Password *"/><br />
    <button type="submit" name="submit_newuser" id="add-button">Submit</button>
    <button type="button" name="cancel">Cancel</button>
  </form>
</div>
<script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.newuserform').show("slow");

});


</script>
