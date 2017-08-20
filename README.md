
<h1 align="center">Eternity Tracking</h1>
<p align="center">
<img src="https://img.shields.io/github/release/johncorderox/Eternity-Tracking.svg">
<img src="https://img.shields.io/github/commits-since/johncorderox/Eternity-Tracking/v.2.0.svg">
<br>
<strong>A modern and productive bug tracker for completing tasks.</strong><br>
A PHP based tracking system that allows small teams to organize, add, delete, and maintain bugs within the system. An easy-to-install program that allows developers to build off of.<br>
<a href="https://gifyu.com/image/zHW2"><img src="https://gifyu.com/images/K9dvO5Mb0u.gif" alt="K9dvO5Mb0u.gif" border="0" /></a><br />


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

You can download the project using git clone ```https://github.com/johncorderox/Eternity-Tracking.git``` or via release pages <a href="https://github.com/johncorderox/Eternity-Tracking/releases/tag/v.2.0">here</a> to download specific versions.

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
## License 
Eternity Tracing is currently under the Apache License 2.0 and you can find out more about it <a href="https://github.com/johncorderox/Eternity-Tracking/blob/master/LICENSE">here</a>

## About the Author

I am a Software Developer based in Los Angeles and you can <a href="https://www.twitter.com/johncorderox">tweet <a>me if you'd like.<br>
I take all suggestions, comments and compliments! 
