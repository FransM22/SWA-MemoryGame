<?php
require('lib/Template.class.php');

session_start();

$user = new User();
$user->fromSession();
$user_id = $user->getId();
$username = $user->getName();
$highscore = $user->getHighScore();

$template = new Template();
$template->assign('userid', $user_id);
$template->assign('username', $username);
$template->assign('highscore', $highscore);
$template->assignMenu();

$template->display('templates/userinfo.tpl');

?>
