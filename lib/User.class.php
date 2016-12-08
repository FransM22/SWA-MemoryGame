<?php

require_once('Database.class.php');

// Store the information in the session for now
class User {
  private $id;
  private $username;
  private $highscore;
  private $password_hash;
  private $dbh;

  public function __construct() {
  }

  public static function loadAll() {
    $db = new Database();
    $dbh = $db->getDbh();
    $sth = $dbh->prepare('SELECT `id` FROM users');
    $sth->execute();

    $users = array();
    while ($row = $sth->fetch()) {
      $new_user = new User();
      $new_user->fromId($row['id']);
      $users[] = $new_user;
    }

    return $users;
  }

  public function createNew($username, $password) {
    $this->id = -1;
    $this->username = $username;
    $this->highscore = 0;
    $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
  }

  public function createGuest() {
    $this->id = -1;
    $this->username = "Guest";
    $this->highscore = 0;
  }

  public function fromLogin($username, $password) {
    $this->connectToDb();
    $sth = $this->dbh->prepare('SELECT `id`, `password_hash`, `highscore` FROM users WHERE `username` = :username');
    $sth->bindParam(':username', $username);
    $sth->execute();


    $row = $sth->fetch();
    $password_hash = $row['password_hash'];

    if (password_verify($password, $password_hash)) {
      $this->id = $row['id'];
      $this->username = $username;
      $this->highscore = $row['highcore'];
    }
  }

  public function fromId($id) {
    $this->connectToDb();
    $sth = $this->dbh->prepare('SELECT `username`, `highscore` FROM users WHERE `id` = :id');
    $sth->bindParam(':id', $id);
    $sth->execute();


    $row = $sth->fetch();
    $this->id = $id;
    $this->username = $row['username'];
    $this->highscore = $row['highscore'];
  }

  public function fromSession() {
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      $this->connectToDb();

      $this->fromId($user_id);
    }
    else {
      $this->createGuest();
    }
  }

  public function isAdmin() {
    return $this->username === "admin";
  }

  public function changePassword($id, $password) {}

  public function getAll() {}

  public function connectToDb() {
    $db = new Database();
    $this->dbh = $db->getDbh();
  }

  public function saveInDb() {
    $this->connectToDb();

    // Store the user in the database
    $username = $this->username;
    $password_hash = $this->password_hash;
    $highscore = $this->highscore;
    $sth = $this->dbh->prepare('INSERT INTO `users` SET  `username` = :username, `password_hash` = :password_hash, `highscore` = :highscore');
    $sth->bindParam(':username', $username);
    $sth->bindParam(':password_hash', $password_hash);
    $sth->bindParam(':highscore', $highscore);

    $sth->execute();

    // Retrieve the id from the database
    $sth = $this->dbh->prepare('SELECT `id` FROM `users` WHERE `username` = :username;');
    $sth->bindParam(':username', $username);

    $sth->execute();
    $row = $sth->fetch();
    $this->id = $row['id'];
  }

  public function startUserSession() {
    $_SESSION['user_id'] = $this->id;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->username;
  }

  public function getHighScore() {
    return $this->highscore;
  }
}

?>
