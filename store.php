<?php

require('lib/Template.class.php');

session_start();

(new Template())->display('templates/store.tpl');

?>
