<?php

function trims($inputs) {

  $inputs = trim($inputs);
  $inputs = stripslashes($inputs);
  $inputs = htmlspecialchars($inputs);

  return $inputs;

}


 ?>
