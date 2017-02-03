<?php

// @desc Pings the MySQL Server and returns true if connected.
// Throws mysqli_connect_error if there are errors in config.php. Global is
// used to grab variable from connect.
function check_mysql_server_status() {

  global $connect;
  if(mysqli_ping($connect)) {
    echo ' Connected';
  }
}
 ?>
