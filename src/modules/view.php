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
   <hr />
     <form action="view.php" method="POST">
      <p>Bug ID: <?php echo $bug_id; ?></p><br />
      <?php echo $title;?>
      <p>Reported By: <?php echo $reported; ?></p><br />
      <p>Date: <?php echo $date; ?></p>
      <input type="text" value="<?php echo $title; ?>"><br />
      <textarea><?php echo $message; ?></textarea><br />
      <select  name="priority" id="select_box">
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
        <option value="None">None</option>
        <option value="Other">Other</option>
      </select><br />
      <select  name="category" id="select_box">
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

<input type="submit" class="btn btn-primary" name="submit_view" value="Save" />
<input type="submit" class="btn btn-primary" name="delete" value="Delete" />
</form>

 </body>
