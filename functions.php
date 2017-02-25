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

// @decs adds true or false for the header pages after submission
// used for the view of the application, NOT the owner. 

function add_response ($x) {

  $x == 0 ? header("Location: add.php?success=0") : header("Location: add.php?success=1");

}
// Calls headers within the application and redirects the user
// each case is determined by the first letter of each page
// @args prefix of page
function pages ($l) {

  switch($l) {
    case m:
            header("Location: main.php");
            break;
    case a:

          header("Location: add_main.php");
          break;

    case e:

          header("Location: edit_main.php");
          break;

    case d:

        header("Location: delete_main.php");
        break;

    case a:

        header("Location: add_new_user.php");
        break;

    case r:

        header("Location: remove_user_main.php");
        break;

      }

}
 ?>
