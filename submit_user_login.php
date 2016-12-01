<?php
require 'lib\User.class.php';

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

$user = new User();
$user->fromLogin($username, $password);

if ($user->getId() > 0) {
  $user->startUserSession();
}
else {
  echo "Username / password incorrect";
}

header('Location: userinfo.php');
?>
