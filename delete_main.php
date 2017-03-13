<?php
  include('config.php');
  include('connect.php');
  include('secure.php');

  $error = "";


  if (isset($_POST['submit_delete'])) {

    if (empty($_POST['delete_id'])) {

      $error = "You didn't enter anyting into the field.";
    }

    if (!empty($_POST['delete_id'])) {

      $id = trims($_POST['delete_id']);
      $sql = "DELETE FROM bugs WHERE id = " .$id;
      $test = "SELECT * FROM bugs WHERE id = " .$id;


          mysqli_select_db($connect, $database);

          $query = mysqli_query($connect, $test);

          if(mysqli_num_rows($query) > 0 ) {

            mysqli_query($connect, $sql);
            header("Location: main.php?deletebug=1");


          }

          else {

              $error = ' bug number ' . $id . ' does not exist.';
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

  $('.ui-main-button-group').hide("fast");
  $('.deleteform').show();

});


</script>
