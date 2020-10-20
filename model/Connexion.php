<?php

abstract class Connexion {

  //on passe les identifiants à la bd dans des constantes
  const HOST = "localhost";
  const NAME = "banque_php";
  const LOGIN = "root";
  const PASSWORD = "";

  //on appelle la base de donnée
  static public function getConnexion() {
    $db = new PDO("mysql:host=" . self::HOST .";dbname=" . self::NAME , self::LOGIN, self::PASSWORD);
    return $db;
  }
}
