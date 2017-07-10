<div class="main-logs">
  <h5>Action logs</h5>
  <form action="main.php" method="POST">
    <div class="log-buttons">
      <button class="btn btn-success" id="view_login_logs_button" name="view_login">View Login Logs <span class="glyphicon glyphicon-eye-open"></span></button>
    </div>
  </form>

<?php

class Logs {

  private $action_log_limit = 10;
  private $login_log_limit = 10;

  public function view_more_action() {

    $this->action_log_limit = 10;
  }

  public function reset_action() {

    $this->action_log_limit = 5;
  }

  public function view_more_login() {

    $this->action_log_limit = 50;

  }

  public function reset_login() {

    $this->action_log_limit = 10;
  }

  public function cleanDate($old) {

    $phpdate = strtotime($old);
    $new = date('m-d-Y', $phpdate);
    return $new;

  }

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

}
$main_logs = new Logs();
$main_logs->display();

  if(isset($_POST['view'])) {

    $main_logs->view_more_action();
    $main_logs->display();
  }

  if(isset($_POST['reset'])) {

    $main_logs->reset_action();
    $main_logs->display();
  }


?>
</div>
