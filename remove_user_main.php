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
      $test_empty = "SELECT * FROM users";

        mysqli_select_db($connect, $database);

        $query_first_test = mysqli_query($connect, $test_empty);

        if (mysqli_num_rows($query_first_test) == 1) {

            echo "Only 1 left";

        } else {

              $query = mysqli_query($connect, $test);

              if(mysqli_num_rows($query) > 0 ) {

                  mysqli_query($connect, $sql);
                  header("Location: main.php?removeuser=1");


              } else {

                echo '<script type="text/javascript">
                      display_input_message(8);
                      </script>';

              }

        }
    }
}

?>
<?php include("header.php"); ?>
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
<?php include 'user_list.php'; ?>
<script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script type='text/javascript' src='src/js/view.js'></script>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.removeuserform').show();

  $('table').css("width", "35%");



});
</script>
