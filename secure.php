<?php

function trims($inputs) {

  $inputs = trim($inputs);
  $inputs = stripslashes($inputs);
  $inputs = htmlspecialchars($inputs);

  return $inputs;

}

function email_clean($inputs) {

  $inputs = filter_var($inputs, FILTER_SANITIZE_EMAIL);

  return $inputs;
}


 ?>
