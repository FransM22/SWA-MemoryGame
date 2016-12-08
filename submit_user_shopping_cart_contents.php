<?php
require 'lib\User.class.php';

session_start();

$product_id = filter_input(INPUT_POST, "product_id", FILTER_SANITIZE_STRING);
$increase_amount = filter_input(INPUT_POST, "increase_amount", FILTER_SANITIZE_NUMBER_INT);
$redirect_url = filter_input(INPUT_POST, "redirect_url", FILTER_SANITIZE_URL);

$current_amount = 0;

$product_amounts = array();
if (isset($_SESSION["product_amounts"])) {
  $product_amounts = $_SESSION["product_amounts"];
}


$amount = 0;
if (isset($product_amounts[$product_id])) {
  $amount = $product_amounts[$product_id];
}

$amount_new = max($amount + $increase_amount, 0);

if ($amount_new > 0) {
  $product_amounts[$product_id] = $amount_new;
}
else {
  unset($product_amounts[$product_id]);
}


$_SESSION["product_amounts"] = $product_amounts;

header('Location: ' . $redirect_url);
?>
