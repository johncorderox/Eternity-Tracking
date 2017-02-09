<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>
    <link href="src/css/interface.css" rel="stylesheet" />
  </head>
<body>
  <div class="header-name">
  <?php  echo '<h4>Eternity Tracking</h4> <br />'; ?>
  </div>
    <hr />
        <div class="requirements">
          <p>Please make sure you add the following: </p>
        <ul>
          <li id="dt">
             A Descriptive title.
          </li>
          <li id="dm">
            A Descriptive message.
          </li>
          <li id="sl">
            A Severity level.
          </li>
        </ul>
        </div>
        <div class="addform">
          <form action="addfunc.php" method="POST">
          <input type="text" placeholder="Title *" name="title" id="title"/><br />
          <textarea name="message" rows="5" placeholder="Message *" id="message"></textarea><br />
            <input type="radio" id="radio" name="severity" value="Low"> Low
            <input type="radio" id="radio" name="severity" value="Normal"> Normal
            <input type="radio" id="radio" name="severity" value="High"> High<br />
          <button type="submit" name="submit" id="add-button">Submit</button>
        </form>
      </div>
 <script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<?php

if (isset($_GET['success'])) {

  echo '<script type="text/javascript">
        display_input_message(0);
        </script>';
}

 ?>
