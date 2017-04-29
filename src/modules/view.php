<?php

include ('../header.php');
include ('../config/config.php');

  if (isset($_POST['id']) && $_POST['id'] != NULL) {

      $id = $_POST['id'];

      $sql = "SELECT `id`,`title`,`message`,`priority`,`category`,`reported_by`,`date` ";
      $sql .= "FROM bugs ";
      $sql .= "WHERE id = '$id' ";

      $result = mysqli_query($connect, $sql);

      while ($row = mysqli_fetch_assoc($result)) {

          $bug_id   =   $row['id'];
          $title    =   $row['title'];
          $message  =   $row['message'];
          $priority =   $row['priority'];
          $category =   $row['category'];
          $reported =   $row['reported_by'];
          $date     =   $row['date'];

      }

  }
 ?>
 <body>
   <input type="text" value="<?php echo $title; ?>"><br />
   <textarea><?php echo $message; ?></textarea>
 </body>
