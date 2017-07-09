<?php

require ('../lib/connect.php');
class BugList {

  private $sql = "SELECT id, title FROM bugs";

  public function displayBugs() {

    $display_connect = new Connect();
    $result = mysqli_query($display_connect->connect(), $this->sql);

    echo "<table><tr><th>ID: </th><th>Title</th><th>Actions</th>";
       while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr><td>".$row["id"]."</td><td>".$row["title"].
        "</td><td>".
        "<form action=\"view.php\" method=\"POST\">".
        "<button type=\'submit\' class=\"view_buttom\" name =\"id\" value='".$row['id']."' />View</button></td></tr>
        </form>";

      }



  }



}
?>
