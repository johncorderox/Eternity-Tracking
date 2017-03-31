<?php


// Cleans and keeps form secure from potential attacks and SQL injections.
// @args $inputs 	Takes input from forms and cleans them using built in PHP methods

// htmlspecialcharacters  -converts to HTML entities. &amp;
// trim 									-removes whitespaces from both sides
// stripslashes						-Removes backslashes
// stript tags						-Removes HTML/PHP tags

function trims($inputs) {
  $inputs = trim($inputs);
  $inputs = stripslashes($inputs);
  $inputs = htmlspecialchars($inputs);
  $inputs = strip_tags($inputs);
  return $inputs;
}

// Cleans and sanitizes from email address input

function email_clean($inputs) {
  $inputs = filter_var($inputs, FILTER_SANITIZE_EMAIL);
  return $inputs;
}
 ?>
