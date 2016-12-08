<?php

require('lib/Template.class.php');

session_start();

$template = new Template();


$registered_users = User::loadAll($orderby = "highscore DESC");

$user_html = "<ol>";
foreach ($registered_users as $registered_user) {
  $user_html .= "<li>" . $registered_user->getName() . " (" . $registered_user->getHighScore() . ")</li>";
}
$user_html .= "</ol>";
$template->assign('registered_users', $user_html);

$template->assignMenu();
$template->assign('highscores', $user_html);
$template->display('templates/highscores.tpl');


?>
