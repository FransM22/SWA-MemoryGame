<?php

// Store the information in the session for now
class User {
  private $id;
  private $name;
  private $highscore;
  private $password_hash;

  public function createNew($name, $password) {
    $this->name = $name;
    $this->highscore = 0;
    $this->password_hash = password_hash($password);
  }

  public function changePassword($id, $password) {}

  public function getAll() {}
}

?>
