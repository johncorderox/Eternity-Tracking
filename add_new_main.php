<?php

include('config.php');
include('connect.php');

$error = "";

if(isset($_POST['cancel'])) {

  header("Location: main.php");
}


if(isset($_POST['submit_newuser'])) {

    if(!empty($_POST['username']) && (!empty($_POST['password']))) {


      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
      $test = "SELECT * FROM users WHERE users.username = '".$username."'";

      mysqli_select_db($connect, $database);

      $query = mysqli_query($connect, $test) or die(mysqli_error($connect));

      if (mysqli_num_rows($query) > 0) {

        $error = "The username " . $username . " already exists!";
      } else {

        $result = mysqli_query($connect, $sql);
           if ($result) {
              $error = "Added to database succesfully.";

           }

      }



    }

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
        <?php echo $error; echo '<br />'; ?>
    <input type="text" id="user_new" name ="username" placeholder="Username *"/><br />
    <input type="password" id="pass_new" name ="password" placeholder="Password *"/><br />
    <button type="submit" name="submit_newuser" id="add-button">Submit</button>
    <button type="submit" name="cancel">Cancel</button>
  </form>
</div>
<script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.newuserform').show();

});


</script>
