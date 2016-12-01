<?php

require('lib/Template.class.php');

session_start();

if (isset($_SESSION['user_id'])) {
  echo "You are already logged in!";
}
else {
  (new Template())->display('templates/login.tpl');
}

?>
