
 <?php

       if (isset($_POST['submit_search'])) {

         if ($_POST['search'] == "" ) {

           $result_count = 0;

         } else {

               $search= trims(mysqli_escape_string($search_connect->connect(), $_POST['search']));
               $sql_search = "SELECT * FROM bugs WHERE message LIKE '%".$search."%'";


               $result = mysqli_query($search_connect->connect(), $sql_search);
               $result_count = $result->num_rows;

               echo "<div id=\"table_bugs\">";
               echo "<table><tr><th>ID: </th><th>Title</th><th>Message</th><th>Priority</th><th>Category</th><th>User</th>";
               while($row = $result->fetch_assoc()) {

                   echo "<tr><td>".$row["id"]."</td><td>".$row["title"].
                   "</td><td>".$row["message"]."</td><td>".$row["priority"]."</td><td>".$row["category"]."</td><td>".$row["reported_by"]."</td></tr>";
                   echo "</div>";

               }

         }


       }
?>

   <link href="css/interface.css" rel="stylesheet" />
   <div class="searchForm">
     <p id="larger">
       Enter your Search:
     </p>
     <form action="search.php" method="POST">
       <input type="text" name="search" placeholder="Search Database*" autofocus/>
       <button type="submit" name="submit_search" id="add-button-search">Submit</button>
     </form>
     <hr />
     <h6>
      <?php echo $result_count;?> Result(s) found in the Database.
    </h6>
   </div>
   <script type='text/javascript' src='../js/view.js'></script>
   <script>
    hideLogs();
   </script>
