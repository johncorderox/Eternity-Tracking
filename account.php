<?php
include 'main.php';

  $connected = mysqli_select_db($connect, $database);
  if($connected) {

    $sql = "SELECT `email`, `account_count` FROM users WHERE username = '$logged'";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

      $email = $row['email'];
      $account_count = $row['account_count'];

    }


  }





 ?>
 <body>
   <div class="account_settings">
     <h5>Account Settings</h5>
     <hr />
     <button>Password</button>
     <button>Email:</button>
     <br />
     <hr />
     <p>Username: <?php echo $logged; ?> </p>
     <p>Email: <?php echo $email; ?></p>
     <p>Login Count: <?php echo $account_count; ?> </p>
     <p>Last IP: </p><br />
     <p>Number of bugs reported: </p>
     <p>Number of bugs deleted:  </p>
   </div>
 </body>

 <script>
 $(document).ready(function() {

   $('.ui-main-button-group').hide();


 });

 </script>
