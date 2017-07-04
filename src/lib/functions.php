<?php

include ("connect.php");


class Functions {

  private $sql_count_bugs     = "SELECT COUNT(*) as total FROM bugs";
  private $sql_count_accounts = "SELECT COUNT(*) as total FROM users";
  private $sql_count_deleted  = "SELECT COUNT(*) as total FROM deleted_bugs";
  private $sql_count_request  = "SELECT COUNT(*) as total FROM requests WHERE request_status = 'open'";
  private $sql_get_last_bug   = "SELECT title from `bugs` ORDER BY `id` DESC LIMIT 1";

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

 }





 ?>
