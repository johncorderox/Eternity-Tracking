<?php

require ('../lib/connect.php');

  class UserList {

    public $sql_users = "SELECT * from `users` ";


    public function displayUsers() {

        $user_list = new Connect();

        $result = mysqli_query($user_list->connect(), $this->sql_users);


            echo "<div id=\"table_users\">";
            echo "<table><tr><th>ID</th><th>Username</th></tr>";
            while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["account_id"]."</td><td>".$row["username"]."</td></tr>";
            echo "</div>";

        }


     }

    private function displaySqlInfo() {

      echo "The following is the CURRENT sql to display bugs";
      echo $this->sql_users;

    }


  }


?>
