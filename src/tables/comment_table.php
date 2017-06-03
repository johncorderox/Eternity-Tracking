<?php
$sql_fetch_comments  = "SELECT `comment_id`,`comment`, `comment_by`, `date` ";
$sql_fetch_comments .= "FROM `comments` ";
$sql_fetch_comments .= "WHERE `bug_id` = '$bug_id' ";
$sql_fetch_comments .= "ORDER BY `comment_id` DESC";

$result = $connect->query($sql_fetch_comments);

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
