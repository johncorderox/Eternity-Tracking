<?php
      require('../header.php');
      require('../config/config.php');
      require('../lib/secure.php');
      require('../lib/functions.php');
      require('../lib/notification.php');


        class BugList extends Functions {

          public $sql    = "SELECT `id`, `date`,`title`,`priority`, `status` FROM bugs";
          public $view   = "<span class=\"glyphicon glyphicon-eye-open\"></span>";
          public $delete = "<span class=\"glyphicon glyphicon-trash\"></span>";

          public function displayBugs() {

            $display_connect = new Connect();
            $result = mysqli_query($display_connect->connect(), $this->sql);


            echo "<table class=\"table table-hover\" id=\"review-default-table\">";
            echo "<thead><tr><tbody>";
            echo "<tr><th>ID: </th><th>Date</th><th>Title</th><th>Priority</th><th>Status</th><th>Actions</th>";
            echo "</thead><tbody>";
            while($row = $result->fetch_assoc()) {


                echo "<tr><td>".$row["id"]."</td><td>".$this->cleanDate($row['date'])."</td><td>".$row["title"]."</td><td>".$row["priority"]."</td>";
                echo "<td>".$row["status"]."</td> ";
                echo "<form action=\"view.php\" method=\"POST\">";
                echo "<td><div class=\"btn-group\">
                  <button type\"submit\" class=\"btn btn-primary\" id=\"view_deleted\" name=\"view\" value='".$row['id']."'>View " . $this->view."</button>
                  <button type=\"submit\" class=\"btn btn-danger\" id=\"view_deleted\" name=\"delete\" value='".$row['id']."'>Delete " .$this->delete. "</button>
                  </td>";

              }
              echo "</tbody></table></form>";


          }


     }

     Class AddBug {

       private $title;
       private $message;
       private $priority;
       private $category;

       private $sql_add;
       private $sql_add_log;

       public static $error_message;


       public function __construct() {

         $this->title    = trims($_POST['title']);
         $this->message  = trims($_POST['message']);
         $this->priority = $_POST['priority'];
         $this->category = $_POST['category'];
         $this->logged   = $_SESSION['username'];
         $this->ip       = $_SERVER['REMOTE_ADDR'];


       }


       public function getSqlAddBug() {

         return "Current sql query is: " .$this->sql_add . "<br />"."Sql variable is marked \'Private\' ";

       }

       public function setSqlAddBugCustom($t, $m, $p, $c) {

         $this->sql_add  = "INSERT INTO bugs (title, message, priority, category, reported_by, date) ";
         $this->sql_add = "VALUES ('$this->t','$this->m', '$this->p', '$this->c', '$this->logged', NOW() )";


       }

       public function addBug() {

         $add_bug_connect = new Connect();

         if (!$this->title || !$this->message) {

           return Addbug::$error_message = "You are missing one of the required fields.";


         }

           $this->title = mysqli_real_escape_string($add_bug_connect->connect(), $this->title);
           $this->message = mysqli_real_escape_string($add_bug_connect->connect(), $this->message);

           $this->setSqlAddBugDefault();
           $result = mysqli_query($add_bug_connect->connect(), $this->sql_add);

           if ($result) {

             $this->setAddBugLog();

             $result_log = mysqli_query($add_bug_connect->connect(), $this->sql_add_log);

             if ($result_log == FALSE) {

               echo "There was an error logging the bug: " . $this->title;
               return;
             }

             header("location: bug_review.php?successbug=1");



           }



       }


     }

     class DeleteBug {

       private $deleteId;
       private $ip;
       private $user;

       public static $errorMessage = "";


       public function __construct() {

         $this->deleteId = trims($_POST['delete_id']);
         $this->ip       = $_SERVER['REMOTE_ADDR'];
         $this->user     = $_SESSION['username'];

       }


       public function setDeleteId ($d) {

         $this->deleteId = $d;


       }

       public function getDeleteId() {

         return $this->deleteId;


       }

       private function test_query() {

         $test_query = new Connect();
         $delete_sql_test = "SELECT * FROM bugs WHERE id = '$this->deleteId' ";

         $result = mysqli_query($test_query->connect(), $delete_sql_test);

           if (mysqli_num_rows($result) > 0) {

             $this->run();

           } else {

             DeleteBug::$errorMessage = "ID: " . $this->deleteId . " could not be found.";
           }


       }

       public function run() {

         $run = new Connect();
         $delete_sql      = "DELETE FROM bugs WHERE id = " .$this->deleteId;
         $delete_sql_copy = "INSERT INTO deleted_bugs (id, title, message, priority, category) SELECT `id`,`title`, `message`, `priority`, `category` FROM bugs WHERE id = '$this->deleteId'";
         $delete_sql_update ="UPDATE deleted_bugs SET deleted_by = '{$_SESSION['username']}', delete_date = NOW(), status = 'closed' WHERE id = '$this->deleteId'";
         $delete_sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','D','{$_SESSION['username']}', '$this->deleteId', NOW(), '$this->ip')";


         // Moves data into another table
         mysqli_query($run->connect(),$delete_sql_copy);
         // Adds remaining values to new table
         mysqli_query($run->connect(),$delete_sql_update);
         // Deletes the bug ID number
         mysqli_query($run->connect(),$delete_sql);
         // Logs the deleted bug
         mysqli_query($run->connect(),$delete_sql_log);
         // Successful redirect
         header("Location: bug_review.php?deletebug=1");


       }

       public function deleteBug() {

           if (empty($this->deleteId)) {

                return DeleteBug::$errorMessage = "You did not enter anything to be deleted!";


           } else {


               if (is_numeric($this->deleteId)) {

                 $delete_connect = new Connect();

                 mysqli_escape_string($delete_connect->connect(), $this->deleteId);
                 $this->test_query();


               } else {

                   return DeleteBug::$errorMessage = "You did not enter a valid number!";

               }

           }

        }

    }



//Generates bug id for review button.

  $review = new Connect();

  $sql_review = "SELECT `id` FROM `bugs` ORDER BY `id` ASC LIMIT 1";
  $result     = mysqli_query($review->connect(), $sql_review);

  while ($row = mysqli_fetch_assoc($result)) {

    $review_id_bug = $row['id'];
  }

 ?>
 <html>
 <body>
   <ul class="nav nav-tabs">
      <li><a href="main.php">Home</a></li>
      <li class="active"><a href="bug_review.php">Bug Review</a></li>
      <li><a href="view_deleted.php">Deleted Bugs</a></li>
      <li><a href="users.php">User Accounts</a></li>
      <li><a href="account.php">Account Settings</a></li>
      <li><a href="../logout.php">Logout</a></li>
      <li id="welcome-name"><a href="account.php">Welcome, <?php echo $_SESSION['username'];?>!</a></li>
   </ul>
     <div class="review-buttons">
       <button class="btn btn-primary" onclick="reveal(2)">Add Bug <span class="glyphicon glyphicon-plus"></span></button>
       <button class="btn btn-primary" onclick="reveal(3)">Delete Bug <span class="glyphicon glyphicon-trash"></span></button>
       <form action="view.php" method="POST">
        <button type="submit" class="btn btn-success" value="<?php echo $review_id_bug; ?>" name="view">Start Review</button>
       </form>
     </div>
     <div class="bug-count">
       <p id="num-bugs"><span class="glyphicon glyphicon-briefcase"></span> Bug Queue: <?php
       $bug = new Functions();
       $bug->num_of_items(0); ?></p>
     </div><br />
     <form action="search.php" method="POST">
       <div class="bug-review-search">
         <div class="input-group">
           <input type="text" class="form-control" placeholder="Search" name="search" autofocus>
           <div class="input-group-btn">
             <button class="btn btn-default" type="submit" id="search-button">
               <i class="glyphicon glyphicon-search"></i>
             </button>
           </div>
         </div>
       </div>
  </form>
     <div class="addform">
       <form name="add" action="bug_review.php" method="POST">
       <p id="larger"> Please Enter a Title and a Descriptive Message! </p><br />
       <?php echo  '<p>'. Addbug::$error_message . '</p>'; ?>
       <input type="text" placeholder="Title *" name="title" id="title"/><br />
       <input type="text" placeholder="Message *" id="message" name="message"></textarea><br />
       <p> Enter a priority and a category for your bug.</p>
       <select class="form-control" name="priority" id="select_box">
         <option value="Low">Low</option>
         <option value="Medium">Medium</option>
         <option value="High">High</option>
         <option value="None">None</option>
         <option value="Other">Other</option>
       </select><br />
       <select class="form-control" name="category" id="select_box">
         <option value="None">None</option>
         <option value="Administration">Administration</option>
         <option value="Feature">Feature</option>
         <option value="Security">Security</option>
         <option value="Database">Database</option>
         <option value="Email">Email</option>
         <option value="Enhancement">Enhancement</option>
         <option value="Customization">Customization</option>
         <option value="Other">Other</option>
       </select><br />
       <button type="submit" name="add_main" id="e-button">Submit</button>
       <button type="button" onclick="reveal(5)" id="e-button">Cancel</button>
     </form>
     </div>
     <div class="deleteform">
       <form action="bug_review.php" method="POST">
         <?php echo '<p id="larger">Enter the Bug ID Number: </p> <br />'; ?>
         <?php echo '<p>' . DeleteBug::$errorMessage .'</p>'; ?>
         <input type="text" id="del_start" name ="delete_id" placeholder="ID #: "/><br />
         <button type="submit" name="submit_delete" id="e-button">Submit</button>
         <button type="button" id="e-button" onclick="reveal(6)">Cancel</button>
       </form>
     </div>
   </body>
  <script type='text/javascript' src='../js/forms.js'></script>
  <script type='text/javascript' src='../js/notification.js'></script>
 </html>
<?php

   $displayBugs         = new BugList();
   $review_notification = new Notification();

   $review_notification->notifications();
   $displayBugs->displayBugs();


   if (isset($_POST['add_main'])) {

       $add_bug = new AddBug();
       $add_bug->addBug();

     }


    if (isset($_POST['submit_delete'])) {

      $delete_bug = new DeleteBug();
      $delete_bug->deleteBug();

    }

    ?>
