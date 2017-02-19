<?php

include ('config.php');
include ('connect.php');
include ('functions.php');

  if(isset($_POST['submit_edit'])) {

      if(!empty($_POST['first']) && !empty($_POST['second'])) {

        $username = $_POST['first'];
        $password = $_POST['second'];

        $sql = "INSERT INTO users (username, password) VALUES ('$username', $password)";

        mysqli_select_db($connect, $database);


        mysqli_query($connect, $sql);



      }


  }




?>
