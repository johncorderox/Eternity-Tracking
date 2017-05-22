<div class="sidebar">
  <p id="cancel">
    <a href="javascript:void(0)">&times;</a>
  </p><br />
    <h4>Logs</h4>

  <?php

  $query_logs = "SELECT * from logs ORDER BY `action_id` DESC";
  $result = $connect->query($query_logs);
    while($rows= $result->fetch_assoc()) {

        echo "<hr id=\"hr_logs\">";
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
