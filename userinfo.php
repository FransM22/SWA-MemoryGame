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

// Load information for the admin section
$admin_section = '';
if ($user->isAdmin()) {
  $admin_template = new Template();

  $registered_users = User::loadAll();

  $user_html = "";
  foreach ($registered_users as $registered_user) {
    $user_html .= "<li>" . $registered_user->getName() . " (" . $registered_user->getHighScore() . ")</li>";
  }
  $admin_template->assign('registered_users', $user_html);

  $admin_section = $admin_template->get('templates/admin_userinfo.inc.tpl');
}
$template->assign('admin_section', $admin_section);

$template->assignMenu();

$template->display('templates/userinfo.tpl');

?>
