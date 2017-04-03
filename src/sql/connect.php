<?php

include ('../config/config.php');

$connect = new mysqli("$servername", "$username", "$password", "$database");

  if (!$connect) {

    die("ERROR in Connection! ! ! " .mysqli_connect_error());
  } else {
  }



?>
