<?php

require ('../config/config.php');
require ('../lib/functions.php');


ob_start();
session_start();

$view = new Connect();
$comment_connect = new Connect();

$logged = $_SESSION['username'];

  if (!isset($_SESSION['username'])) {

      header("Location: index.php");
      exit();

  }


  if (isset($_POST['id']) && $_POST['id'] != NULL) {

      $id = $_POST['id'];

      $sql = "SELECT `id`,`title`,`message`,`priority`,`category`,`reported_by`,`date` ";
      $sql .= "FROM bugs ";
      $sql .= "WHERE id = '$id' ";

      $result = mysqli_query($view->connect(), $sql);

      while ($row = $result->fetch_assoc()) {

          $bug_id   =   $row['id'];
          $title    =   $row['title'];
          $message  =   $row['message'];
          $priority =   $row['priority'];
          $category =   $row['category'];
          $reported =   $row['reported_by'];
          $phpdate = strtotime($row['date']);
          $clean_date = date('m-d-Y', $phpdate);

      }

 }
 ?>
 <html>
<?php include 'module_header.php'; ?>
 <body>
  <div main="main_content">
    <div class="panel panel-default">
  <div class="panel-body">
    <form action="../lib/view_process.php" method="POST">
      <div class="container-fluid">
         <p id="larger">Bug ID: <?php echo $bug_id; ?></p>
         <input type="text" id="hiddenInput" name="id" value='<?php echo $id; ?>'; />
         <p>Reported By: <?php echo $reported; ?></p>
             <label for="title">Title:</label>
             <input type="text" name="title" id="title" class="form-control" value="<?php echo $title; ?>" />
             <label for="select_box_priority">Priority: </label>
             <select  name="priority" class="form-control" id="select_box">
               <option value="Low">Low</option>
               <option value="Medium">Medium</option>
               <option value="High">High</option>
               <option value="None">None</option>
               <option value="Other">Other</option>
             </select>
               <label for="select_box_priority">Category: </label>
                 <select  name="category" class="form-control" id="select_box">
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
                <label for="message">Message: </label>
              <p id="date_display"><b>Date Reported: </b> <i><?php echo $clean_date; ?></i></p>
             <textarea class="form-control" id="message" name="message" rows="7"><?php echo $message; ?></textarea><br />
              <div class="button-center">
              <button type="submit" class="btn btn-primary" name="save" id="save">Save  <span class="glyphicon glyphicon-check"></span></button>
              <button type="submit" class="btn btn-primary" name="delete" id="delete"> Delete  <span class="glyphicon glyphicon-trash"></span></button>
              <button type="submit" class="btn btn-primary" name="cancel" id="cancel"> Cancel </button>
                <button type="button" class="btn btn-info" onClick="showComments(1)" id="add_comment2">Comment <span class="glyphicon glyphicon-edit"></span></button>
              </div>
             </div>
          </div>
          </div>
          <div class="comment_view">
              <textarea class="form-control" id="comment" name="comment" rows="5"></textarea><br />
              <button type="submit" class="btn btn-warning" name="add_comment" id="add_comment">Add Comment </button>
              <button type="button" class="btn btn-warning" onClick="showComments(0)"> Cancel <span class="glyphicon glyphicon-remove"></span></button>
            </form>
          </div>

      </div>
    </body>
    <script type='text/javascript' src='../js/forms.js'></script>
  </html>
   <script>
 $(document).ready(function() {

$('#hiddenInput').hide();

 });
 </script>
 <?php

 $sql_fetch_comments  = "SELECT `comment_id`,`comment`, `comment_by`, `date` ";
 $sql_fetch_comments .= "FROM `comments` ";
 $sql_fetch_comments .= "WHERE `bug_id` = '$bug_id' ";
 $sql_fetch_comments .= "ORDER BY `comment_id` DESC";

 $result = mysqli_query($comment_connect->connect(), $sql_fetch_comments);

 echo "<div class=\"container\">";

 while ($row = $result->fetch_assoc()) {

       $comment_id       = $row['comment_id'];
       $comment_fetch    = $row['comment'];
       $comment_by_fetch = $row['comment_by'];
       $phpdate = strtotime($row['date']);
       $clean_date = date('m-d-Y', $phpdate);

 echo  "<form action=\"../lib/view_process.php\" method=\"POST\">";
 echo  "<div class=\"panel panel-default\">";
 echo  "<div class=\"panel-heading\"> "."Comment by: ".$comment_by_fetch." on ".$clean_date.
       "<button type=\'submit\' id=\"delete_comment_button\" name =\"delete_comment\" value='".$row['comment_id']."' />X</button>";
 echo "</div>";
 echo  "<div class=\"panel-body\">".$comment_fetch."</div>";
 echo  "</div>";
 echo  "</form>";

 }

  ?>
