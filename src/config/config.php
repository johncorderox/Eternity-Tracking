<?php

$servername = 'localhost';                  // Host Name
$username = 'root';                         // Username for the Database
$password = '';                             // Password   (If using locally, leave blank)
$database = 'tracking';                     // Database name to host Tracking Tables

$company_name = "Eternity LLC";             // Company Name for main module


$connect = new mysqli("$servername", "$username", "$password", "$database");

  if ($connect->connect_error) {

    die($connect->connect_error);

  }


 ?>
