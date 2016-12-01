<?php

class Database {
  private $dbh;

  public function __construct() {
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

  public function getDbh() {
    return $this->dbh;
  }
}
?>
