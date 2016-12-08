<?php

require_once("Database.class.php");

class StoreProduct {
  private $title;
  private $price;
  private $description;

  private $dbh;

  public function __construct() {
  }

  public function createNew($title, $price_euros, $description) {
    $this->title = $title;
    $this->price = $price_euros;
    $this->description = $description;
  }

  public function loadFromId($id) {
    $this->connectToDb();

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
    $this->connectToDb();
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

  public static function loadFromShoppingCart() {
    $product_amounts = array();
    if (isset($_SESSION["product_amounts"])) {
      $product_amounts = $_SESSION["product_amounts"];
    }

    $products = array();
    foreach ($product_amounts as $product_id => $amount) {
      $product = new StoreProduct();
      $product->loadFromId($product_id);

      $product_array = array('id' => $product->getId(), 'title' => $product->getTitle(), 'amount' => $amount);
      $products[] = $product_array;
    }

    return $products;
  }

  public function saveInDb() {
    $this->connectToDb();

    $title = $this->title;
    $description = $this->description;
    $price = $this->price;
    $sth = $this->dbh->prepare('INSERT INTO `store_products` SET `title` = :title, `description` = :description, `price` = :price');
    $sth->bindParam(':title', $title);
    $sth->bindParam(':description', $description);
    $sth->bindParam(':price', $price);

    $sth->execute();

    // Retrieve the id from the database
    $sth = $this->dbh->prepare('SELECT `id` FROM `store_products` WHERE `title` = :title;');
    $sth->bindParam(':title', $title);

    $sth->execute();
    $row = $sth->fetch();
    $this->id = $row['id'];
  }

  public function connectToDb() {
    $db = new Database();
    $this->dbh = $db->getDbh();
  }

  public function getId() { return $this->id; }
  public function getTitle() { return $this->title; }
  public function getDescription() { return $this->description; }
  public function getPrice() { return $this->price; }
}

?>
