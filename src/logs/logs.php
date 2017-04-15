<?php

include ('../header.php');

include ('../config/config.php');

 ?>
<body>
  <h5>Logs</h5>
</body>
<?php



$query_logs = "SELECT * from logs ORDER BY `action_id` DESC";
$result = mysqli_query($connect, $query_logs);
  while($rows=mysqli_fetch_assoc($result)) {

      if ($rows['action'] == 'A') {
        $a = "added";

      echo $rows['log_user'] . ' added a new bug on '. $rows['date'] . '.<br>';
      echo '<hr />';

      } else if ($rows['action'] == 'D') {

        echo $rows['log_user'] . ' has deleted the bug ID '. $rows['action_value'] . '.<br>';
        echo '<hr />';
      }
     else if ($rows['action'] == 'AU') {
      echo $rows['log_user'] . ' created the user ' . $rows['action_value']. '.<br>';
      echo '<hr />';
      }
      else if ($rows['action'] == 'RU') {
     echo $rows['log_user'] . ' removed user ID '. $rows['action_value']. '.<br>';
     echo '<hr />';
    }
  }


?>
