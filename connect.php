<?php

require 'config.php';

// Open a new connection to the MySQL Server
$connect = mysqli_connect('$servername', '$username', '$password', '$database');
// Check connection of MySQL server
  if ($connect->connect_error) {

      die($connect->connect_error);



  }
// Loads if connection is successful.

echo 'Successful connection to ' .$servername . '<br />';
/* for later

<?php
  if(isset($_POST['submit'])) {

    if (!$connect) {
      die(mysqli_connect_error());
    } else {


        $title = $_POST['title'];
        $message = $_POST['message'];

        $q = "INSERT INTO bugs (title, message)
  VALUES ($title,$message)";

        if (mysqli_query($connect, $q)) {


          $connect->close();
        }
    }



  }


?>

*/
 ?>
