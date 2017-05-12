<?php

include ('../config/config.php');
include ('../lib/secure.php');

if (isset($_POST['cancel'])) {

  header("Location: ../index.php");
}


if(isset($_POST['send_request'])) {

  $first    = trims($_POST['first_name']);
  $last     = trims($_POST['last_name']);
  $username = trims($_POST['username']);
  $email = trims($_POST['email']);
  $email = email_clean($email);
  $password = trims($_POST['password']);
  $password = md5($password);
  $message  = trims($_POST['message']);
  $ip       = $_SERVER['REMOTE_ADDR'];
/*
    if (empty($first)) {

    }
    else if (empty($last)) {


    } else if (empty($username)) {


    } else if (empty($email)) {


    }else if (empty($password)) {


    }
          else {
*/
            $sql_username = "SELECT username FROM users WHERE username = '$username'";
            $sql_email = "SELECT email FROM users WHERE email = '$email'";

            $result_user = mysqli_query($connect, $sql_username);
            $result_email = mysqli_query($connect, $sql_email);

              if(mysqli_num_rows($result_user) >= 1) {

                echo "Username Taken";
              } else if (mysqli_num_rows($result_email)) {

                echo "email taken!";
              }


                  $sql_request = "INSERT INTO `requests` (first_name, last_name, username, password, email, message, date, ip)
                  VALUES ('$first', '$last', '$username','$password','$email', '$message', NOW(), '$ip');
                  ";
                  $result_request = mysqli_query($connect, $sql_request) or die(mysqli_error($connect));
                  if($result_request) {

                      header("Location: ../index.php");
                  }

    //  }

}


?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>
  <link href="../css/interface.css" rel="stylesheet" />
  <title>Request Form</title>
  <div class="header-name">
    <a href="../index.php"><h3>Request Form</h3></a>
  </div>
</head>
<body>
  <hr />
<div class="form-body">
</div>
<div class="request-container">
  <p id="larger">
    All information will be recorded and sent to the team for review. Once accepted, you'll be able to access the software.
  </p>
  <p id="etc">
    Please use real information so the team can identify who you are and accept/deny the request.
  </p><br />

<form action="request.php" method="POST">
  <input type="text" id="small_input" placeholder="First Name*" name="first_name" autofocus/>
  <input type="text" id="small_input2" placeholder="Last Name*" name="last_name"/><br />
  <input type="text" placeholder="Desired Username*" name="username"/><br />
  <input type="email" placeholder="Email*" name="email"/><br />
  <input type="password" placeholder="Enter a Password*" name="password"/><br />
  <textarea placeholder="Message to the Admin" class="form-control" rows="5" name="message"></textarea><br />
  <button type="submit" class="btn btn-primary" name="send_request">Submit  <span class="glyphicon glyphicon-ok"></span></button>
  <button type="submit" class="btn btn-primary" name="cancel"> Cancel </button>
</div>
</div>
</form>
</div>
</body>
</html>
