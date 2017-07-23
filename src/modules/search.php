<?php
require("../header.php");
require('../lib/functions.php');
require ("../lib/secure.php");


?>
<body>
  <ul class="nav nav-tabs">
     <li><a href="main.php">Home</a></li>
     <li><a href="bug_review.php">Bug Review</a></li>
     <li><a href="view_deleted.php">Deleted Bugs</a></li>
     <li><a href="users.php">User Accounts</a></li>
     <li class="active"><a href="search.php">Advanced Search</a></li>
     <li><a href="account.php">Account Settings</a></li>
     <li><a href="../logout.php">Logout</a></li>
  </ul>
    <br />
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="search-buttons">
          <button type="submit" class="btn btn-info">Search Bugs</button>
          <button type="submit" class="btn btn-info">Search Users</button>
          <button type="submit" class="btn btn-info">Search Deleted Bugs</button>
        </div>
      </div>
    </div>
    <div class="searchform">
      <div class="container-fluid">
        <form action="search.php" method="POST">
          <div class="form-group row">
        <div class="col-xs-1">
          <label for="id">Search ID:</label>
          <input type="text" class="form-control" id="id" name="bug_id">
        </div>
        <div class="col-xs-3">
          <label for="title">Search Bug Title:</label>
          <input type="text" class="form-control" id="title" name="bug_title">
        </div>
        <div class="col-xs-4">
          <label for="message">Search Bug Message:</label>
          <input type="text" class="form-control" id="message" name="bug_message">
        </div>
      </div>
      <button class="btn btn-primary" type="submit" name="search_bugs">Search</button>
        </form>
      </div>
    </div>



</body>
 <?php


 class Search extends Functions{

   private $bug_id;
   private $bug_title;
   private $bug_message;
   public  $search_result;

   public function __construct() {




   }

   public function search_bugs() {

     if (empty($this->bug_id) && empty($this->title) && empty($this->message)) {

       $this->search_result = 0;


    } else {

            $search_bugs_connect = new Connect();

            mysqli_escape_string($search_bugs_connect->connect(), $this->bug_id);
            mysqli_escape_string($search_bugs_connect->connect(), $this->bug_title);
            mysqli_escape_string($search_bugs_connect->connect(), $this->bug_message);

              $sql_search_bugs  = "SELECT * from bugs WHERE `id` LIKE '%".$this->bug_id."%' ";
              $sql_search_bugs .= "OR `title` LIKE '%".$this->bug_title."%'";
              $sql_search_bugs .= "OR `message` LIKE '%".$this->bug_message."%'";

              $result = mysqli_query($search_bugs_connect->connect(), $sql_search_bugs);

              $this->search_result = $result->num_rows;

              echo "<table class=\"table table-bordered\">";
              echo "<thead><tr><tbody>";
              echo "<tr><th>ID: </th><th>Title</th><th>Message</th><th>Priority</th><th>Category</th><th>Status</th><th>Reported By</th><th>Date</th>";
              echo "</thead><tbody>";
              while($row = $result->fetch_assoc()) {


                  echo "<tr><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["message"]."</td><td>".$row["priority"]."</td>";
                  echo "<td>".$row["category"]."</td><td>".$row["status"]."</td><td>".$row["reported_by"]."</td><td>".$this->cleanDate($row['date'])."</td></tr>";

                }
                echo "</tbody></table>";


        }

   }

}

if (isset($_POST['search_bugs'])) {

  $search_bugs = new Search();

  $search_bugs->search_bugs();
}

?>
