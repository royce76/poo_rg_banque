<?php
// session_start();

/**
 *
 */
class AccountManager
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

  public function showAccounts() {
    $query = $this->getDb()->prepare (
      "SELECT DISTINCT a.id AS a_id, a.amount AS a_amount, a.opening_date, a.account_type, o.operation_type, o.amount AS o_amount, o.registered, o.label
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

    $accounts = $query->fetchAll(PDO::FETCH_CLASS, "Account");
    return $accounts;
  }

}
