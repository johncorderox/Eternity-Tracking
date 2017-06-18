<?php

include ("connect.php");


class Functions {

  private $sql_count_bugs     = "SELECT COUNT(*) as total FROM bugs";
  private $sql_count_accounts = "SELECT COUNT(*) as total FROM users";
  private $sql_count_deleted  = "SELECT COUNT(*) as total FROM deleted_bugs";
  private $sql_count_request  = "SELECT COUNT(*) as total FROM requests WHERE request_status = 'open'";

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



}

/*


// Retrieves the last bug from the database.
// Connects and fetces using the query from the var $sql
// Selects all bugs from the message column, orders them by id and
// decends the list going from ex 9-1. Limiting 1 showing the last.

function getLastBug() {

global $connect;

if ($connect) {

  $sql = "SELECT title from `bugs` ORDER BY `id` DESC LIMIT 1";
  $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) != 1) {

        echo '<p>Whoo hoo! No bugs reported!</p>';
    } else {

        while ($row = mysqli_fetch_assoc($result)) {

          echo '<p><b>Last bug reported:</b> '  .$row['title'].'</p>';
        }
     }

  }

}

// For the account.php page. Allows the user to see the number of reported X
// Grabs the count for MySQL and echos as assoc array, like a menu.
//
// @args input from trigger on account.php

function getReported ($x) {
  global $connect;

  if ($connect && $x == 1) {

    $sql_get_r = "SELECT COUNT(*) as total FROM bugs WHERE reported_by = '{$_SESSION['username']}'";
    $result = mysqli_query($connect, $sql_get_r);
    $number = mysqli_fetch_assoc($result);

    echo '( '.$number['total'].' )';

  } else if ($connect && $x == 2) {

    $sql_get_r = "SELECT COUNT(*) as total FROM deleted_bugs WHERE deleted_by = '{$_SESSION['username']}'";
    $result = mysqli_query($connect, $sql_get_r);
    $number = mysqli_fetch_assoc($result);

    echo '( '.$number['total'].' )';

  }
}
*/

 ?>
