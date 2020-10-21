<?php

/**
 *
 */
class UserManager {
  private PDO $_db;

  function __construct() {
    $this->setDb(CONNEXION::getConnexion());
  }

  public function setDb(PDO $db) {
    $this->_db = $db;
  }

  public function getDb() {
    return $this->_db;
  }

  //use to get information from user to connect to website
  public function userInfo(User $user) {
    $query = $this->getDb()->prepare(
      "SELECT * FROM User WHERE email= :email"
    );
    $query->execute([
      "email" => $user->getEmail()
    ]);
    $user_info = $query->fetchAll(PDO::FETCH_CLASS, "User");
    return $user_info;
  }

}
