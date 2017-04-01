<html lang="en">
  <head>
    <meta charset="UTF-8">
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/interface.css" rel="stylesheet" />
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
          <button name="exit" id="exit">Exit</button>
        </form>
      </div>
  </div>

</body>
  <script type='text/javascript' src='../js/delete.js'></script>
</html>

<?php

include('../config/config.php');
include('../lib/functions.php');
include '../lib/secure.php';

  if (isset($_POST['del_all'])) {

        if (!empty($_POST['del_pass'])) {

              $del_pass = trims($_POST['del_pass']);

              if ($del_pass == "password") {

                $sql = "TRUNCATE TABLE bugs";
                mysqli_query($connect, $sql);
                header("Location: main.php");

              } else {

                header("Location: main.php");
              }

        }
  }

  else if (isset($_POST['exit'])) {

      header("Location: main.php");

  }
