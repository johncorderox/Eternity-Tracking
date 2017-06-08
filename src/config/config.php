<?php

$servername                       = 'localhost';   // Host Name
$username                         = 'root';        // Username for the Database
$password                         = '';            // Password   (If using locally, leave blank)
$database                         = 'tracking';    // Database name to host Tracking Tables

$company_name                     = "Eternity LLC"; // Company Name for main module

$MinPasswordLength                = 8;              // Password Length variable
$MaxPasswordLength                = 32;             // Max Password Legnth. DO NOT INCREASE WITHOUT CONSULTING THE SQL TABLE
$allowMultiEmail                  = FALSE;          // Register new accounts with the same emails.
$allowLogLogin                   = TRUE;           // Logs login for success and fail




class Connect {

  protected $servername = 'localhost';
  protected $username = 'root';
  protected $password = '';
  protected $database = 'tracking';

  public function connect() {

    $connect = new mysqli($this->servername, $this->username, $this->password, $this->Database);

     if ($connect->connect_error) {

       die($connect->connect_error);

     }


  }

}

 ?>
