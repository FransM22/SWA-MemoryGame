<?php

session_start();

// unset the user_id, but keep the contents of the shopping cart
unset($_SESSION["user_id"]);

header('Location: index.php');

?>
