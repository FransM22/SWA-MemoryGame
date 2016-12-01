<?php

session_start();

$user_id = "[Not logged in]";

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}

echo "User id: $user_id";
echo "<br>";
echo "<a href='register.php'>Register</a> ";
echo "<a href='login.php'>Login</a> ";
echo "<a href='logout.php'>Logout</a>";

?>
