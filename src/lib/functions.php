<?php

require ("connect.php");


class Functions {

  private $sql_count_bugs      = "SELECT COUNT(*) as total FROM bugs";
  private $sql_count_accounts  = "SELECT COUNT(*) as total FROM users";
  private $sql_count_deleted   = "SELECT COUNT(*) as total FROM deleted_bugs";
  private $sql_count_request   = "SELECT COUNT(*) as total FROM requests WHERE request_status = 'open'";
  private $sql_get_last_bug    = "SELECT title from `bugs` ORDER BY `id` DESC LIMIT 1";

  public $view_button_review   = "<span class=\"glyphicon glyphicon-eye-open\"></span>";
  public $delete_button_review = "<span class=\"glyphicon glyphicon-trash\"></span>";

  public function num_of_items($v) {

    $c = new Connect();

    if ($v == '0') {

      $result = mysqli_query($c->connect(), $this->sql_count_bugs);

    } else if ($v == '1') {

      $result = mysqli_query($c->connect(), $this->sql_count_accounts);

    } else if ($v == '2') {

      $result = mysqli_query($c->connect(), $this->sql_count_deleted);

    } else if ($v == '3') {

      $result = mysqli_query($c->connect(), $this->sql_count_request);

    }

    $number = mysqli_fetch_assoc($result);
    echo '( '.$number['total'].' )';

  }

  public function getLastBug() {

    $g = new Connect();
    $result = mysqli_query($g->connect(), $this->sql_get_last_bug);

      if (mysqli_num_rows($result) != 1) {

          echo '<p>Whoo hoo! No bugs reported!</p>';
      } else {

          while ($row = mysqli_fetch_assoc($result)) {

            echo '<p><b>Last bug reported:</b> '  .$row['title'].'</p>';
          }
       }
    }

    public function getReported($x) {

      $gr = new Connect();

      if ($gr->connect() && $x == 1) {

        $sql_get_r = "SELECT COUNT(*) as total FROM bugs WHERE reported_by = '{$_SESSION['username']}'";
        $result = mysqli_query($gr->connect(), $sql_get_r);
        $number = mysqli_fetch_assoc($result);

        echo '( '.$number['total'].' )';

      } else if ($gr->connect() && $x == 2) {

        $sql_get_r = "SELECT COUNT(*) as total FROM deleted_bugs WHERE deleted_by = '{$_SESSION['username']}'";
        $result = mysqli_query($gr->connect(), $sql_get_r);
        $number = mysqli_fetch_assoc($result);

        echo '( '.$number['total'].' )';

      }

    }


     public function cleanDate($old) {

        $phpdate = strtotime($old);

        $new = date('m-d-Y', $phpdate);
        return $new;

     }


     public function displayTable($table_option, $sql) {

         $display_table_connect = new Connect();

         $result = mysqli_query($display_table_connect->connect(), $sql);
         $result_count = $result->num_rows;
         echo "<h6>" .$result_count." Result(s) found in the Database.</h6>";

         if ($table_option == 0) {

           echo "<table class=\"table table-hover\">";
           echo "<thead><tr><tbody>";
           echo "<tr><th>ID: </th><th>Date</th><th>Title</th><th>Priority</th><th>Status</th><th>Actions</th>";
           echo "</thead><tbody>";
           while($row = $result->fetch_assoc()) {


               echo "<tr><td>".$row["id"]."</td><td>".$this->cleanDate($row['date'])."</td><td>".$row["title"]."</td><td>".$row["priority"]."</td>";
               echo "<td>".$row["status"]."</td> ";
               echo "<form action=\"view.php\" method=\"POST\">";
               echo "<td><div class=\"btn-group\">
                 <button type\"submit\" class=\"btn btn-primary\" id=\"view_deleted\" name=\"view\" value='".$row['id']."'>View " . $this->view_button_review."</button>
                 <button type=\"submit\" class=\"btn btn-danger\" id=\"view_deleted\" name=\"delete\" value='".$row['id']."'>Delete " .$this->delete_button_review. "</button>
                 </td>";

             }
             echo "</tbody></table></form>";

         }




    }

}








 ?>
