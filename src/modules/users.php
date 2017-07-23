<?php
require ("../header.php");
require ("../config/config.php");
require ("../lib/secure.php");
require('../lib/notification.php');
require('../lib/functions.php');


Class RemoveUser {

  private $id;
  private $reason;
  private $ip;
  private $user;

  public static $errorMessage;

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


      if (!empty($_POST['delete_user']) && is_numeric($_POST['delete_user'])) {


        $user_count_sql = "SELECT * FROM `users`";
        $user_count = new Connect();

        $result = mysqli_query($user_count->connect(), $user_count_sql);

          if (mysqli_num_rows($result) == 1) {

              RemoveUser::$errorMessage = "Only 1 account left. Cannot delete";
              mysqli_close($user_count->connect());

          } else if (mysqli_num_rows($result) <= 0 ) {

            RemoveUser::$errorMessage = "There are 0 accounts in the system. Error.";
            mysqli_close($user_count->connect());

          } else {

            $this->remove_user();


          }

        } else {

          RemoveUser::$errorMessage = "You did not meet the requirements.";
        }

    }

    public function remove_user() {


      $remove_user_test   = "SELECT * FROM `users` WHERE account_id = ".$this->id;
      $remove_user_sql    = "DELETE FROM `users` WHERE account_id = " .$this->id;
      $remove_user_copy   = "INSERT INTO deleted_users (account_id, username) SELECT `account_id`,`username` from users WHERE account_id = '$this->id'";
      $remove_user_copy2  = "UPDATE deleted_users SET deleted_reason = '$this->reason', deleted_by = '$this->user' WHERE account_id = '$this->id'";
      $remove_user_log    = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','RU','$this->user', '$this->id' , NOW(), '$this->ip')";

      $remove_user = new Connect();

      $result = mysqli_query($remove_user->connect(), $remove_user_test);

        if (mysqli_num_rows($result) == 1) {

          mysqli_query($remove_user->connect(), $remove_user_copy);
          mysqli_query($remove_user->connect(), $remove_user_copy2);
          mysqli_query($remove_user->connect(), $remove_user_sql);
          mysqli_query($remove_user->connect(), $remove_user_log);

          mysqli_close($remove_user->connect());
          header("Location: users.php?removeuser=1");


        } else {


          echo "No ID was found!";
        }



    }



}


class UserList {

    public $sql_users = "SELECT * from `users` ";


    public function displayUsers() {

        $user_list = new Connect();

        $result = mysqli_query($user_list->connect(), $this->sql_users);


        echo "<table class=\"table table-hover\" id=\"user-table\">";
        echo "<tr><th>ID: </th><th>Username</th>";
        echo "</thead><tbody>";
        while($row = $result->fetch_assoc()) {


            echo "<tr><td>".$row["account_id"]."</td><td>".$row["username"]."</td></tr>";

          }
          echo "</tbody></table></form>";


      }

    private function displaySqlInfo() {

      echo "The following is the CURRENT sql to display bugs: ";
      echo $this->sql_users;

    }


  }


if (isset($_POST['submit_remove'])) {

  $remove_user = new RemoveUser();
  $remove_user->user_count_test();

}

?>
<ul class="nav nav-tabs">
 <li><a href="main.php">Home</a></li>
 <li><a href="bug_review.php">Bug Review</a></li>
 <li><a href="view_deleted.php">Deleted Bugs</a></li>
 <li class="active"><a href="users.php">User Accounts</a></li>
 <li><a href="#">Advanced Search</a></li>
 <li><a href="account.php">Account Settings</a></li>
 <li><a href="../logout.php">Logout</a></li>
</ul>
<div class="user-count">
  <p id="user-count"><span class="glyphicon glyphicon-user"></span> Accounts: <?php
  $u = new Functions();
  $u->num_of_items(1); ?></p>
</div><br />
<div class="removeuserform">
  <form action="users.php" method="POST">
    <p id="larger">
      Enter Username ID:
    </p>
    <p>
      Removing users removes all privledges and access to report bugs for <?php echo $config['$company_name'];; ?>.<br />
      Please make sure you really want to remove the user before submitting.
    </p><br />
    <?php echo '<p>' . RemoveUser::$errorMessage .'</p>'; ?>
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
      </div><br />
    <button type="submit" name="submit_remove" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
<script type='text/javascript' src='../js/forms.js'></script>
<script type='text/javascript' src='../js/notification.js'></script>
</html>
<?php
      $display_users       = new UserList();
      $users_notification  = new Notification();

      $display_users->displayUsers();
      $users_notification->notifications();

      ?>
