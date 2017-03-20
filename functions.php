<?php

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

function num_of_deleted () {

  global $connect;
  global $database;
  mysqli_select_db($connect, $database);
  $sql = "SELECT COUNT(*) as total FROM deleted_bugs";
  $result = mysqli_query($connect, $sql);
  $number = mysqli_fetch_assoc($result);
  echo $number['total'];

}

// @desc Pings the MySQL Server and returns true if connected.
// Throws mysqli_connect_error if there are errors in config.php. Global is
// used to grab variable from connect.
  function check_mysql_server_status() {
      global $connect;

        if(mysqli_ping($connect)) {
          echo ' Connected';
        }
      }

function getLastBug() {

global $connect;
global $database;

if ($connect) {

  $sql = "SELECT message from `bugs` ORDER BY `id` DESC LIMIT 1";
  $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) != 1) {

        echo '<p>Your bug list is currently empty.</p>';
    } else {

        while ($row = mysqli_fetch_assoc($result)) {

          echo '<p><b>Last bug reported:</b> '  .$row['message'].'</p>';
        }
    }

}



}

 ?>
