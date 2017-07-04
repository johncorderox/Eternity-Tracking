<?php include 'main.php';

  if(isset($_POST['accept'])) {

      $request_id = $_POST['accept'];

      $sql_account_accept  = "INSERT INTO `users` (username, password, email) ";
      $sql_account_accept .= "SELECT `username`, `password`, `email` ";
      $sql_account_accept .= "FROM requests ";
      $sql_account_accept .= "WHERE `request_id` = '$request_id'";

      $result = mysqli_query($main->connect(), $sql_account_accept);
      if ($result) {

        $sql = "UPDATE requests SET request_status = 'closed'";
        mysqli_query($main_connect->connect(), $sql);
        header("Location: main.php?accept=1");
      }

  }


  if(isset($_POST['deny'])) {

    $request_id = $_POST['deny'];

    $sql_account_deny  = "UPDATE `requests` ";
    $sql_account_deny .= "SET `request_status` = 'closed' ";
    $sql_account_deny .= "WHERE `request_id` = '$request_id'";

    mysqli_query($main_connect->connect(), $sql_account_deny);

  }


?>
<body>
   <a href="main.php"><h5>Account Requests</h5></a>
    <hr />
    <div class="account_requests_view">
      <?php
      $sql_getRequests =  "SELECT `request_id`,`first_name`, `email`, `message`, `request_status` FROM requests";

        $result = mysqli_query($main_connect->connect(), $sql_getRequests);

        while ($row = mysqli_fetch_assoc($result)) {

          if ($row['request_status'] == "open") {

          echo '<b>Name: </b>'.$row["first_name"]. '<br />'.
          '<b>Email: </b>' .$row["email"]. '<br />'.
          '<b>Message: </b>' .$row["message"]. '<br />'.
          "<form action=\"account_requests.php\" method=\"POST\">".
          "<button type=\'submit\' name =\"accept\" value='".$row['request_id']."' />Accept</button>".
          "<button type=\'submit\' name =\"deny\" value='".$row['request_id']."'>Deny</button></form><br /><br />";

        }
      }
    ?>
    </div>

</body>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.account_requests_view').show();

});
</script>
