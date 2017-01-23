<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <link href="src/css/interface.css" rel="stylesheet" />
  </head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <?php echo '<h4>Eternity Tracking</h4> <br />'; ?>
      </div>
    </div>
      </div>
      <hr />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <?php echo '<p>Please make sure you add the following: </p>'; ?>
        <ul>
          <li>
            <?php echo 'A Descriptive title.'; ?>
          </li>
          <li>
            <?php echo 'A Descriptive message.'; ?>
          </li>
          <li>
            <?php echo 'A severity level.'; ?>
          </li>
        </ul>
        </div>
        <div class="col-md-9">
          <form action="index.php" method="POST">
          <input type="text" placeholder="Title *" name="title"/><br />
          <textarea name="message" rows="5" placeholder="Message *"></textarea><br />
          <button type="submit" name="submit">Submit</button>
        </form>
        </div>
      </div>
    </div>
  <!-- Javascript -->
  <script type='text/javascript' src='src/view.js'></script>
</body>
</html>
