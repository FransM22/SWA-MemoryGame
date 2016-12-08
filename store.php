<?php

require('lib/Template.class.php');
require('lib/StoreProduct.class.php');
require_once('lib/User.class.php');

session_start();

$store_product = new StoreProduct();
$store_products = $store_product->loadAll();
$store_items_divs = '';

foreach ($store_products as $product) {
  $product_name = $product['title'];
  $product_description = $product['description'];
  $product_price = $product['price'];
  $buy_button = '<form action="submit_user_shopping_cart_contents.php" method="POST">
    <input type="hidden" name="product_id" value="'. $product['id'] . '">
    <input type="hidden" name="increase_amount" value="1">
    <input type="hidden" name="redirect_url" value="store.php">
    <button type="submit" class="button">Add to cart</button>
  </form>';

  $store_items_divs .= '<li class="flex-item"><span class="name">' . $product_name .  '</span><br><span class="description">' . $product_description . '</span><br><span class="price"> €' . $product_price . '</span>' . $buy_button . '</li>';
}

$template = new Template();
$template->assign('store_items_divs', $store_items_divs);

$user = new User();
$user->fromSession();

$admin_section = '';
if ($user->isAdmin()) {
  $admin_section = (new Template())->get('templates/admin_store.inc.tpl');
}

$template->assign('admin_section', $admin_section);
$template->assignMenu();

$template->display('templates/store.tpl');

?>
