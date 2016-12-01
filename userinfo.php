<?php
require('lib/Template.class.php');

session_start();

$user_id = "[Not logged in]";
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}

$template = new Template();

$template->display('templates/userinfo.tpl');

?>
