<?php
include 'main.php';

  $connected = mysqli_select_db($connect, $database);
  if($connected) {

    $sql = "SELECT `email`, `account_count`, `last_ip` FROM users WHERE username = '$logged'";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

      $email = $row['email'];
      $account_count = $row['account_count'];
      $ip = $row['last_ip'];

    }

  }
 ?>
 <body>
   <div class="account_settings">
     <h5>Account Settings</h5>
     <hr />
     <div class="panel panel-info">
  <div class="panel-heading"> Menu:
    <span id="space">Change Password</span>
    <span id="space">Change Email</span>
    <span id="space">Reset Login Count</span>
  </div>
</div>
    <div class="account_info">
      <p>Username: <?php echo $logged; ?> </p>
      <p>Email: <?php echo $email; ?></p>
      <p>Login Count: <?php echo $account_count; ?> </p>
      <p>Last IP: <?php echo $ip; ?> </p><br />
      <p>Number of bugs reported: </p>
      <p>Number of bugs deleted:  </p>
    </div>
   </div>
 </body>

 <script>
 $(document).ready(function() {

   $('.ui-main-button-group').hide();


 });

 </script>
