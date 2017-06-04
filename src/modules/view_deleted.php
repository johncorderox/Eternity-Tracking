<?php
include 'module_header.php';
include('../config/config.php');
include('../lib/functions.php');
include ('../lib/secure.php');


//ADD SEARCH FUNCTIONS?
//
//
//
//

if (isset($_POST['undelete'])) {

  $id = $_POST['undelete'];

      $sql  = "INSERT INTO `bugs` (id, title, message, priority, category, status, reported_by, date) ";
      $sql .= "SELECT `id`, `title`, `message`, `priority`, `category`, `status`, `deleted_by`, `delete_date` FROM deleted_bugs ";
      $sql .= "WHERE `id` = '$id' ";

      $sql_value_change  = "UPDATE status, reported_by, date SET `status` = 'open', reported_by = 'System', date = NOW() WHERE id = '$id' ";

      $sql_delete = "DELETE FROM deleted_bugs WHERE id = '$id' ";

     $connect->query($sql);
     $connect->query($sql_value_change);
     $connect->query($sql_delete);


}

$undelete_icon = "<span class=\"glyphicon glyphicon-refresh\"></span>";

        $sql_view_deleted = "SELECT id, title, status, delete_date, deleted_by FROM deleted_bugs WHERE status = 'closed'";

        $result = $connect->query($sql_view_deleted);
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
              <button type\"submit\" class=\"btn btn-primary\" id=\"view_deleted\" name=\"undelete\" value='".$row['id']."'>Undelete ".$undelete_icon."</button>
              <button type=\"submit\" class=\"btn btn-danger\" id=\"view_deleted\" name=\"destroy\" value='".$row['id']."'>Destroy</button>
              </td>";
          }
          echo "</tbody></table></form>";

?>
<body>

</body>
<script type='text/javascript' src='../js/view.js'></script>
<script>
 hideLogs();
</script>
