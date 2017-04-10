<?php

include ('../header.php');

include ('../config/config.php');

 ?>
<body>
  <h5>Logs</h5>
</body>
<?php

    $query_logs = "SELECT * from bugs";
    $result = mysqli_query($connect, $query_logs);

      while($rows=mysqli_fetch_assoc($result)) {

          if ($rows['action'] == 'A') {

            echo $rows['username'] . ' added a new bug on '. $rows['date'] . '<br>';

          } else if ($rows['action'] == 'D') {

            echo $rows['username'] . ' has deleted a bug on '. $rows['date'] . '<br>';
          }

         else if ($rows['action'] == 'AU') {

          echo $rows['username'] . ' created a new user.'. '<br>';

        }

        else if ($rows['action'] == 'RU') {

          echo $rows['username'] . ' Removed user.'. '<br>';

        }

      }
?>
