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

  //use to get information from user
  public function user() {
    $query = $this->getDb()->prepare(
      "SELECT * FROM User WHERE id= :id"
    );
    $query->execute([
      "id" => $_SESSION["user_id"]
    ]);
    $user = $query->fetchAll(PDO::FETCH_CLASS, "User");
    return $user;
  }

  //update profil user
  public function updateProfil(User $user, User $user_modify) {
    $query = $this->getDb()->prepare(
      "UPDATE User AS u
      SET u.email = :email, u.city = :city, u.city_code = :cityCode, u.adress = :adress, u.password = :password
      WHERE u.id = :id"
    );
    $query->execute([
      "email" => $user_modify->getEmail(),
      "city" => $user_modify->getCity(),
      "cityCode" => $user_modify->getCityCode(),
      "adress" => $user_modify->getAdress(),
      "password" => $user_modify->getPassword(),
      "id" => $user->getId()
    ]);
    return TRUE;
  }

}
