<?php

$company_name                     = "Eternity LLC"; // Company Name for main module

$MinPasswordLength                = 8;              // Password Length variable
$MaxPasswordLength                = 32;             // Max Password Legnth. DO NOT INCREASE WITHOUT CONSULTING THE SQL TABLE
$allowMultiEmail                  = FALSE;          // Register new accounts with the same emails.
$allowLoginLog                    = TRUE;           // Logs login for success and fail



class Connect {

  public $servername = 'localhost';
  public $username   = 'root';
  public $password   = '';
  public $database   = 'tracking';

  public function connect() {

    $this->connect = new mysqli($this->servername, $this->username, $this->password, $this->database);

    return $this->connect;
  }


}



 ?>
