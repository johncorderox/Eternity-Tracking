<?php
      require('../header.php');
      require('../tables/buglist.php');
      require('../config/config.php');
      require("../lib/secure.php");

 ?>

   <div class="review-buttons">
   <form action="main.php" action="GET">
     <button name="add" class="btn btn-primary" >Add Bug <span class="glyphicon glyphicon-plus"></span></button>
     <button name="delete" class="btn btn-primary">Delete Bug <span class="glyphicon glyphicon-trash"></span></button>
     <button name="add_new" class="btn btn-primary">Search Bugs <span class="glyphicon glyphicon-search"></span></button>
   </form><br />

   <?php


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

             header("location: main.php?successbug=1");

           }



       }


     }


     if (isset($_POST['add_main'])) {

       $add_bug = new AddBug();
       $add_bug->addBug();


     }



     if(isset($_POST['cancel'])) {

       header("location: main.php");
     }

   ?>

   <html>
   <body>
     <div class="addform">
       <form action="add_main.php" method="POST">
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
       <button type="submit" name="add_main" id="add-button" onClick="checkAdd()">Submit</button>
       <button name="cancel">Cancel</button>
     </form>
     </div>
   </body>
   </html>
   <script>
   $(document).ready(function() {

     $('.ui-main-button-group').hide("fast");
     $('.addform2').show();

   });
   </script>

   </script>


 <?php
   $displayBugs = new BugList();

   $displayBugs->displayBugs();
  ?>
