<?php

require('lib/Template.class.php');

session_start();

$template = new Template();

$template->assignMenu();
$template->display('templates/main.tpl');


?>
