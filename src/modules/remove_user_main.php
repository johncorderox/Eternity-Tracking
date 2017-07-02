<?php
require ("../header.php");
require ("../config/config.php");
require ("../lib/secure.php");
require ("../lib/test.php");


Class RemoveUser {

  private $id;
  private $reason;
  private $ip;
  private $user;


    public function __construct() {


      $this->id     = trims($_POST['delete_user']);
      $this->reason = $_POST['option_radio'];
      $this->ip     = $_SERVER['REMOTE_ADDR'];
      $this->user   = $_SESSION['username'];

      $this->escape_string();

    }

    public function escape_string () {

      $escape = new Connect();

      mysqli_escape_string($escape->connect(), $this->id);


    }

    public function user_count_test () {

      $user_count_sql = "SELECT * FROM `users` ";
      $user_count = new Connect();

      $result = mysqli_query($user_count->connect(), $user_count_sql);

        if (mysqli_num_rows($result) == 1) {

            echo "Only 1 account left. Cannot delete";
            mysqli_close($user_count->connect());

        } else if (mysqli_num_rows($result) <= 0 ) {

          echo "There are 0 accounts in the system. Error.";
          mysqli_close($user_count->connect());

        } else {

          $this->remove_user();


        }

    }

    public function remove_user() {


      $remove_user_sql    = "DELETE FROM users WHERE account_id = " .$this->id;
      $remove_user_copy   = "INSERT INTO deleted_users (account_id, username) SELECT `account_id`,`username` from users WHERE account_id = '$this->id'";
      $remove_user_copy2  = "UPDATE deleted_users SET deleted_reason = '$reason', deleted_by = '{$_SESSION['username']}' WHERE account_id = '$this->id'";
      $remove_user_log    = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','RU','$this->user', '$this->id' , NOW(), '$this->ip')";

      $remove_user = new Connect();

      $result = mysqli_query($remove_user->connect(), $remove_user_sql);

        if (mysqli_num_rows($result) > 0) {

          mysqli_query($remove_user->connect(), $remove_user_copy);
          mysqli_query($remove_user->connect(), $remove_user_copy2);
          mysqli_query($remove_user->connect(), $sql);
          mysqli_query($remove_user->connect(), $sql_log);
          header("Location: main.php?removeuser=1");


        }



    }



}




if(isset($_POST['cancel'])) {

  header("Location: main.php");
}

if (isset($_POST['submit_remove'])) {

  $remove_user = new Connect();

  if (!empty($_POST['delete_user']) && is_numeric($_POST['delete_user'])) {




        $query_first_test = mysqli_query($connect, $test_empty);

        if (mysqli_num_rows($query_first_test) == 1) {

           $error= "Only 1 left";

        } else {

              $query = mysqli_query($connect, $test);

              if(mysqli_num_rows($query) > 0 ) {

                    mysqli_query($connect, $sql_copy);
                    mysqli_query($connect, $sql_addinfo);
                    mysqli_query($connect, $sql);
                    mysqli_query($connect, $sql_log);
                    header("Location: main.php?removeuser=1");


              } else {

                      $error = "The ID was not found...";
              }

        }
    } else {

          $error = "You did not meet some requirements.";

    }
}

?>
<div class="removeuserform">
  <form action="remove_user_main.php" method="POST">
    <p id="larger">
      Enter Username ID:
    </p>
    <p>
      Removing users removes all privledges and access to report bugs for <?php echo $company_name; ?>.<br />
      Please make sure you really want to remove the user before submitting.
    </p>
    <?php echo $error; ?><br />
    <input type="text" id="remove_id" name ="delete_user" placeholder="ID #: "/><br />
      <div class="radio">
        <label><input type="radio" name="option_radio" value="No Longer Needed" id="radio_default">No Longer Needed</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="option_radio" value="Unknown Account">Unknown Account</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="option_radio" value="Abusing Power">Abusing Power</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="option_radio" value="Other">Other</label>
      </div>
    <button type="submit" name="submit_remove" id="add-button">Submit</button>
    <button type="submit" name="cancel">Cancel</button>
  </form>
</div>
<?php include '../tables/user_list.php'; ?>
</body>
<script type='text/javascript' src='..js/forms.js'></script>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.removeuserform').show();

  $('table').css("width", "35%");


  $('#radio_default').prop("checked", true);

  hideLogs();

});
</script>
