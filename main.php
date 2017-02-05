<?php

  include('config.php');
  include('connect.php');
  include('functions.php');


?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="src/css/interface.css" rel="stylesheet" />
  </head>
  <body>
    <div class="header-name">
  <?php echo '<h3>Eternity Tracking</h3><br />'; ?>
    </div><br />
      <div class="leftside-info">
        <div class="list-group">
          <a href="#" class="list-group-item active">Main Information</a>
          <a href="#" class="list-group-item">Number of Bugs: <?php ?></a>
          <a href="#" class="list-group-item">Number of User Accounts: $accountcount</a>
          <a href="#" class="list-group-item">Host Name: <?php echo $servername; ?></a>
          <a href="#" class="list-group-item">Database name: <?php echo $database; ?></a>
        </div>
        <br />
        <div class="list-group">
          <a href="#" class="list-group-item active">Backend Information</a>
          <a href="#" class="list-group-item">PHP Info: <?php echo phpversion(); ?></a>
          <a href="#" class="list-group-item">MySQL Server Status:<?php check_mysql_server_status(); ?></a>
          <a href="#" class="list-group-item">MySQL Vers: <?php echo mysqli_get_server_version($connect); ?></a>

        </div>
      </div>

      <div class="table-design">
        <table>
          <tr>
            <th>
              ID:
            </th>
            <th>
              Title:
            </th>
            <th>
              Message:
            </th>
            <th>
              Severity
            </th>
          </tr>
          <tr>
            <th>
              1
            </th>
            <th>
              The website is so slow!!! help pls!!11!!
            </th>
            <th>
              When I go into the site my browser goes slow sir.. what 2 do. its dumb..
            </th>
            <th>
              High
            </th>
          </tr>
          <tr>
            <th>
              2
            </th>
            <th>
              fgsfdgsdg
            </th>
            <th>
              this is a test omgggggg WHAT
            </th>
            <th>
              Low
            </th>
          </tr>
          <tr>
            <th>
              3
            </th>
            <th>
              apple bottoms jeans
            </th>
            <th>
              she got the boots with the floor she hit the floor shawty got low.
            </th>
            <th>
              Low
            </th>
          </tr>

        </table>
      </div>
  </body>
  <script type='text/javascript' src='src/view.js'></script>
</html>
