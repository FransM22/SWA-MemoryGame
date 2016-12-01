<?php

require("Database.class.php");

class StoreProduct {
  private $product_name;
  private $price_euros;
  private $availability;

  private $dbh;

  public function __construct() {
    $db = new Database();
    $this->dbh = $db->getDbh();
  }

  public function loadFromId($id) {
    $sth = $this->dbh->prepare('SELECT `id`, `title`, `description`, `price` FROM store_products WHERE `id` = :id');
    $sth->bindParam(':id', $id);
    $sth->execute();


    $row = $sth->fetch();
    $this->id = $id;
    $this->title = $row['title'];
    $this->description = $row['description'];
    $this->price = $row['price'];
  }

  public function loadAll() {
    $sth = $this->dbh->prepare('SELECT `id`, `title`, `description`, `price` FROM store_products');
    $sth->execute();

    $store_products = array();

    while ($row = $sth->fetch()) {
      $store_product = array();
      $store_product['id'] = $row['id'];
      $store_product['title'] = $row['title'];
      $store_product['description'] = $row['description'];
      $store_product['price'] = $row['price'];

      $store_products[] = $store_product;
    }

    return $store_products;
  }

  public function getTitle() { return $this->title; }
  public function getDescription() { return $this->description; }
  public function getPrice() { return $this->price; }
}

?>
