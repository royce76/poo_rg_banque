<?php

class OperationManager
{
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

  //use to show all operations from the account'user in showaccount.php
  public function showOperations(){
    $query = $this->getDb()->prepare(
      "SELECT o.operation_type, o.amount AS amountO, o.registered, o.label
      FROM Account AS a
      INNER JOIN Operation AS o
      WHERE a.id = o.account_id AND a.id = :account_id"
    );
    $result = $query->execute([
      "account_id" => $_GET["id"]
    ]);
    $operation_user = $query->fetchAll(PDO::FETCH_CLASS, "Operation");
    return $operation_user;
  }

}
