<?php
$sql = "SELECT * FROM users";

mysqli_select_db($connect, $database);

$result = $connect->query($sql);

  echo "<div id=\"table_users\">";
  echo "<table><tr><th>ID</th><th>Username</th></tr>";
  
    while ($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["account_id"]."</td><td>".$row["username"]."</td></tr>";
    echo "</div>";
}
?>
