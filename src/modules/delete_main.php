<?php include 'main.php'; ?>
<?php
include('../config/config.php');
include("../lib/secure.php");

  $error = "";

  if (isset($_POST['submit_delete'])) {

    if (!empty($_POST['delete_id'])) {

      if (is_numeric($_POST['delete_id'])) {

      $id = trims(mysqli_escape_string($connect, $_POST['delete_id']));
      $ip = $_SERVER['REMOTE_ADDR'];
      $sql = "DELETE FROM bugs WHERE id = " .$id;
      $test = "SELECT * FROM bugs WHERE id = " .$id;
      $sql_copy = "INSERT INTO deleted_bugs (id, title, message, priority, category) SELECT `id`,`title`, `message`, `priority`, `category` FROM bugs WHERE id = '$id'";
      $sql_insert ="UPDATE deleted_bugs SET deleted_by = '{$_SESSION['username']}', delete_date = NOW(), status = 'closed' WHERE id = '$id'";
      $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','D','{$_SESSION['username']}', '$id', NOW(), '$ip')";

            mysqli_select_db($connect, $database);

            $query = $connect->query($test);

            if($query->num_rows > 0 ) {

              // Moves data into another table
              $connect->query($sql_copy);
              // Adds remaining values to new table
              $connect->query($sql_insert);
              // Deletes the bug ID number
              $connect->query($sql);
              // Logs the deleted bug
              $connect->query($sql_log);
              // Successful redirect
              header("Location: main.php?deletebug=1");
              mysqli_close($connect);

            }

              else {

              $error = ' bug number ' . $id . ' does not exist.';
             }

       } else {

    $error = "You did not enter a valid number.";

  }
 }
}


  if(isset($_POST['cancel'])) {

    header("location: main.php");
  }

?>

<html>
<body>
  <div class="deleteform">
    <form action="delete_main.php" method="POST">
      <?php echo '<p id="larger">Enter the Bug ID Number: </p> <br />'; ?>
      <?php echo  '<p>'. $error . '</p>'; ?>
      <input type="text" id="del_start" name ="delete_id" placeholder="ID #: "/><br />
      <button type="submit" name="submit_delete" id="add-button">Submit</button>
      <button name="cancel">Cancel</button>
    </form>
  </div>
  <script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide();
  $('.deleteform').show();

});


</script>
