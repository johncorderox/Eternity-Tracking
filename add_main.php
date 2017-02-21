<?php
  include('config.php');
  include('connect.php');

  $add_error = "";


  if (isset($_POST['submit2'])) {

    $title = $_POST['title'];
    $message = $_POST['message'];
    $priority = $_POST['priority'];

        $sql = "INSERT INTO bugs (title, message, priority) VALUES ('$title','$message', '$priority')";

        mysqli_select_db($connect, $database);
        $query = mysqli_query($connect, $sql);


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
    <input type="text" placeholder="Title *" name="title" id="title"/><br />
    <input type="text" placeholder="Message *" id="message" name="message"></textarea><br />
    <select class="form-control" name="priority" id="select_box">
      <option value="Low">Low</option>
      <option value="Medium">Medium</option>
      <option value="High">High</option>
    </select><br />
    <button type="submit" name="submit2" id="add-button">Submit</button>
    <button name="cancel">Cancel</button>
    <button onclick="reset(0)">Reset</button>
  </form>
  </div>
  <script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>


<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.addform2').show();

});


</script>
