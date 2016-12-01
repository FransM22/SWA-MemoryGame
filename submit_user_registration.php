<?php
require 'lib\User.class.php';

session_start();
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

$user = new User();
$user->createNew($username, $password);
$user->saveInDb();

#header('Location: index.php');
?>
