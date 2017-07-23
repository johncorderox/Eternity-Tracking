
<?php
require '../header.php';
require '../lib/functions.php';
require '../lib/notification.php';

?>
<ul class="nav nav-tabs">
   <li><a href="main.php">Home</a></li>
   <li><a href="bug_review.php">Bug Review</a></li>
   <li class="active"><a href="view_deleted.php">Deleted Bugs</a></li>
   <li><a href="users.php">User Accounts</a></li>
   <li><a href="#">Advanced Search</a></li>
   <li><a href="account.php">Account Settings</a></li>
   <li><a href="../logout.php">Logout</a></li>
</ul>
<div class="delete-buttons">
  <form action="view_deleted.php" method="POST">
    <button type="submit" class="btn btn-danger btn-md" name="delete_all">Delete All</button>
  </form>
</div>
  <div class="delete-count">
    <p id="del-bugs"><span class="glyphicon glyphicon-trash"></span> Deleted Bugs: <?php
    $view_deleted = new Functions();
    $view_deleted ->num_of_items(2); ?></p>
  </div><br />
<script type='text/javascript' src='../js/notification.js'></script>
<?php
class viewDeleted {

  public $undelete_icon        = "<span class=\"glyphicon glyphicon-refresh\"></span>";
  public $sql_view_deleted     = "SELECT id, title, status, delete_date, deleted_by FROM deleted_bugs WHERE status = 'closed'";
  public $sql_destroy;
  public $sql_destroy_comments;
  public $id;
  public $undelete_sql;
  public $sql_delete_update;
  public $sql_delete_final;



  public function view_deleted_bugs() {

        $view_deleted = new Connect();

        $result = mysqli_query($view_deleted->connect(), $this->sql_view_deleted);
        $result_count = $result->num_rows;

            echo "<table class=\"table table-hover\" id=\"bug_table\">";
            echo "<thead> <tr> <tbody>";
            echo "<tr><th>ID: </th><th>Title</th><th>Status</th><th>Delete Date</th><th>Deleted By</th><th>Actions</th>";
            echo "</thead><tbody>";
            while($row = $result->fetch_assoc()) {


                echo "<tr><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["status"]."</td><td>".$row["delete_date"]."</td><td>";
                echo $row["deleted_by"]."</td>";
                echo "<form action=\"view_deleted.php\" method=\"POST\">";
                echo "<td><div class=\"btn-group\">
                  <button type\"submit\" class=\"btn btn-primary\" id=\"view_deleted\" name=\"undelete\" value='".$row['id']."'>Undelete ".$this->undelete_icon."</button>
                  <button type=\"submit\" class=\"btn btn-danger\" id=\"view_deleted\" name=\"destroy\" value='".$row['id']."'>Destroy</button>
                  </td>";

              }
              echo "</tbody></table></form>";


        }

        public function undelete() {

          $this->id = $_POST['undelete'];

          $this->undelete_sql  = "INSERT INTO `bugs` (id, title, message, priority, category, status, reported_by, date) ";
          $this->undelete_sql .= "SELECT `id`, `title`, `message`, `priority`, `category`, `status`, `deleted_by`, `delete_date` FROM deleted_bugs ";
          $this->undelete_sql .= "WHERE `id` = '$this->id' ";

          $this->sql_delete_update  = "UPDATE bugs SET `status` = 'open', reported_by = 'System', date = NOW() WHERE id = '$this->id' ";

          $this->sql_delete_final = "DELETE FROM deleted_bugs WHERE id = '$this->id' ";

          $undelete = new Connect();
          mysqli_query($undelete->connect(), $this->undelete_sql);
          mysqli_query($undelete->connect(), $this->sql_delete_update);
          $result = mysqli_query($undelete->connect(), $this->sql_delete_final);

            if($result) {

              header("Location: view_deleted.php?undelete=1");
              mysqli_close($undelete->connect());
            }



        }

        public function delete_all() {

          $sql_delete_all = "TRUNCATE `deleted_bugs`";
          $delete_all     = new Connect();

          $result = mysqli_query($delete_all->connect(), $sql_delete_all);

          if ($result) {

            header("Location:view_deleted.php?deleteall=1");
            mysqli_close($delete_all->connect());
          }
        }

        public function destroy() {

          $this->id = $_POST['destroy'];

          $this->sql_destroy          = "DELETE FROM deleted_bugs WHERE id = '$this->id'";
          $this->sql_destroy_comments = "DELETE FROM comments WHERE bug_id = '$this->id'";
          $destroy                    = new Connect();
          $result_destroy             = mysqli_query($destroy->connect(), $this->sql_destroy);
          $result_destroy_comments    = mysqli_query($destroy->connect(), $this->sql_destroy_comments);

          if ($result_destroy && $result_destroy_comments) {

              header("Location: view_deleted.php?destroy=1");
              mysqli_close($destroy->connect());
          }

        }


    }

    $view              = new viewDeleted();
    $view_notification = new Notification();

    $view->view_deleted_bugs();
    $view_notification->notifications();

if (isset($_POST['undelete'])) {

  $view->undelete();


}

if (isset($_POST['destroy'])) {


  $view->destroy();


}

if (isset($_POST['delete_all'])) {

  $view->delete_all();
}


?>
