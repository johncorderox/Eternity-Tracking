<?php

include "../config/config.php";

ob_start();
session_start();

$id       = $_POST['id'];
$title    = $_POST['title'];
$category = $_POST['category'];
$priority = $_POST['priority'];
$message  = $_POST['message'];
$user     = $_SESSION['username'];
$ip       = $_SERVER['REMOTE_ADDR'];

if (isset($_POST['cancel'])) {

  header("Location: ../modules/main.php");
}


if (isset($_POST['save'])) {

      $sql = "UPDATE bugs SET title = '$title', category = '$category', priority = '$priority', message = '$message' WHERE id = '$id' ";

      $connect->query($sql);
      header("Location: ../modules/main.php?savebug=1");


}

if (isset($_POST['delete'])) {

  $sql = "DELETE FROM bugs WHERE id = " .$id;
  $sql_copy = "INSERT INTO deleted_bugs (id, title, message, priority) SELECT `id`,`title`, `message`, `priority` from bugs WHERE id = '$id'";
  $sql_insert ="UPDATE deleted_bugs SET deleted_by = '{$_SESSION['username']}', delete_date = NOW() WHERE id = '$id'";
  $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','D','{$_SESSION['username']}', '$id', NOW(), '$ip')";

        mysqli_select_db($connect, $database);

          // Moves data into another table
          $connect->query($sql_copy);
          // Adds remaining values to new table
          $connect->query($sql_insert);
          // Deletes the bug ID number
          $connect->query($sql);
          // Logs the deleted bug
          $connect->query($sql_log);
          // Successful redirect
          header("Location: ../modules/main.php?deletebug=1");


}

if (isset($_POST['add_comment'])) {

  $comment = $_POST['comment'];

    if($comment == "") {

      header("Location: ../modules/main.php");

    }

    $sql_insert = "INSERT INTO `comments` (comment_id, bug_id, comment, comment_by, date, ip) VALUES('', '$id', '$comment', '$user', NOW(), '$ip')";

     $result = $connect->query($sql_insert) or die ($connect->error);
     if ($result) {

        header("location: ../modules/main.php");
      }

}


 ?>
