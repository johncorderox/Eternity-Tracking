<?php

include 'config.php';

// Open a new connection to the MySQL Server
$connect = mysqli_connect('$servername', '$username', '$password');
// Check connection of MySQL server
  if ($connect->connect_error) {

      die("Connection to MySQL Server: " . $servername . " returned 0. " . "<br />" .
          $connect->connect_error);

     );

  }
// Loads if connection is successful.

echo 'Successful connection to ' .$servername;



 ?>
