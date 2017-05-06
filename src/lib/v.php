<?php

include "../config/config.php";


if (isset($_POST['cancel'])) {

  header("Location: ../modules/main.php");
}


if (isset($_POST['save'])) {

      $id       = $_POST['id'];
      $title    = $_POST['title'];
      $category = $_POST['category'];
      $priority = $_POST['priority'];
      $message  = $_POST['message'];


      $sql = "UPDATE bugs SET title = '$title', category = '$category', priority = '$priority', message = '$message' WHERE id = '$id' ";

      mysqli_query($connect, $sql) or die(mysqli_error($connect));

      header("Location: ../modules/main.php");




}


 ?>
