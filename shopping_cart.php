<?php

require('lib/Template.class.php');
require('lib/StoreProduct.class.php');

session_start();

$template = new Template();
$template->assignMenu();

$shopping_cart_contents = StoreProduct::loadFromShoppingCart();

if (count($shopping_cart_contents) > 0) {
  $shopping_cart_html = "";

  foreach ($shopping_cart_contents as $product_info) {
    $shopping_cart_html .= "<br>";
    $shopping_cart_html .= '<div class="product_title">' . $product_info['title'] . '</div><br>';

    $increase_button = '<form action="submit_user_shopping_cart_contents.php" method="POST">
      <input type="hidden" name="product_id" value="'. $product_info['id'] . '">
      <input type="hidden" name="increase_amount" value="1">
      <input type="hidden" name="redirect_url" value="shopping_cart.php">
      <button type="submit" class="button">+</button>
    </form>';

    $decrease_button = '<form action="submit_user_shopping_cart_contents.php" method="POST">
      <input type="hidden" name="product_id" value="'. $product_info['id'] . '">
      <input type="hidden" name="increase_amount" value="-1">
      <input type="hidden" name="redirect_url" value="shopping_cart.php">
      <button type="submit" class="button">-</button>
    </form>';

    $shopping_cart_html .= '<div class="amount">Amount:' . $product_info['amount'] . $increase_button . $decrease_button . '</div><br>';
  }

  $template->assign('contents', $shopping_cart_html);
  $template->display('templates/shopping_cart.tpl');
}
else {
  $template->assign('message', "Shopping cart is empty");
  $template->display('templates/message.tpl');
}



?>
