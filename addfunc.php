<?php

include ('config.php');
include ('connect.php');



if (isset($_POST['submit'])) {

  $title = $_POST['title'];
  $message = $_POST['message'];

    if(empty($title || $message)) {
      echo '<script type="text/javascript">
            display_input_message(1);
            </script>';
            die();
    }
    else {

/*
      $sql = "INSERT INTO bugs (title, message) VALUES ('$title','$message')";

      mysqli_select_db($connect, $database);
      $query = mysqli_query($connect, $sql);

      if ($query ==  TRUE) {
*/

            
            header("Location: add.php?success=0");
            die();





      }



}
//}

?>
