<?php
require 'lib\User.class.php';
require 'lib\StoreProduct.class.php';

session_start();

$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_INT);

$store_product = new StoreProduct();
$store_product->createNew($name, $description, $price);
$store_product->saveInDb();


header('Location: store.php');
?>
