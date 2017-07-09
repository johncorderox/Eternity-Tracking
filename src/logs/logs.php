<div class="main-logs">
  <h5>Action logs</h5>
  <form action="main.php" method="POST">
    <div class="log-buttons">
      <button class="btn btn-success" id="view_logs_button" name="view">View More</button>
      <button class="btn btn-danger" name="reset">Reset</button>
    </div>
  </form>

<?php

  $log_limit = 3;

  if(isset($_POST['view'])) {

    $log_limit = 100;
  }

  if(isset($_POST['reset'])) {

    $log_limit = 3;
  }



$query_logs = "SELECT * from logs ORDER BY `action_id` DESC LIMIT $log_limit";
$result = mysqli_query($main_connect->connect(), $query_logs);

 while ($rows = mysqli_fetch_assoc($result)) {
   echo "<hr>";
   if ($rows['action'] == 'A') {
   $phpdate = strtotime($rows['date']);
   $clean_date = date('m-d-Y', $phpdate);

   echo $rows['log_user'] . ' added a new bug on '. $clean_date . '.<br>';
   }
   else if ($rows['action'] == 'D') {
   echo $rows['log_user'] . ' has deleted the bug ID '. $rows['action_value'] . '.<br>';
   }
  else if ($rows['action'] == 'AU') {
   echo $rows['log_user'] . ' created the user ' . $rows['action_value']. '.<br>';
   }
   else if ($rows['action'] == 'RU') {
  echo $rows['log_user'] . ' removed user ID '. $rows['action_value']. '.<br>';
 }
}
?>
</div>
