<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'tracking';

$connect = new mysqli("$servername", "$username", "$password", "$database");

  if (!$connect) {

    die("ERROR in Connection! ! ! " .mysqli_connect_error());
  } else {


    /*
    echo 'Connection Successful to ' .$servername;
*/
  }


/*
  $results = $connect->query("SELECT id, title, message FROM bugs");

  while ($row=$results->fetch_assoc()) {


    echo $row['id'] + '<br />' . $row['title'] . '<br />' . $row['message'];
  }
*/

//mysqli_close($connect);
?>
