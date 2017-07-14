<?php
      require('../header.php');
      require('../config/config.php');
      require('../lib/secure.php');
      require('../lib/functions.php');


        class BugList extends Functions {

          private $sql    = "SELECT `id`, `date`,`title`,`priority`, `status` FROM bugs";
          private $view   = "<span class=\"glyphicon glyphicon-eye-open\"></span>";
          private $delete = "<span class=\"glyphicon glyphicon-trash\"></span>";

          public function displayBugs() {

            $display_connect = new Connect();
            $result = mysqli_query($display_connect->connect(), $this->sql);


            echo "<table class=\"table table-hover\" id=\"bug_table\">";
            echo "<thead> <tr> <tbody>";
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

       public function setSqlAddBugDefault() {

         $this->sql_add  = "INSERT INTO bugs (title, message, priority, category, reported_by, date) ";
         $this->sql_add .= "VALUES ('$this->title','$this->message', '$this->priority', '$this->category', '$this->logged', NOW() )";


       }

       public function setSqlAddBugCustom($t, $m, $p, $c) {

         $this->sql_add  = "INSERT INTO bugs (title, message, priority, category, reported_by, date) ";
         $this->sql_add = "VALUES ('$this->t','$this->m', '$this->p', '$this->c', '$this->logged', NOW() )";


       }

       public function setAddBugLog() {

         $this->sql_add_log  = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) ";
         $this->sql_add_log .=" VALUES ('','A','$this->logged', '$this->title', NOW(), '$this->ip')";


       }


       public function addBug() {

         $add_bug_connect = new Connect();

         if (!$this->title || !$this->message) {
  
           return Addbug::$error_message = "You are missing one of the required fields.";



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
}

     if (isset($_POST['add_main'])) {

         $add_bug = new AddBug();
         $add_bug->addBug();

       }

     if(isset($_POST['cancel'])) {

        header("location: bug_review.php");

        }



 ?>
 <html>
 <body>
   <ul class="nav nav-tabs">
      <li><a href="main.php">Home</a></li>
      <li class="active"><a href="bug_review.php">Bug Review</a></li>
      <li><a href="view_deleted.php">Deleted Bugs</a></li>
      <li><a href="">User Accounts</a></li>
      <li><a href="#">Advanced Search</a></li>
      <li><a href="account.php">Account Settings</a></li>
      <li><a href="#">Logout</a></li>
   </ul>
     <div class="review-buttons">
       <button class="btn btn-primary" onclick="add_bug()">Add Bug <span class="glyphicon glyphicon-plus"></span></button>
       <button class="btn btn-primary">Delete Bug <span class="glyphicon glyphicon-trash"></span></button>
       <button class="btn btn-primary">Search Bugs <span class="glyphicon glyphicon-search"></span></button>
     </div>
     <div class="bug-count">
       <p id="larger">Number of Bugs: <?php
       $bug = new Functions();
       $bug->num_of_items(0); ?></p>
     </div><br />
     <div class="addform">
       <form action="bug_review.php" method="POST">
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
       <button type="submit" name="add_main" id="e-button" onClick="checkAdd()">Submit</button>
       <button name="cancel" id="e-button">Cancel</button>
     </form>
     </div>
   </body>
  <script type='text/javascript' src='../js/forms.js'></script>
 </html>
<?php
   $displayBugs = new BugList();
   $displayBugs->displayBugs(); ?>
