<?php

// Store the information in the session for now
class User {
  private $id;
  private $username;
  private $highscore;
  private $password_hash;

  public function __construct() {
  }

  public function createNew($username, $password) {
    $this->username = $username;
    $this->highscore = 0;
    $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
  }

  public function changePassword($id, $password) {}

  public function getAll() {}

  public function saveInDb() {
    try {
      $mysql_details = 'mysql:dbname=memory_game;host=127.0.0.1';
      if (file_exists(__DIR__ . '/mysql_details.txt')) {
        $mysql_details = str_replace('\n', '', file_get_contents(__DIR__ . '/mysql_details.txt'));
      }

      $dbh = new PDO($mysql_details, 'root');
      $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

      $username = $this->username;
      $password_hash = $this->password_hash;
      $highscore = $this->highscore;
      $sth = $dbh->prepare('INSERT INTO `users` SET  `username` = :username, `password_hash` = :password_hash, `highscore` = :highscore');
      $sth->bindParam(':username', $username);
      $sth->bindParam(':password_hash', $password_hash);
      $sth->bindParam(':highscore', $highscore);

      $sth->execute();
      echo "Success";

    } catch (PDOException $e) {
      echo "Connection failed\n".$e->getMessage();
    }
  }
}

?>
