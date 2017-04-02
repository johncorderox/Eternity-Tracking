
 <?php
 // COUNT NUMBER OF RECORDS FOUND(S).
       include '../header.php';
       include '../sql/connect.php';
       include '../lib/functions.php';
       include '../lib/secure.php';


       if (isset($_POST['submit_search'])) {

         if ($_POST['search'] == "" ) {

           showerror();
           $result_count = 0;

         } else {

               $search= trims($_POST['search']);
               $sql_search = "SELECT * FROM bugs WHERE message LIKE '%".$search."%'";

               mysqli_select_db($connect, $database);
               $result = mysqli_query($connect, $sql_search);

               echo "<div id=\"table_bugs\">";
               echo "<table><tr><th>ID: </th><th>Title</th><th>Message</th><th>Priority</th><th>Category</th>";
               while($row = mysqli_fetch_assoc($result)) {

                   echo "<tr><td>".$row["id"]."</td><td>".$row["title"].
                   "</td><td>".$row["message"]."</td><td>".$row["priority"]."</td><td>".$row["category"]."</td></tr>";
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
     <p id="larger">
      <?php echo $result_count;?> Result(s) found in the Database.
     </p>
   </div>
   <script type='text/javascript' src='../js/view.js'></script>
