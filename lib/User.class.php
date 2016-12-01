<?php

// Store the information in the session for now
class User {
  private $id;
  private $username;
  private $highscore;
  private $password_hash;
  private $dbh;

  public function __construct() {
  }

  public function createNew($username, $password) {
    $this->id = -1;
    $this->username = $username;
    $this->highscore = 0;
    $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
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

  public function changePassword($id, $password) {}

  public function getAll() {}

  public function connectToDb() {
    try {
      $mysql_details = 'mysql:dbname=memory_game;host=127.0.0.1';
      if (file_exists(__DIR__ . '/mysql_details.txt')) {
        $mysql_details = str_replace('\n', '', file_get_contents(__DIR__ . '/mysql_details.txt'));
      }

      $this->dbh = new PDO($mysql_details, 'root');
      $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch (PDOException $e) {
      echo "Connection failed\n".$e->getMessage();
    }
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
