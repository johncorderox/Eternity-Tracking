<?php

    $sql = "SELECT id, title, message, priority, category FROM bugs";
    mysqli_select_db($connect, $database);

    $result = $connect->query($sql);


    echo "<table><tr><th>ID: </th><th>Title</th><th>Actions</th>";
      while ($row = $result->fetch_assoc()) {

        echo "<tr><td>".$row["id"]."</td><td>".$row["title"].
        "</td><td>".
        "<form action=\"view.php\" method=\"POST\">".
        "<button type=\'submit\' class=\"view_buttom\" name =\"id\" value='".$row['id']."' />View</button></td></tr>
        </form>";

      }

 ?>
