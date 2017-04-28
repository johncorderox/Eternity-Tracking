<?php

    $sql = "SELECT id, title, message, priority, category FROM bugs";
    mysqli_select_db($connect, $database);

    $result = mysqli_query($connect, $sql);

    echo "<div id=\"table_bugs\">";
    echo "<table><tr><th>ID: </th><th>Title</th><th>Message</th><th>Priority</th><th>Category</th>";
      while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr><td>".$row["id"]."</td><td>".$row["title"].
        "</td><td>".$row["message"]."</td><td>".$row["priority"]."</td><td>"."<button name=\'delete\' value='".$row['id']."' />View</button></td></tr>";
        echo "</div>";

      }


 ?>
