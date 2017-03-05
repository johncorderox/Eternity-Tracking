<?php
  include('config.php');
  include('connect.php');

$error = "";

  if (isset($_POST['add_main'])) {

    $title = $_POST['title'];
    $message = $_POST['message'];
    $priority = $_POST['priority'];

    if (empty($title) || empty($message)) {

        $error ="Some fields are missing in the form!";


    }
    else {

        $sql = "INSERT INTO bugs (title, message, priority) VALUES ('$title','$message', '$priority')";

        mysqli_select_db($connect, $database);
        $query = mysqli_query($connect, $sql);
        mysqli_close($connect);


        header("location: main.php?successbug=1");

  }

}

  if(isset($_POST['cancel'])) {

    header("location: main.php");
  }

?>

<?php include 'main.php'; ?>
<html>
<body>
  <div class="addform2">
    <form action="add_main.php" method="POST">
    <p id="larger"> Please Enter a Title and a Descriptive Message! </p><br />
    <?php echo  '<p>'. $error . '</p>'; ?>
    <input type="text" placeholder="Title *" name="title" id="title"/><br />
    <input type="text" placeholder="Message *" id="message" name="message"></textarea><br />
    <select class="form-control" name="priority" id="select_box">
      <option value="Low">Low</option>
      <option value="Medium">Medium</option>
      <option value="High">High</option>
    </select><br />
    <button type="submit" name="add_main" id="add-button">Submit</button>
    <button name="cancel">Cancel</button>
  </form>
  </div>
  <script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.addform2').show("slow");

});


</script>
