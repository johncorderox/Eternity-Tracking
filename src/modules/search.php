<?php
require("../header.php");
?>
<body>
  <ul class="nav nav-tabs">
     <li><a href="main.php">Home</a></li>
     <li class="active"><a href="bug_review.php">Bug Review</a></li>
     <li><a href="view_deleted.php">Deleted Bugs</a></li>
     <li><a href="users.php">User Accounts</a></li>
     <li><a href="account.php">Account Settings</a></li>
     <li><a href="../logout.php">Logout</a></li>
  </ul>
    <br />
    <div class="search-form-second">
      <form action="search.php" method="POST">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search" autofocus>
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit" id="search-button">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
   </form>
    </div>
</body>
<?php
require('../lib/functions.php');
require ("../lib/secure.php");


class Search extends Functions {

  private $search_var;

  public function __construct() {

   $this->search_var = trims($_POST['search']);


  }

  public function search_bugs() {

    if (empty($this->search_var)) {


   } else {

           $search_bugs_connect = new Connect();
           $search_table        = new Functions();

           mysqli_escape_string($search_bugs_connect->connect(), $this->search_var);


             $sql_search_bugs  = "SELECT * from bugs WHERE `title` LIKE '%".$this->search_var."%' ";

             $search_table = new Functions();
             $search_table->displayTable(0,$sql_search_bugs);


       }

  }

}

if (isset($_POST['search'])) {

  if ($_POST['search'] == NULL) {

    header("Location: bug_review.php");

  } else {

    $search_bugs = new Search();

    $search_bugs->search_bugs();

  }


}

?>
