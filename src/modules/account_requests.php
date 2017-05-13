<?php include 'main.php';?>
<body>
   <a href="main.php"><h5>Account Requests</h5></a>
    <hr />
    <div class="account_requests_view">
      <?php
      $sql_getRequests =  "SELECT `request_id`,`first_name`, `email`, `message` FROM requests";

        $result = mysqli_query($connect, $sql_getRequests);
        while ($row = mysqli_fetch_assoc($result)) {

            echo '<form action=\"account_requests.php\" method=\"POST">';
            echo '<p><b>First Name:</b> '.$row['first_name'] .'<br />';
            echo '<b>Email: </b>'. $row['email'].'<br />';
            echo '<b>Message: </b>'. $row['message']. '<br /><br />';
            echo '<button type=\"submit\">Accept</button>'.'<button type=\"submit\">Deny</button>';
            echo '</form>';
            echo '<br /><br /><br />';

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
