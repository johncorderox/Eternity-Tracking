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



function trims($inputs) {

  $inputs = trim($inputs);
  $inputs = stripslashes($inputs);
  $inputs = htmlspecialchars($inputs);

  return $inputs;

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

    case an:

        header("Location: add_new_user.php");
        break;

    case r:

        header("Location: remove_user_main.php");
        break;

      }

}


 ?>
