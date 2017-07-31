
<h1 align="center">Eternity Tracking</h1> <br>
<p align="center">
<b>A modern and productive bug tracker for completing tasks.</b><br>
<a align="center" href="https://eternity-tracking.000webhostapp.com/Eternity-Tracking/Eternity-Tracking/src/index.php">Demo</a>
<br>
A PHP based tracking system that allows small teams to organize, add, delete, and maintain bugs within a system. Includes Account management and web application security. An easy-to-install program that allows developers to build off of.<br>
<a href="https://gifyu.com/image/zHW2"><img src="https://gifyu.com/images/K9dvO5Mb0u.gif" alt="K9dvO5Mb0u.gif" border="0" /></a><br /<br /><br></p>

## Features
- **Login System** - Users have access to Login/Logout via Sessions. 
- **Bug Review** - The ultimate review system for bug reporting.
- **Logging System** - Logs login logs and bug related logs for the CP.
- **User Accounts** - Adding/Removing Users.
- **Comments** - Users can interact and add/delete comments on each bug. 
- **Account Settings** - Password Changes, Email changes, Reset Login Counts, View Bug Stats.
- **Deleted Bugs** - Users can undelete/destroy bugs from the system.


## Requirements
PHP 5.4+ <br>
MySQL 5+<br>
<br>

## Installation


Run the `database.sql ` file and make sure the admin insert query has ran.<br>
Locate the Connect Class and update the values with your host information.<br>


```php

      public $servername = 'localhost';
      public $username   = 'root';
      public $password   = '';
      public $database   = 'tracking';

```

## Configuration 

You may also use the `config.php` file to adjust some changes to your project management tool.

```php

$config = array(

  '$company_name'                   => 'Eternity LLC',  // Company Name for main module

  '$MinPasswordLength'              => 8,              // Password Length variable
  '$MaxPasswordLength'              => 32,             // Max Password Legnth.
  '$allowMultiEmail'                => FALSE,          // Register new accounts with the same emails.
  '$allowLoginLog'                  => TRUE,          // Logs login for success and fail


);

```
