<?php

include "../config/config.php";

ob_start();
session_start();

$id       = $_POST['id'];
$title    = $_POST['title'];
$category = $_POST['category'];
$priority = $_POST['priority'];
$message  = $_POST['message'];

if (isset($_POST['cancel'])) {

  header("Location: ../modules/main.php");
}


if (isset($_POST['save'])) {

      $sql = "UPDATE bugs SET title = '$title', category = '$category', priority = '$priority', message = '$message' WHERE id = '$id' ";

      mysqli_query($connect, $sql) or die(mysqli_error($connect));

      header("Location: ../modules/main.php?savebug=1");




}

if (isset($_POST['delete'])) {

  $sql = "DELETE FROM bugs WHERE id = " .$id;
  $sql_copy = "INSERT INTO deleted_bugs (id, title, message, priority) SELECT `id`,`title`, `message`, `priority` from bugs WHERE id = '$id'";
  $sql_insert ="UPDATE deleted_bugs SET deleted_by = '{$_SESSION['username']}', delete_date = NOW() WHERE id = '$id'";
  $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','D','{$_SESSION['username']}', '$id', NOW(), '$ip')";

        mysqli_select_db($connect, $database);

          // Moves data into another table
          mysqli_query($connect, $sql_copy) or die(mysqli_error($connect));
          // Adds remaining values to new table
          mysqli_query($connect, $sql_insert) or die(mysqli_error($connect));
          // Deletes the bug ID number
          mysqli_query($connect, $sql);
          // Logs the deleted bug
          mysqli_query($connect, $sql_log);
          // Successful redirect
          header("Location: ../modules/main.php?deletebug=1");


}


 ?>
