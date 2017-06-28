<?php include 'main.php';

include('../config/config.php');
include("../lib/secure.php");


class DeleteBug {

  private $deleteId;
  private $ip;
  private $user;

  public static $errorMessage = "";


  public function __construct() {

    $this->deleteId = trims($_POST['delete_id']);
    $this->ip       = $_SERVER['REMOTE_ADDR'];
    $this->user     = $_SESSION['username'];

  }


  public function setDeleteId ($d) {

    $this->deleteId = $d;


  }

  public function getDeleteId() {

    return $this->deleteId;


  }

  private function test_query() {

    $test_query = new Connect();
    $delete_sql_test = "SELECT * FROM bugs WHERE id = '$this->deleteId' ";

    $result = mysqli_query($test_query->connect(), $delete_sql_test);

      if (mysqli_num_rows($result) > 0) {

        $this->run();

      } else {

        DeleteBug::$errorMessage = "ID: " . $this->deleteId . " could not be found.";
      }


  }

  private function run() {

    $run = new Connect();
    $delete_sql      = "DELETE FROM bugs WHERE id = " .$this->deleteId;
    $delete_sql_copy = "INSERT INTO deleted_bugs (id, title, message, priority, category) SELECT `id`,`title`, `message`, `priority`, `category` FROM bugs WHERE id = '$this->deleteId'";
    $delete_sql_update ="UPDATE deleted_bugs SET deleted_by = '{$_SESSION['username']}', delete_date = NOW(), status = 'closed' WHERE id = '$this->deleteId'";
    $delete_sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','D','{$_SESSION['username']}', '$this->deleteId', NOW(), '$this->ip')";


    // Moves data into another table
    mysqli_query($run->connect(),$delete_sql_copy);
    // Adds remaining values to new table
    mysqli_query($run->connect(),$delete_sql_update);
    // Deletes the bug ID number
    mysqli_query($run->connect(),$delete_sql);
    // Logs the deleted bug
    mysqli_query($run->connect(),$delete_sql_log);
    // Successful redirect
    header("Location: main.php?deletebug=1");


  }

  public function deleteBug() {

      if (empty($this->deleteId)) {

           return DeleteBug::$errorMessage = "You did not enter anything to be deleted!";


      } else {


          if (is_numeric($this->deleteId)) {

            $delete_connect = new Connect();

            mysqli_escape_string($delete_connect->connect(), $this->deleteId);
            $this->test_query();


          } else {

              return DeleteBug::$errorMessage = "You did not enter a valid number!";

          }

      }

   }

}


  if (isset($_POST['submit_delete'])) {

    $delete_bug = new DeleteBug();
    $delete_bug->deleteBug();

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
      <?php echo '<p>' . DeleteBug::$errorMessage .'</p>'; ?>
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
