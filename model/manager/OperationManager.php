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

  public function AccountLastOperation() {
    $query = $this->getDb()->prepare(
    "SELECT o.operation_type, o.amount AS amountO, o.registered, o.label, o.account_id
    FROM User AS u
    INNER JOIN Account AS a
    ON u.id = a.user_id AND u.id = :user_id
    -- show account even there is no operation
    LEFT JOIN Operation AS o
    ON a.id = o.account_id
    WHERE o.id IN (SELECT MAX(o.id)
    FROM Operation AS o
    GROUP BY o.account_id)
    OR a.id NOT IN (SELECT o.account_id
    FROM Operation AS o)"
  );
  $result = $query->execute([
    "user_id" => $_SESSION["user_id"]
  ]);

  $account_last_operation = $query->fetchAll(PDO::FETCH_CLASS, "Operation");
  return $account_last_operation;
  }

}
