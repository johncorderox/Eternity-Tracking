<?php

if (isset($_POST['cancel'])) {

  header("Location: ../index.php");
}


if(isset($_POST['send_request'])) {

  $first    = $_POST['first_name'];
  $last     = $_POST['last_name'];
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $password = $_POST['password'];
  $message  = $_POST['message'];

    if (empty($first)) {

    }
    else if (empty($last)) {


    } else if (empty($username)) {


    } else if (empty($email)) {


    }else if (empty($password)) {

      
    }




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
<?php echo $error; ?><br />
  <p id="larger">
    All information will be recorded and sent to the team for review. Once accepted, you'll be able to access the software.
  </p>
  <p id="etc">
    Please use real information so the team can identify who you are and accept/deny the request.
  </p><br />
<div class="request-container">
<form action="request.php" method="POST">
  <input type="text" id="small_input" placeholder="First Name*" name="first_name"/>
  <input type="text" id="small_input" placeholder="Last Name*" name="last_name"/><br />
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
