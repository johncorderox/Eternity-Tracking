<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'tracking';

$company_name = "Eternity LLC";


$connect = new mysqli("$servername", "$username", "$password", "$database");

  if (!$connect) {

    die("ERROR in Connection! ! ! " .mysqli_connect_error());
  } else {
  }



 ?>
