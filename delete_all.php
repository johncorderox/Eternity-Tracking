<html lang="en">
  <head>
    <meta charset="UTF-8">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="src/css/interface.css" rel="stylesheet" />
  </head>
  <body>
<div class="center center-delete">
  <div class="first">
    <h2>Are you sure you want to delete all bugs?</h2>
        <br />
          <input type="text" class="modern-input" id="answer_del"/><br />
          <button id="submit_button" onclick="getDeleteAnswer()">Submit</button>
      </div>
      <div class="second">
        <form action="delete_all.php" method="post">
          <h2>Enter the Password for your MySQL connection:  </h2>
          <input type="password" class="modern-input" name="del_pass" />
          <button id="submit_button_2" name="del_all">Delete All</button>
          <button name="abort">Abort</button>
        </form>
      </div>
  </div>

</body>
  <script type='text/javascript' src='src/js/delete.js'></script>
</html>

<?php

include 'connect.php';

  if (isset($_POST['del_all'])) {

        if (!empty($_POST['del_pass'])) {

              $del_pass = $_POST['del_pass'];

              if ($del_pass == "password") {

                $sql = "TRUNCATE TABLE bugs";
                mysqli_query($connect, $sql);
                header("Location: main.php");

              }

        }
  }
