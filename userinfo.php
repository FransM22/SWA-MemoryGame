<?php

session_start();

$username = $_SESSION['username'];
$password = $_SESSION['password'];
echo "Username: $username<br>";
echo "Password: $password<br>";
?>
