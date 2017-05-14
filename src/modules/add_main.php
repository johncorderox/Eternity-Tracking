<?php
  include ('main.php');
  include('../config/config.php');
  include("../lib/secure.php");

$error = "";

  if (isset($_POST['add_main'])) {

    $title = trims($_POST['title']);
    $message = trims($_POST['message']);
    $priority = $_POST['priority'];
    $category = $_POST['category'];
    $ip = $_SERVER['REMOTE_ADDR'];


    if (empty($title) || empty($message)) {

        $error ="Some fields are missing in the form!";


    }
    else {

        $sql = "INSERT INTO bugs (title, message, priority, category, reported_by, date) VALUES ('$title','$message', '$priority', '$category', '$logged', NOW())";
        $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','A','{$_SESSION['username']}', '$title', NOW(), '$ip')";

        mysqli_select_db($connect, $database);

        mysqli_query($connect, $sql) or die (mysqli_error($connect));
        mysqli_query($connect, $sql_log);
        mysqli_close($connect);


        header("location: main.php?successbug=1");

  }

}

  if(isset($_POST['cancel'])) {

    header("location: main.php");
  }

?>

<html>
<body>
  <div class="addform">
    <form action="add_main.php" method="POST">
    <p id="larger"> Please Enter a Title and a Descriptive Message! </p><br />
    <?php echo  '<p>'. $error . '</p>'; ?>
    <input type="text" placeholder="Title *" name="title" id="title"/><br />
    <input type="text" placeholder="Message *" id="message" name="message"></textarea><br />
    <p> Enter a priority and a category for your bug.</p>
    <select class="form-control" name="priority" id="select_box">
      <option value="Low">Low</option>
      <option value="Medium">Medium</option>
      <option value="High">High</option>
      <option value="None">None</option>
      <option value="Other">Other</option>
    </select><br />
    <select class="form-control" name="category" id="select_box">
      <option value="None">None</option>
      <option value="Administration">Administration</option>
      <option value="Feature">Feature</option>
      <option value="Security">Security</option>
      <option value="Database">Database</option>
      <option value="Email">Email</option>
      <option value="Enhancement">Enhancement</option>
      <option value="Customization">Customization</option>
      <option value="Other">Other</option>
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
  $('.addform2').show();

});
</script>

</script>
