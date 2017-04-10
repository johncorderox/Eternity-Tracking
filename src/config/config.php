<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'tracking';


$company_name = "Eternity LLC";
$max_logs = 100; // max amount of logs displayed.


$connect = new mysqli("$servername", "$username", "$password", "$database");

  if (!$connect) {

    die("ERROR in Connection! ! ! " .mysqli_connect_error());

  }


 ?>
