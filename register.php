<?php

require('lib/Template.class.php');

session_start();

$template = new Template();
$template->assignMenu();
if (isset($_SESSION['user_id'])) {
  $template->assign('message', "You are already logged in!");

  $template->display('templates/message.tpl');
}
else {
  $template->display('templates/register.tpl');
}
?>
