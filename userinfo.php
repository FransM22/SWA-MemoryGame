<?php
require('lib/Template.class.php');
require('lib/User.class.php');

session_start();

$user_id = "[Not logged in]";
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}

$user = new User();
$user->fromId($user_id);
$username = $user->getName();
$highscore = $user->getHighScore();

$template = new Template();
$template->assign('userid', $user_id);
$template->assign('username', $username);
$template->assign('highscore', $highscore);

$template->display('templates/userinfo.tpl');

?>
