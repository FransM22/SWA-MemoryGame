<?php
require 'lib\User.class.php';

session_start();

$highscore = filter_input(INPUT_POST, "highscore", FILTER_SANITIZE_NUMBER_INT);

$user = new User();
$user->fromSession();

if ($user->getId() > 0) {
  if ($highscore > $user->getHighScore()) {
    $user->setHighscore($highscore);
    $user->updateInDb();
  }
}

?>
