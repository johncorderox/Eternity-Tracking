<?php

$servername                       = 'localhost';   // Host Name
$username                         = 'root';        // Username for the Database
$password                         = '';            // Password   (If using locally, leave blank)
$database                         = 'tracking';    // Database name to host Tracking Tables

$company_name                     = "Eternity LLC"; // Company Name for main module

$MinPasswordLength                = 8;              // Password Length variable
$MaxPasswordLength                = 32;             // Max Password Legnth. DO NOT INCREASE WITHOUT CONSULTING THE SQL TABLE
$allowMultiEmail                  = FALSE;          // Register new accounts with the same emails.
$allowLogSearch                   = TRUE;           // Logs login for success and fail





$connect = new mysqli("$servername", "$username", "$password", "$database");

  if ($connect->connect_error) {

    die($connect->connect_error);

  }


 ?>
