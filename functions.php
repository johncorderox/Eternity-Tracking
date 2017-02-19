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

// @desc connects to MySQL and queries the DB for a count.
// uses the function COUNT and echo's the num
function num_of_bugs() {

global $connect;
global $database;

if($connect) {
  mysqli_select_db($connect, $database);
  if(!$database){
    die('Database Not Found! ! ! ');
  }
  $sql = "SELECT COUNT(*) as total FROM bugs";
  $result = mysqli_query($connect, $sql);
  $number = mysqli_fetch_assoc($result);
  echo $number['total'];

  }

}

// @des connects and uses the count function to return n results.

function num_of_accounts () {

  include "connect.php";
  $sql = "SELECT COUNT(*) as total FROM users";
  $result = mysqli_query($connect, $sql);
  $number = mysqli_fetch_assoc($result);
  echo $number['total'];

}

function add_response ($x) {

  $x == 0 ? header("Location: add.php?success=0") : header("Location: add.php?success=1");

}


 ?>
