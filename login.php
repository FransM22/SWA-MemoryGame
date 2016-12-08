<?php

require('lib/Template.class.php');

session_start();


if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== -1) {
  $template = new Template();
  $template->assign('message', "You are already logged in!");
  $template->assignMenu();

  $template->display('templates/message.tpl');
}
else {
  (new Template())->display('templates/login.tpl');
}

?>
