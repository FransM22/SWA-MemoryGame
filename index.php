<?php

require('lib/Template.class.php');

$template = new Template();
$menu_section = (new Template())->get('templates/menu.inc.tpl');

$template->assign('menu_section', $menu_section);
$template->display('templates/main.tpl');


?>
