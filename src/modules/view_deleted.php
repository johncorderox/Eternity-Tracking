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


$undelete_icon = "<span class=\"glyphicon glyphicon-refresh\"></span>";

        $sql_view_deleted = "SELECT * FROM deleted_bugs WHERE status = 'closed'";

        $result = $connect->query($sql_view_deleted);
        $result_count = $result->num_rows;


        echo "<table class=\"table table-hover\">";
        echo "<thead> <tr> <tbody>";
        echo "<tr><th>ID: </th><th>Title</th><th>Status</th><th>Deleted By</th><th>Actions</th>";
        echo "</thead><tbody>";
        while($row = $result->fetch_assoc()) {

            echo "<tr><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["status"]."</td><td>".$row["deleted_by"]."</td>";
            echo "<td><div class=\"btn-group\">
              <button type\"button\" class=\"btn btn-primary\" id=\"view_deleted\">Undelete ".$undelete_icon."</button>
              <button type=\"button\" class=\"btn btn-primary\" id=\"view_deleted\">Destroy</button>
            </td>";

          }echo "</tbody></table>";

?>
<body>

</body>
<script type='text/javascript' src='../js/view.js'></script>
<script>
 hideLogs();
</script>
