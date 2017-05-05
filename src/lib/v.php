<?php

include "../config/config.php";


if (isset($_POST['cancel'])) {

  header("Location: ../modules/main.php");
}


if (isset($_POST['save'])) {

    //  $title_2    = $_POST['title'];
      $category = $_POST['category'];
      $priority = $_POST['priority'];
      $message  = $_POST['message'];


      $sql = "UPDATE bugs SET `category` = '$category' WHERE id = '$bug_id'";

      mysqli_query($connect, $sql);

      header("Location: ../modules/main.php");




}







 ?>
