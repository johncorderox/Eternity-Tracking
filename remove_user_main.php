<?php

include('config.php');
include('connect.php');
include('secure.php');


$error = "";

if(isset($_POST['cancel'])) {

  header("Location: main.php");
}

if (isset($_POST['submit_remove'])) {

  if (isset($_POST['delete_user'])) {

      $id = trims($_POST['delete_user']);
      $sql = "DELETE FROM users WHERE account_id = " .$id;
      $test = "SELECT * FROM users WHERE account_id = " .$id;

        mysqli_select_db($connect, $database);

        $query = mysqli_query($connect, $test);


        if (mysqli_num_rows($query) < 2) {

          echo '<script type="text/javascript">
                display_input_message(5);
                </script>';
            $error = "You cannot delete the last user in the System!";

        }

        if(mysqli_num_rows($query) > 0 ) {

            mysqli_query($connect, $sql);
            header("Location: main.php?removeuser=1");


        } else {


          $error = "The username ID " . $id . "did not return any results.";
        }

  }

}

?>
<?php include 'main.php'; ?>
<div class="removeuserform">
  <form action="remove_user_main.php" method="POST">
    <p id="larger">
      Enter Username ID:
    </p>
    <?php echo $error; ?>
    <input type="text" id="remove_id" name ="delete_user" placeholder="ID #: "/><br />
    <button type="submit" name="submit_remove" id="add-button">Submit</button>
    <button type="submit" name="cancel">Cancel</button>
  </form>
</div>
<script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.removeuserform').show();



});

</script>
<?php

include('config.php');
include('connect.php');

$sql = "SELECT * FROM users";

mysqli_select_db($connect, $database);

$result = mysqli_query($connect, $sql);

  echo "<div id=\"table_users\">";
  echo "<table><tr><th>ID</th><th>Username</th></tr>";
  while ( $row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>".$row["account_id"]."</td><td>".$row["username"]."</td></tr>";
    echo "</div>";
}
?>
