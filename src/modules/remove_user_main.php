<?php
include("../header.php");
include('../config/config.php');
include("../lib/secure.php");

$error = "";

if(isset($_POST['cancel'])) {

  header("Location: main.php");
}

if (isset($_POST['submit_remove'])) {

  if (!empty($_POST['delete_user']) && is_numeric($_POST['delete_user'])) {

      $id = trims($_POST['delete_user']);
      $reason = $_POST['option_radio'];
      $ip = $_SERVER['REMOTE_ADDR'];
      $sql = "DELETE FROM users WHERE account_id = " .$id;
      $sql_copy = "INSERT INTO deleted_users (account_id, username) SELECT `account_id`,`username` from users WHERE account_id = '$id'";
      $sql_addinfo = "UPDATE deleted_users SET deleted_reason = '$reason', deleted_by = '{$_SESSION['username']}' WHERE account_id = '$id'";
      $test = "SELECT * FROM users WHERE account_id = " .$id;
      $test_empty = "SELECT * FROM users";
      $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','RU','{$_SESSION['username']}', ("SELECT username FROM deleted_bugs ORDER BY DESC LIMIT 1") , NOW(), '$ip')";


        mysqli_select_db($connect, $database);

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
<script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.removeuserform').show();

  $('table').css("width", "35%");


  $('#radio_default').prop("checked", true);

});
</script>
