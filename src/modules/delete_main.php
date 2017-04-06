<?php include 'main.php'; ?>
<?php
include('../config/config.php');
include("../lib/secure.php");

  $error = "";

  if (isset($_POST['submit_delete'])) {

    if (!empty($_POST['delete_id'])) {

      if (is_numeric($_POST['delete_id'])) {

      $id = trims($_POST['delete_id']);
      $sql = "DELETE FROM bugs WHERE id = " .$id;
      $test = "SELECT * FROM bugs WHERE id = " .$id;
      $sql_copy = "INSERT INTO deleted_bugs (id, title, message, priority) SELECT `id`,`title`, `message`, `priority` from bugs WHERE id = '$id'";
      $sql_insert ="UPDATE deleted_bugs SET deleted_by = '{$_SESSION['username']}', delete_date = NOW() WHERE id = '$id'";

            mysqli_select_db($connect, $database);
            $query = mysqli_query($connect, $test);

            if(mysqli_num_rows($query) > 0 ) {

              // Moves data into another table
              mysqli_query($connect, $sql_copy);
              // Adds remaining values to new table
              mysqli_query($connect, $sql_insert);
              // Deletes the bug ID number
              mysqli_query($connect, $sql);
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
