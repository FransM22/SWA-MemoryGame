<?php
require 'lib\Template.class.php';
require 'lib\StoreProduct.class.php';

session_start();

$user = new User();
$user->fromSession();
if ($user->isAdmin()) {
  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
  $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
  $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_INT);

  $store_product = new StoreProduct();
  $store_product->createNew($name, $description, $price);
  $store_product->saveInDb();
  header('Location: store.php');
}
else {
  $template = new Template();
  $template->assign('message', "You have no right to access this page");
  $template->assignMenu();
  
  $template->display('templates/message.tpl');
}

?>
