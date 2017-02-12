<?php

include ('config.php');
include ('connect.php');
include ('functions.php');



if (isset($_POST['submit'])) {

  $title = $_POST['title'];
  $message = $_POST['message'];

    if(empty($title) || (empty($message))) {

      add_response(0);
      die();

    }
      $sql = "INSERT INTO bugs (title, message) VALUES ('$title','$message')";

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

        }
          $sql = "INSERT INTO bugs (title, message) VALUES ('$title','$message')";

          mysqli_select_db($connect, $database);
          $query = mysqli_query($connect, $sql);

          if ($query ==  TRUE) {

            echo '<p>
            done
            </p>';

          }
          header("Location: main.php?successinput");



?>
