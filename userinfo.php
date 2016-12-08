<?php
require('lib/Template.class.php');
require('lib/User.class.php');

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

$menu_section = (new Template())->get('templates/menu.inc.tpl');
$template->assign('menu_section', $menu_section);

$template->display('templates/userinfo.tpl');

?>
