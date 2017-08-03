<div class="main-logs">
  <h5>Action Logs</h5>
    <div class="log-buttons">
      <button class="btn btn-success" onclick="reveal(0)" id="view_login_logs_button">View Login Logs <span class="glyphicon glyphicon-eye-open"></span></button>
    </div>
    <?php
    $main_logs = new Logs();
    $main_logs->display();
    ?>
  </div>
<div class="login-logs">
  <h5>Login logs</h5>
    <div class="log-buttons">
      <button class="btn btn-success" id="view_login_logs_button" onclick="reveal(1)">View Action Logs <span class="glyphicon glyphicon-eye-open"></span></button>
    </div>
    <?php

      $main_logs->display2();
     ?>
</div>

<?php

class Logs extends Functions{

  public $action_log_limit = 10;
  public $login_log_limit  = 10;

  public function display() {

    $log_connect = new Connect();

    $query_logs = "SELECT * from logs ORDER BY `action_id` DESC LIMIT $this->action_log_limit ";


    $result = mysqli_query($log_connect->connect(), $query_logs);

     while ($rows = mysqli_fetch_assoc($result)) {
       echo "<hr>";

       if ($rows['action'] == 'A') {

       echo $rows['log_user'] . ' added a new bug on ' .$this->cleanDate($rows['date']).'.<br>';

       }
       else if ($rows['action'] == 'D') {

       echo $rows['log_user'] . ' has deleted the bug ID '. $rows['action_value'] . ' on ' .$this->cleanDate($rows['date']).
            ' under the IP: '.$rows['ip'].'.<br>';

       }
      else if ($rows['action'] == 'AU') {

       echo $rows['log_user'] . ' created the user ' . $rows['action_value']. '.<br>';

       }
       else if ($rows['action'] == 'RU') {

       echo $rows['log_user'] . ' removed user ID '. $rows['action_value'].' on '.$this->cleanDate($rows['date']).

          ' under the IP: '.$rows['ip'].'.<br>';
     }

    }

  }

  public function display2() {

    $log_connect_2 = new Connect();

    $query_2 = "SELECT * FROM `login_log` ORDER BY 'log_id' DESC LIMIT $this->login_log_limit";

    $result = mysqli_query($log_connect_2->connect(), $query_2);

    while ($rows = mysqli_fetch_assoc($result)) {
      echo "<hr>";

      echo "Username: <b>" .$rows['username'] . '</b> had an ' .$rows['error_message']. ' on ' .$this->cleanDate($rows['date']).
      ' under the IP: '.$rows['ip'].'.<br>';

      }

    }

  }

?>
</div>
