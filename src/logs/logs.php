<?php

include ('../header.php');

include ('../config/config.php');

 ?>
<body>
  <h5>Logs</h5>
</body>
<?php

    $log_counter = 0;
    $logArr = array();



    $query_logs = "SELECT * from logs";
    $result = mysqli_query($connect, $query_logs);

      while($rows=mysqli_fetch_assoc($result)) {



          if ($rows['action'] == 'A') {

            $a = "added";
            array_push($logArr, $a);

          //  echo $rows['log_user'] . ' added a new bug on '. $rows['date'] . '.<br>';


          } else if ($rows['action'] == 'D') {

            $d = "deleted";
            array_push($logArr, $d);

        //    echo $rows['log_user'] . ' has deleted the bug ID '. $rows['action_value'] . '.<br>';
          }

         else if ($rows['action'] == 'AU') {

        //  echo $rows['log_user'] . ' created the user ' . $rows['action_value']. '.<br>';

          }

          else if ($rows['action'] == 'RU') {

      //    echo $rows['log_user'] . ' removed user ID '. $rows['action_value']. '.<br>';

        }


      }

      for ($x = 0; $x < 2; $x++) {


        echo $logArr[$x];
      }



?>
