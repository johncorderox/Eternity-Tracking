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
    <div class="form-group row">
    <div class="col-xs-2">
      <label for="ex1">col-xs-2</label>
      <input class="form-control" id="ex1" type="text">
    </div>
    <div class="col-xs-3">
      <label for="ex2">col-xs-3</label>
      <input class="form-control" id="ex2" type="text">
    </div>
    <div class="col-xs-4">
      <label for="ex3">col-xs-4</label>
      <input class="form-control" id="ex3" type="text">
    </div>
  </div>
</body>
<?php
require('../lib/functions.php');
require ("../lib/secure.php");


class Search extends Functions {

  private $search_var;
  public static $search_Count_Result;


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
