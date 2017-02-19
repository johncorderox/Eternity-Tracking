<?php

include ('config.php');
include ('connect.php');
include ('functions.php');



if (isset($_POST['submit'])) {

  $title = $_POST['title'];
  $message = $_POST['message'];
  $priority = $_POST['priority'];


    if(empty($title) || (empty($message))) {

      add_response(0);
      die();

    }
      $sql = "INSERT INTO bugs (title, message, priority) VALUES ('$title','$message', '$priority')";

      mysqli_select_db($connect, $database);
      $query = mysqli_query($connect, $sql);

      if ($query ==  TRUE) {

            add_response(1);
            die();

      }
    }

    if (isset($_POST['submit2'])) {

      $title = $_POST['title'];
      $message = $_POST['message'];
      $priority = $_POST['priority'];

        }
          $sql = "INSERT INTO bugs (title, message, priority) VALUES ('$title','$message', '$priority')";

          mysqli_select_db($connect, $database);
          $query = mysqli_query($connect, $sql);

          if ($query ==  TRUE) {

            

          }
          header("Location: main.php");



?>
