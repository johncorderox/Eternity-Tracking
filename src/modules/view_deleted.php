<?php
require 'module_header.php';
require ('../lib/connect.php');
?>
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

            echo "<table class=\"table table-hover\">";
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

          $this->sql_delete_update  = "UPDATE status, reported_by, date SET `status` = 'open', reported_by = 'System', date = NOW() WHERE id = '$this->id' ";

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

    $view = new viewDeleted();

    $view->view_deleted_bugs();

if (isset($_POST['undelete'])) {

  $view->undelete();


}

if (isset($_POST['destroy'])) {


  $view->destroy();


}


?>
<script type='text/javascript' src='../js/notification.js'></script>
<?php

if (isset($_GET['undelete']) && $_GET['undelete'] == 1) {

  echo '<script type="text/javascript">
        display_input_message(13);
        </script>';
}

if (isset($_GET['destroy']) && $_GET['destroy'] == 1) {

  echo '<script type="text/javascript">
        display_input_message(14);
        </script>';
}

?>
